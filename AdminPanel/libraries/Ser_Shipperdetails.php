<?php 
class Ser_Shipperdetails {
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
     * Get all Shipperdetails 
     * returns json/Null
     */
    public function GetShipperdetails() {
        $stmt = $this->conn->prepare("CALL sp_GetShipperdetails()");
        if ($stmt->execute()) {
            $shipperdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch shipperdetail data and shipperdetail in array
            $stmt->close();
            if ($shipperdetails==true) {
                return $shipperdetails;
            }
        } else return NULL;
    }
    
    /**
     * Get all shipperdetails 
     * params shipperdetail Id
     * returns json/Null
     */
    public function GetshipperdetailById($shipperdetailId) {
        $stmt = $this->conn->prepare("CALL sp_GetShipperdetailById(?)");
        $stmt->bind_param("i",$shipperdetailId);
        if ($stmt->execute()) {
            $shipperdetails = $stmt->get_result()->fetch_assoc(); //fetch shipperdetail data and shipperdetail in array
            $stmt->close();
            if ($shipperdetails==true) {
                return $shipperdetails;
            }
        } else return NULL;
    }

}
?>