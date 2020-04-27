<?php 
class Ser_Shippers {
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
     * Get all shippers 
     * returns json/Null
     */
    public function Getshippers() {
        $stmt = $this->conn->prepare("CALL sp_GetShippers()");
        if ($stmt->execute()) {
            $shippers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch shippers data and shippers in array
            $stmt->close();
            if ($shippers==true) {
                return $shippers;
            }
        } else return NULL;
    }
    
    /**
     * Get all shippers 
     * params shippers Id
     * returns json/Null
     */
    public function GetShipperById($shipperId) {
        $stmt = $this->conn->prepare("CALL sp_GetShipperById(?)");
        $stmt->bind_param("i",$shipperId);
        if ($stmt->execute()) {
            $shippers = $stmt->get_result()->fetch_assoc(); //fetch shipper data and shipper in array
            $stmt->close();
            if ($shippers==true) {
                return $shippers;
            }
        } else return NULL;
    }

        /**
     * Delete Shipper By Id 
     * params Shipper Id
     * returns json/Null
     */
    public function DeleteShipperById($shipperId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteShipperbyId(?)");
        $stmt->bind_param("i",$shipperId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
}
?>