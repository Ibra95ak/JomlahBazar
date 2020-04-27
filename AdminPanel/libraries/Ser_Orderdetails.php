<?php 
class Ser_Orderdetails {
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
     * Get all orderdetails 
     * returns json/Null
     */
    public function Getorderdetails() {
        $stmt = $this->conn->prepare("CALL sp_GetOrderdetails()");
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch Orderdetail data and Orderdetail in array
            $stmt->close();
            if ($orderdetails==true) {
                return $orderdetails;
            }
        } else return NULL;
    }
    
    /**
     * Get all orderdetails 
     * params Orderdetail Id
     * returns json/Null
     */
    public function GetOrderdetailById($orderdetailId) {
        $stmt = $this->conn->prepare("CALL sp_GetOrderdetailById(?)");
        $stmt->bind_param("i",$orderdetailId);
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_assoc(); //fetch orderdetail data and orderdetail in array
            $stmt->close();
            if ($orderdetails==true) {
                return $orderdetails;
            }
        } else return NULL;
    }

        /**
     * Delete orderdetail By Id 
     * params orderdetail Id
     * returns json/Null
     */
    public function DeleteOrderdetailById($orderdetailId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteOrderdetailbyId(?)");
        $stmt->bind_param("i",$orderdetailId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>