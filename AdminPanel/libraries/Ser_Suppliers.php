<?php 
class Ser_Suppliers {
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
     * Get all suppliers 
     * returns json/Null
     */
    public function Getsuppliers() {
        $stmt = $this->conn->prepare("CALL sp_Getsuppliers()");
        if ($stmt->execute()) {
            $suppliers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch supplier data and supplier in array
            $stmt->close();
            if ($suppliers==true) {
                return $suppliers;
            }
        } else return NULL;
    }
    /**
     * Storing new Supplier
     * returns Boolean
     */
    public function addSupplier($aaaId,$subscriptionplanId,$discount_type,$registeredsupplierId,$blockId) {
        $stmt = $this->conn->prepare("CALL sp_AddSupplier(?,?,?,?,?)");
		$stmt->bind_param("iiiii",$aaaId,$subscriptionplanId,$discount_type,$registeredsupplierId,$blockId);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful Supplier
        if ($result) return true;
        else return false;
    } 
    
    /**
     * Edit supplier 
     * @param supplierId, username, password
     * returns Boolean
     */
    public function editSupplier($supplierId,$aaaId,$subscriptionplanId,$discount_type,$registeredsupplierId,$blockId) {
        $stmt = $this->conn->prepare("CALL sp_EditSupplier(?,?,?,?,?,?)");
		$stmt->bind_param("iiiiii",$supplierId,$aaaId,$subscriptionplanId,$discount_type,$registeredsupplierId,$blockId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    /**
     * Get all suppliers 
     * params supplier Id
     * returns json/Null
     */
    public function GetSupplierById($supplierId) {
        $stmt = $this->conn->prepare("CALL sp_GetSupplierById(?)");
        $stmt->bind_param("i",$supplierId);
        if ($stmt->execute()) {
            $suppliers = $stmt->get_result()->fetch_assoc(); //fetch supplier data and supplier in array
            $stmt->close();
            if ($suppliers==true) {
                return $suppliers;
            }
        } else return NULL;
    }
    
    /**
     * Get all suppliers 
     * params supplier Id
     * returns json/Null
     */
    public function SearchSuppliers($text) {
        $stmt = $this->conn->prepare("CALL sp_SearchSuppliers('%$text%')");
        if ($stmt->execute()) {
            $suppliers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch supplier data and supplier in array
            $stmt->close();
            if ($suppliers==true) {
                return $suppliers;
            }
        } else return NULL;
    }

        /**
     * Delete Supplier By Id 
     * params Supplier Id
     * returns json/Null
     */
    public function DeleteSupplierById($supplierId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteSupplierbyId(?)");
        $stmt->bind_param("i",$supplierId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
}
?>