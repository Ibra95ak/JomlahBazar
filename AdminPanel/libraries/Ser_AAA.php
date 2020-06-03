<?php 
class Ser_AAA {
    private $conn;
    /*constructor*/
    function __construct() {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    // destructor
    function __destruct() {
        
    }
    
    /**
     * Storing new AAA
     * @param email, password
     * returns Boolean
     */
    public function addAAA($email,$password) {
        $hash = $this->hashSSHA($password); /*encryption function*/
        $encrypted_password = $hash["encrypted"]; /*encrypted password*/
        $salt = $hash["salt"]; /*salt(Used for verifying password later)*/
        /*email activation code*/
        $hash_act = $this->hashSSHA($email.date("Y-m-d h:i:s")); /*encryption function*/
        $activation_code = $hash_act["encrypted"]; /*encrypted Activation code*/
        $activation_salt = $hash_act["salt"]; /*salt for activation code*/
        
        $stmt = $this->conn->prepare("CALL sp_AddAAA(?,?,?,?,?)");
		$stmt->bind_param("sssss",$email,$encrypted_password,$salt,$activation_code,$activation_salt);
        if ($stmt->execute()) {			
            $aaa = $stmt->get_result()->fetch_assoc();
            $stmt->close();
			return $aaa; 
        } else {
            return NULL;
        }
    }

	/**
     * Edit aaa info
     * @param aaaId, email, password, opt
     * returns Boolean
     */
    public function editAAA($aaaId,$email,$password,$opt,$addressId) {
		$hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];
        $stmt = $this->conn->prepare("CALL sp_EditAAA(?,?,?,?,?,?)");
		$stmt->bind_param("ssssi",$aaaId,$email,$encrypted_password,$salt,$opt,$addressId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
	
    /**
     * Get all aaa table
     * returns json array/Null
     */
    public function getAll_aaa() {
        $stmt = $this->conn->prepare("CALL sp_GetAAA()");
        if ($stmt->execute()) {			
            $aaa = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
			return $aaa; 
        } else {
            return NULL;
        }
    }

    /**
     * Get aaa by ID
     * returns array/Null
     */
    public function getBYId_aaa($aaaId) {
        $stmt = $this->conn->prepare("CALL sp_GetAAAById(?)");
        $stmt->bind_param("i",$aaaId);
        if ($stmt->execute()) {			
            $aaa = $stmt->get_result()->fetch_assoc();
            $stmt->close();
			return $aaa; 
        } else {
            return NULL;
        }
    }
    
    /**
     * activate aaa 
     * @param aaId
     * returns Boolean
     */
    public function activateAAA($aaaId) {
        $stmt = $this->conn->prepare("CALL sp_ActivateAAA(?)");
		$stmt->bind_param("i",$aaaId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    /**
     * Get user by email and password
     * @param email, password
     * returns user/Null
     */
    public function getAAAByEmailAndPassword($email, $password) {
        $stmt = $this->conn->prepare("CALL sp_GetAAAByEmail(?)");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc(); /*fetch aaa data and store in array*/
            $stmt->close();
            /*verifying user password*/
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password); /*verify encryption function*/
            /*check for password equality*/
            if ($encrypted_password == $hash) {
                /*user authentication details are correct*/
                return $user;
            }
        } else return NULL;
    }
    
    /**
     * Check if email already exist
     * returns array/Null
     */
    public function isExist_aaaEmail($email) {
        $stmt = $this->conn->prepare("CALL sp_IsExistAAA(?)");
        $stmt->bind_param("s",$email);
        $result = $stmt->execute();
        $aaa = $stmt->get_result()->fetch_assoc();
        $stmt->close(); 
		if($aaa) return true;
		else return false;
    }
    
    /**
     * Delete aaa By Id 
     * params aaa Id
     * returns json/Null
     */
    public function DeleteAAAById($aaaId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteAAAbyId(?)");
        $stmt->bind_param("i",$aaaId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    
    /**
     * logged aaa 
     * @param aaaId
     * returns Boolean
     */
    public function loggedAAA($aaaId) {
        $stmt = $this->conn->prepare("CALL sp_LoginAAA(?)");
		$stmt->bind_param("i",$aaaId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }
}
?>