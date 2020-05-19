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
        $stmt = $this->conn->prepare("CALL sp_GetRegisteredsupplierById(?)");
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
     * Storing new Registeredsupplier
     * returns Boolean
     */
    public function addRegisteredsupplier($registered_name,$creditcardId) {
        $stmt = $this->conn->prepare("CALL sp_AddRegisteredsupplier(?,?)");
		$stmt->bind_param("si",$registered_name,$creditcardId);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }  

    /**
     * Edit registeredsupplier 
     * @param registeredsupplierId, username, password
     * returns Boolean
     */
    public function editRegisteredsupplier($registeredsupplierId,$registered_name,$creditcardId) {
        $stmt = $this->conn->prepare("CALL sp_EditRegisteredsupplier(?,?,?)");
		$stmt->bind_param("isi",$registeredsupplierId,$registered_name,$creditcardId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
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