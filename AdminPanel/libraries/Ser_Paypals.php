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
    public function GetPaypalById($paypalId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaypalById(?)");
        $stmt->bind_param("i",$paypalId);
        if ($stmt->execute()) {
            $paypals = $stmt->get_result()->fetch_assoc(); //fetch paypal data and paypal in array
            $stmt->close();
            if ($paypals==true) {
                return $paypals;
            }
        } else return NULL;
    }

}
?>