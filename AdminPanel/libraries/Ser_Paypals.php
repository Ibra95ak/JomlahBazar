<?php 
class Ser_Paypals {
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
     * Storing new Paypal
     * returns Boolean
     */
    public function addPaypal($walletId,$email) {
        $stmt = $this->conn->prepare("CALL sp_AddPaypal(?,?)");
		$stmt->bind_param("is",$walletId,$email);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    	
    /**
     * Edit paypal 
     * @param typeId, username, password
     * returns Boolean
     */
    public function editPaypal($paypalId,$walletId,$email) {
        $stmt = $this->conn->prepare("CALL sp_EditPaypal(?,?,?)");
		$stmt->bind_param("iis",$paypalId,$walletId,$email);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    /**
     * Get all Paypals 
     * returns json/Null
     */
    public function Getpaypals() {
        $stmt = $this->conn->prepare("CALL sp_GetPaypal()");
        if ($stmt->execute()) {
            $paypals = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch paypal data and paypal in array
            $stmt->close();
            if ($paypals==true) {
                return $paypals;
            }
        } else return NULL;
    }
    
    /**
     * Get all paypals 
     * params paypal Id
     * returns json/Null
     */
    public function GetPaypalById($typeId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaypalById(?)");
        $stmt->bind_param("i",$typeId);
        if ($stmt->execute()) {
            $paypals = $stmt->get_result()->fetch_assoc(); //fetch paypal data and paypal in array
            $stmt->close();
            if ($paypals==true) {
                return $paypals;
            }
        } else return NULL;
    }

        /**
     * Delete paypal By Id 
     * params paypal Id
     * returns json/Null
     */
    public function DeletePaypalById($typeId) {
        $stmt = $this->conn->prepare("CALL sp_DeletePaypalbyId(?)");
        $stmt->bind_param("i",$typeId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>