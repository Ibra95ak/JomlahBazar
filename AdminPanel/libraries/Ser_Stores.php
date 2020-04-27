<?php 
class Ser_Stores {
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
     * Get all stores 
     * returns json/Null
     */
    public function Getstores() {
        $stmt = $this->conn->prepare("CALL sp_GetStores()");
        if ($stmt->execute()) {
            $stores = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch store data and store in array
            $stmt->close();
            if ($stores==true) {
                return $stores;
            }
        } else return NULL;
    }
    
    /**
     * Get all stores 
     * params store Id
     * returns json/Null
     */
    public function GetStoreById($storeId) {
        $stmt = $this->conn->prepare("CALL sp_GetStoreById(?)");
        $stmt->bind_param("i",$storeId);
        if ($stmt->execute()) {
            $stores = $stmt->get_result()->fetch_assoc(); //fetch store data and store in array
            $stmt->close();
            if ($stores==true) {
                return $stores;
            }
        } else return NULL;
    }

        /**
     * Delete Store By Id 
     * params Store Id
     * returns json/Null
     */
    public function DeleteStoreById($storeId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteStorebyId(?)");
        $stmt->bind_param("i",$storeId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
}
?>