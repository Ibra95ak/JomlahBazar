<?php 
class Ser_Registeredsuppliers {
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
     * Get all Registeredsuppliers 
     * returns json/Null
     */
    public function Getregisteredsuppliers() {
        $stmt = $this->conn->prepare("CALL sp_GetRegisteredsuppliers()");
        if ($stmt->execute()) {
            $registeredsuppliers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch registeredsupplier data and registeredsupplier in array
            $stmt->close();
            if ($registeredsuppliers==true) {
                return $registeredsuppliers;
            }
        } else return NULL;
    }
    
    /**
     * Get all registeredsuppliers 
     * params registeredsupplier Id
     * returns json/Null
     */
    public function GetregisteredsupplierById($registeredsupplierId) {
        $stmt = $this->conn->prepare("CALL sp_GetStoreById(?)");
        $stmt->bind_param("i",$registeredsupplierId);
        if ($stmt->execute()) {
            $registeredsuppliers = $stmt->get_result()->fetch_assoc(); //fetch registeredsupplier data and registeredsupplier in array
            $stmt->close();
            if ($registeredsuppliers==true) {
                return $registeredsuppliers;
            }
        } else return NULL;
    }

        /**
     * Delete Registeredsupplier By Id 
     * params Registeredsupplier Id
     * returns json/Null
     */
    public function DeleteRegisteredsupplierById($registeredsupplierId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteRegisteredsupplierbyId(?)");
        $stmt->bind_param("i",$registeredsupplierId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>