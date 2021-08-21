<?php
/**
  ** order details object
  * addOrderdetail --> add new order details
  * editOrderdetail --> edit order details
  * Getorderdetails --> get all orders details
  * GetOrderdetailById --> Get certain order detail
  * GetPaymentByOrderdetailsId --> Get certain order detail payment
  * DeleteOrderdetailById --> delete order details
  * UpdateStatus --> update order detail status
  * GetOrderdetailByOrderId --> get all order details for an order
  * IntiateOrderSeller --> accept or reject order by seller
  * GetOrderdetailBuyer --> get buyer info of certain orderdetail
  * CancelOrderdetailBuyer --> cancel orderdetail by buyer
  * AddRefund --> refund orderdetail by buyer
  * GetRefundReasons --> get all refund reasons
  * RefundOrderdetailBuyer --> change order detail status to refund
  ****    Admin functions   ****
  * Admin_getallOrderdetails --> Get all order details
  * Admin_getallrefunds --> Get order details of an order
  * Admin_getOrderdetailsById --> Get all refunded orders
  * Admin_getallshipments --> Get all shipped orders
  */
class Ser_Orderdetails {
    private $conn;
    /* constructor*/
    function __construct() {
        require_once 'DB_Connect.php';
        /* connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    function __destruct() {

    }
    /**
     * add new Orderdetail
     * parameters {orderId, productId, supplierId, order_number, discount, quantity, totalweight, totalprice, statusId, blockId, active}
     * returns Boolean
     */
    public function addOrderdetail($orderId, $productId, $order_number, $discount, $quantity, $totalprice, $totalweight, $statusId, $active) {
        $stmt = $this->conn->prepare("CALL sp_AddOrderdetail(?,?,?,?,?,?,?,?,?)");
    		$stmt->bind_param("iisiiddii",$orderId, $productId, $order_number, $discount, $quantity, $totalprice, $totalweight, $statusId, $active);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    /**
     * Edit orderdetail
     * parameters {orderdetailId, orderId, productId, ordernumber, discount, totalprice, statusId, blockId, active}
     * returns Boolean
     */
    public function editOrderdetail($orderdetailId, $orderId, $productId, $ordernumber, $discount, $totalprice, $statusId, $blockId, $active) {
        $stmt = $this->conn->prepare("CALL sp_EditOrderdetail(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiiiiiiii", $orderdetailId, $orderId, $productId, $ordernumber, $discount, $totalprice, $statusId, $blockId, $active);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    /**
     * Get all orderdetails
     * parameters {}
     * returns json/Null
     */
    public function Getorderdetails() {
        $stmt = $this->conn->prepare("CALL sp_GetOrderdetails()");
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
            $stmt->close();
            if ($orderdetails) return $orderdetails;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get certain order detail
     * parameters {orderdetailId}
     * returns json/Null
     */
    public function GetOrderdetailById($orderdetailId) {
        $stmt = $this->conn->prepare("CALL sp_GetOrderdetailById(?)");
        $stmt->bind_param("i",$orderdetailId);
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
            $stmt->close();
            if ($orderdetails) return $orderdetails;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get certain order detail payment
     * parameters {orderdetailId}
     * returns json/Null
     */
    public function GetPaymentByOrderdetailsId($orderdetailId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaymentByOrderdetailsId(?)");
        $stmt->bind_param("i",$orderdetailId);
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
            $stmt->close();
            if ($orderdetails) return $orderdetails;
            else return NULL;
        } else return NULL;
    }
    /**
     * update orderdetail shipment
     * parameters {shipmentId, $hipped_by}
     * returns json/Null
     */
    public function UpdateShippedby($shipmentId, $shipped_by)
    {
        $stmt = $this->conn->prepare("CALL sp_UpdateShippedby(?,?)");
        $stmt->bind_param("ii", $shipmentId, $shipped_by);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * Delete orderdetail
     * parameters {orderdetailId}
     * returns boolean
     */
    public function DeleteOrderdetailById($orderdetailId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteOrderdetailbyId(?)");
        $stmt->bind_param("i",$orderdetailId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    /**
     * update order detail status
     * parameters {orderdetailId}
     * returns json/Null
     */
     public function UpdateStatus($orderdetailId,$statusId) {
       $stmt = $this->conn->prepare("CALL sp_UpdateOrderdetailStatusById(?,?)");
       $stmt->bind_param("ii",$orderdetailId,$statusId);
       $result = $stmt->execute();
       $stmt->close();
       if($result) return true;
       else return false;
     }
     /**
      * get all order details for an order
      * parameters {orderId}
      * returns json/Null
      */
      public function GetOrderdetailByOrderId($orderId){
        $stmt = $this->conn->prepare("CALL sp_GetOrderdetailByOrderId(?)");
        $stmt->bind_param("i",$orderId);
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($orderdetails) return $orderdetails;
            else return NULL;
        } else return NULL;
    }
     /**
      * get all order details for an ordernumber
      * parameters {ordernumber}
      * returns json/Null
      */
      public function GetOrderdetailByOrdernumber($ordernumber){
        $stmt = $this->conn->prepare("CALL sp_GetOrderdetailByOrdernumber(?)");
        $stmt->bind_param("s",$ordernumber);
        if ($stmt->execute()) {
            $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($orderdetails) return $orderdetails;
            else return NULL;
        } else return NULL;
    }
     /**
      * get status by Id
      * parameters {statusId}
      * returns json/Null
      */
      public function getStatusById($statusId){
        $stmt = $this->conn->prepare("CALL sp_getStatusById(?)");
        $stmt->bind_param("i",$statusId);
        if ($stmt->execute()) {
            $status = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($status) return $status;
            else return NULL;
        } else return NULL;
    }
     /**
      * accept/reject order by seller
      * parameters {orderdetailId,statusId}
      * returns boolean
      */
      public function IntiateOrderSeller($orderdetailId,$statusId){
          $stmt = $this->conn->prepare("CALL sp_IntiateOrderSeller(?,?)");
          $stmt->bind_param("ii",$orderdetailId,$statusId);
          $result = $stmt->execute();
          $stmt->close();
          if($result) return true;
          else return false;
      }
     /**
      * get buyer info of order detail
      * parameters {orderdetailId}
      * returns boolean
      */
      public function GetOrderdetailBuyer($orderdetailId){
          $stmt = $this->conn->prepare("CALL sp_GetOrderdetailBuyer(?)");
          $stmt->bind_param("i",$orderdetailId);
          $result = $stmt->execute();
          if ($result) {
              $user = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
              $stmt->close();
              if ($user) return $user;
              else return NULL;
          } else return NULL;
      }
     /**
      * cancel orderdetail by buyer
      * parameters {orderdetailId}
      * returns boolean
      */
      public function CancelOrderdetailBuyer($orderdetailId){
          $stmt = $this->conn->prepare("CALL sp_CancelOrderdetailBuyer(?)");
          $stmt->bind_param("i",$orderdetailId);
          $result = $stmt->execute();
          $stmt->close();
          if($result) return true;
          else return false;
      }
      public function CompleteOrderdetailsSeller($orderId){
          $stmt = $this->conn->prepare("CALL sp_CompleteOrderdetailsSeller(?)");
          $stmt->bind_param("i", $orderId);
          $result = $stmt->execute();
          $stmt->close();
          if ($result) return true;
          else return false;
      }
     /**
      * refund orderdetail by buyer
      * parameters {userId, orderdetailId, reasonId}
      * returns boolean
      */
      public function AddRefund($userId, $orderdetailId, $reasonId){
          $stmt = $this->conn->prepare("CALL sp_AddRefund(?,?,?)");
          $stmt->bind_param("iii",$userId, $orderdetailId, $reasonId);
          $result = $stmt->execute();
          $stmt->close();
          if($result) return true;
          else return false;
      }
     /**
      * get all refind reasons
      * parameters {}
      * returns boolean
      */
      public function GetRefundReasons(){
          $stmt = $this->conn->prepare("CALL sp_GetRefundReasons()");
          $result = $stmt->execute();
          $refundreasons = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
          $stmt->close();
          if ($refundreasons) return $refundreasons;
          else return null;
      }
      /**
       * change orderdetail status to refund
       * parameters {orderdetailId}
       * returns boolean
       */
       public function RefundOrderdetailBuyer($orderdetailId){
           $stmt = $this->conn->prepare("CALL sp_RefundOrderdetailBuyer(?)");
           $stmt->bind_param("i",$orderdetailId);
           $result = $stmt->execute();
           $stmt->close();
           if($result) return true;
           else return false;
       }
    public function AddOrderDetailToPayments($orderdetailId, $payment_fees, $shipment_fees, $jb_fees, $total_price, $ref_id, $status)
    {
        $stmt = $this->conn->prepare("CALL sp_AddOrderDetailToPayments(?,?,?,?,?,?,?)");
        $stmt->bind_param("iddddss", $orderdetailId, $payment_fees, $shipment_fees, $jb_fees, $total_price, $ref_id, $status);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    /*************************Admin Functions********************************/
    /**
     * Get all order details
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallOrderdetails()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallOrderdetails()");
        $result = $stmt->execute();
        $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($orderdetails) return $orderdetails;
        else return null;
    }
    /**
     * Get order details of an order
     * Parameters {orderId}
     * returns json/null
     */
    public function Admin_getOrderdetailsById($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getOrderdetailsById(?)");
        $stmt->bind_param("i",$orderId);
        $result = $stmt->execute();
        $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($orderdetails) return $orderdetails;
        else return null;
    }
    /**
     * Get all refunded orders
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallrefunds()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallrefunds()");
        $result = $stmt->execute();
        $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($orderdetails) return $orderdetails;
        else return null;
    }
    /**
     * Get all shipped orders
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallshipments()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallshipments()");
        $result = $stmt->execute();
        $orderdetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($orderdetails) {
            return $orderdetails;
        } else {
            return null;
        }
    }
}
?>
