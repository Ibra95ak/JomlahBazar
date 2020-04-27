<?php 
class Ser_Productdetails {
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
     * Get all Productdetails 
     * returns json/Null
     */
    public function Getproductdetails() {
        $stmt = $this->conn->prepare("CALL sp_GetProductdetails()");
        if ($stmt->execute()) {
            $productdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch productdetail data and productdetail in array
            $stmt->close();
            if ($productdetails==true) {
                return $productdetails;
            }
        } else return NULL;
    }
    
    /**
     * Get all productdetail
     * params productdetail Id
     * returns json/Null
     */
    public function GetproductdetailById($productdetailId) {
        $stmt = $this->conn->prepare("CALL sp_GetProductdetailById(?)");
        $stmt->bind_param("i",$productdetailId);
        if ($stmt->execute()) {
            $productdetails = $stmt->get_result()->fetch_assoc(); //fetch productdetail data and productdetail in array
            $stmt->close();
            if ($productdetails==true) {
                return $productdetails;
            }
        } else return NULL;
    }

        /**
     * Delete Productdetail By Id 
     * params Productdetail Id
     * returns json/Null
     */
    public function DeleteProductdetailById($productdetailId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteProductdetailbyId(?)");
        $stmt->bind_param("i",$productdetailId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>