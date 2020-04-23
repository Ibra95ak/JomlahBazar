<?php 
class DB_product {
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
     * Storing new product
     * @param email, password
     * returns Boolean
     */
    public function addproduct($email,$password) {        
        $stmt = $this->conn->prepare("CALL insertProduct(?,?)");
		$stmt->bind_param("sssss",$email,$encrypted_password,$salt,$activation_code,$activation_salt);
		$result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) return true;
        else return false;
    }

	/**
     * Edit aaa info
     * @param productId, email, password, opt
     * returns Boolean
     */
    public function editproduct($aaaId,$email,$password,$opt) {
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
     * Get all product table
     * returns json array/Null
     */
    public function getAll_product() {
        $stmt = $this->conn->prepare("CALL sp_listproducts()");
        if ($stmt->execute()) {			
            $product = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
			return $product; 
        } else {
            return NULL;
        }
    }

    /**
     * Get product by ID
     * returns array/Null
     */
    public function getBYId_product($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM product where productId=?");
        $stmt->bind_param("i",$productId);
        if ($stmt->execute()) {			
            $product = $stmt->get_result()->fetch_assoc();
            $stmt->close();
			return $product; 
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