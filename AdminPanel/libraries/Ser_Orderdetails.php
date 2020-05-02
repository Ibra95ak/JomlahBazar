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
     * Storing new Orderdetail
     * returns Boolean
     */
    public function addOrderdetail($orderId,$ordernumber,$discount,$totalprice,$productdetailsId,
    $shipperId,$ship_date,$statusId,$blockId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddOrderdetail(?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iiiiiisiii",$orderId,$ordernumber,$discount,$totalprice,$productdetailsId,
        $shipperId,$ship_date,$statusId,$blockId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit orderdetail 
     * @param orderdetailId, username, password
     * returns Boolean
     */
    public function editOrderdetail($orderdetailId,$ordernumber,$discount,$totalprice,$ship_date,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditOrderdetail(?,?,?,?,?,?)");
		$stmt->bind_param("iiiisi",$orderdetailId,$ordernumber,$discount,$totalprice,$ship_date,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
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