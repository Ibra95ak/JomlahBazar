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

    /**
     * Storing new Shipperdetail
     * returns Boolean
     */
    public function addShipperdetail($name,$description) {
        $stmt = $this->conn->prepare("CALL sp_AddShipperdetail(?,?)");
		$stmt->bind_param("ss",$name,$description);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }  

    /**
     * Edit shipperdetail 
     * @param shipperdetailId, username, password
     * returns Boolean
     */
    public function editShipperdetail($shipperdetailId,$name,$description) {
        $stmt = $this->conn->prepare("CALL sp_EditShipperdetail(?,?,?)");
		$stmt->bind_param("iss",$shipperdetailId,$name,$description);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
        /**
     * Delete Shipperdetails By Id 
     * params Shipperdetails Id
     * returns json/Null
     */
    public function DeleteShipperdetailById($shipperdetailId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteShipperdetailbyId(?)");
        $stmt->bind_param("i",$shipperdetailId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>