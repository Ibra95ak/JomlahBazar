<?php 
class DB_AAA {
    private $conn;
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
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
        $hash = $this->hashSSHA($password); // encryption function
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        //email activation code
        $hash_act = $this->hashSSHA($emai.date("Y-m-d h:i:s")); // encryption function
        $activation_code = $hash_act["encrypted"]; // encrypted password
        $activation_salt = $hash_act["salt"]; // salt
        
        $stmt = $this->conn->prepare("INSERT INTO aaa(aaaId, email, encrypted_password, salt, activation_code, activation_salt, otp, addressId) VALUES (NULL,?,?,?,?,?,0,0)");
		$stmt->bind_param("sssss",$email,$encrypted_password,$salt,$activation_code,$activation_salt);
		$result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) return true;
        else return false;
    }

	/**
     * Edit aaa info
     * @param aaaId, email, password, opt
     * returns Boolean
     */
    public function editAAA($aaaId,$email,$password,$opt) {
		$hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];
        $stmt = $this->conn->prepare("UPDATE aaa SET email=?, encrypted_password=?, salt=?, opt=? where aaaId=?");
		$stmt->bind_param("ssssi",$email,$encrypted_password,$salt,$opt,$aaaId);
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
        $stmt = $this->conn->prepare("CALL GetCustomers()");
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
        $stmt = $this->conn->prepare("SELECT * FROM aaa where aaaId=?");
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
