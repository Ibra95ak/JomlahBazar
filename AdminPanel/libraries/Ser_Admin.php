<?php 
class Ser_Admin {
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
     * Storing new admin
     * @param username, password, admintypeId
     * returns Boolean
     */
    public function addAdmin($username,$password) {
        $hash = $this->hashSSHA($password); // encryption function
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $stmt = $this->conn->prepare("INSERT INTO admins(adminId, username, encrypted_password, salt, active, created_date) VALUES (NULL,?,?,?,1,NOW())");
		$stmt->bind_param("sss",$username,$encrypted_password,$salt);
		$result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) return true;
        else return false;
    }

	/**
     * Change admin password
     * @param adminId, password
     * returns Boolean
     */
    public function changePass($adminId,$password) {
		$hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];
        $stmt = $this->conn->prepare("UPDATE admins SET encrypted_password=?, salt=? where adminId=?");
		$stmt->bind_param("ssi",$encrypted_password,$salt,$adminId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
	
    /**
     * Get user by username and password
     * @param username, password
     * returns admin/Null
     */
    public function getAdminByUsernameAndPassword($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $admin = $stmt->get_result()->fetch_assoc(); //fetch admin data and store in array
            $stmt->close();
            // verifying user password
            $salt = $admin['salt'];
            $encrypted_password = $admin['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password); // verify encryption function
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $admin;
            }
        } else return NULL;
    }
	        	
    /**
     * Get all admins 
     * returns json/Null
     */
    public function Getadmins() {
        $stmt = $this->conn->prepare("CALL sp_GetAdmins()");
        if ($stmt->execute()) {
            $admins = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch admin data and store in array
            $stmt->close();
            if ($admins==true) {
                return $admins;
            }
        } else return NULL;
    }
    
    /**
     * Get all admins 
     * params admin Id
     * returns json/Null
     */
    public function GetAdminById($adminId) {
        $stmt = $this->conn->prepare("CALL sp_GetAdminById(?)");
        $stmt->bind_param("i",$adminId);
        if ($stmt->execute()) {
            $admins = $stmt->get_result()->fetch_assoc(); //fetch admin data and store in array
            $stmt->close();
            if ($admins==true) {
                return $admins;
            }
        } else return NULL;
    }
    
    /**
     * Delete admin By Id 
     * params admin Id
     * returns json/Null
     */
    public function DeleteAdminById($adminId) {
        $stmt = $this->conn->prepare("Delete From admins where adminId=?");
        $stmt->bind_param("i",$adminId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
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