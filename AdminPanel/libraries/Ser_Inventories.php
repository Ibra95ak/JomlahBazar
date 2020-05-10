<?php 
class Ser_Inventories {
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
     * Storing new Inventory
     * @param type,active
     * returns Boolean
     */
    public function addInventory($inventorynumber,$statusId,$blockId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddInventory(?,?,?,?)");
		$stmt->bind_param("siii",$inventorynumber,$statusId,$blockId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    /**
     * Edit inventory 
     * @param inventoryId, username, password
     * returns Boolean
     */
    public function editInventory($inventoryId,$inventorynumber,$statusId,$blockId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditInventory(?,?,?,?,?)");
		$stmt->bind_param("iiiii",$inventoryId,$inventorynumber,$statusId,$blockId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    	
    /**
     * Get all inventories 
     * returns json/Null
     */
    public function Getinventories() {
        $stmt = $this->conn->prepare("CALL sp_GetInventory()");
        if ($stmt->execute()) {
            $inventories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch inventory data and inventory in array
            $stmt->close();
            if ($inventories==true) {
                return $inventories;
            }
        } else return NULL;
    }
    
    /**
     * Get all inventories 
     * params inventory Id
     * returns json/Null
     */
    public function GetInventoryById($inventoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetInventoryById(?)");
        $stmt->bind_param("i",$inventoryId);
        if ($stmt->execute()) {
            $inventories = $stmt->get_result()->fetch_assoc(); //fetch inventory data and inventory in array
            $stmt->close();
            if ($inventories==true) {
                return $inventories;
            }
        } else return NULL;
    }

        /**
     * Delete inventory By Id 
     * params inventory Id
     * returns json/Null
     */
    public function DeleteInventoryById($inventoryId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteInventorybyId(?)");
        $stmt->bind_param("i",$inventoryId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>