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
     * Storing new Shipper
     * returns Boolean
     */
    public function addShipper($aaaId,$addressId,$reachoutId,$shipperdetailsId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddShipper(?,?,?,?,?)");
		$stmt->bind_param("iiiii",$aaaId,$addressId,$reachoutId,$shipperdetailsId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }  

    /**
     * Edit shipper 
     * @param shipperId, username, password
     * returns Boolean
     */
    public function editShipper($shipperId,$aaaId,$addressId,$reachoutId,$shipperdetailsId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditShipper(?,?,?,?,?,?)");
		$stmt->bind_param("iiiiii",$shipperId,$aaaId,$addressId,$reachoutId,$shipperdetailsId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
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