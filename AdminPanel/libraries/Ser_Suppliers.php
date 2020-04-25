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

}
?>