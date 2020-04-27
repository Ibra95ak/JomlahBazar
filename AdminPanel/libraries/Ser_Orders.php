<?php 
class Ser_Orders {
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
     * Get all orders 
     * returns json/Null
     */
    public function Getorders() {
        $stmt = $this->conn->prepare("CALL sp_GetOrders()");
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders==true) {
                return $orders;
            }
        } else return NULL;
    }
    
    /**
     * Get all orders 
     * params order Id
     * returns json/Null
     */
    public function GetOrderById($orderId) {
        $stmt = $this->conn->prepare("CALL sp_GetOrderById(?)");
        $stmt->bind_param("i",$orderId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc(); //fetch order data and store in array
            $stmt->close();
            if ($orders==true) {
                return $orders;
            }
        } else return NULL;
    }

        /**
     * Delete order By Id 
     * params order Id
     * returns json/Null
     */
    public function DeleteOrderById($orderId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteOrderbyId(?)");
        $stmt->bind_param("i",$orderId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>