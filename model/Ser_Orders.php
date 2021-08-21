<?php
class Ser_Orders
{
    private $conn;
    /*constructor*/
    function __construct()
    {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    function __destruct()
    {
    }

    /**
     * Storing new Order
     * returns Boolean
     */
    public function addOrder($handling, $userId, $sellerId, $orderNumber, $taxNumber,$totalQuantity, $totalPrice, $totalWeight, $shipment_type, $status, $addressId, $walletId, $active)
    {
        $stmt = $this->conn->prepare("CALL sp_AddOrder(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiissidiiiiii", $handling, $userId, $sellerId, $orderNumber,  $taxNumber, $totalQuantity, $totalPrice, $totalWeight, $shipment_type, $status, $addressId, $walletId, $active);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }

    /**
     * Edit order
     * @param orderId, username, password
     * returns Boolean
     */
    public function editOrder($orderId, $userId, $ordernumber, $statusId, $blockId, $active)
    {
        $stmt = $this->conn->prepare("CALL sp_EditOrder(?,?,?,?,?,?)");
        $stmt->bind_param("iiiiii", $orderId, $userId, $ordernumber, $statusId, $blockId, $active);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * Get all orders
     * returns json/Null
     */
    public function GetOrders()
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrders()");
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get all orders
     * returns json/Null
     */
    public function GetOrderBySupplierId($supplierId,$from,$to)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderBySupplierId(?,?,?)");
        $stmt->bind_param("iss", $supplierId,$from,$to);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get supplier payments
     * parameters {supplierId, from, to, start_from, num_rec_per_page}
     * returns json/Null
     */
    public function GetPaymentsBySupplierId($supplierId,$from,$to,$start_from,$num_rec_per_page)
    {
        $stmt = $this->conn->prepare("CALL sp_GetPaymentsBySupplierId(?,?,?,?,?)");
        $stmt->bind_param("issii", $supplierId,$from,$to,$start_from,$num_rec_per_page);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get supplier payments count
     * parameters {supplierId, from, to, start_from, num_rec_per_page}
     * returns json/Null
     */
    public function GetPaymentscount($supplierId,$from,$to)
    {
        $stmt = $this->conn->prepare("CALL sp_GetPaymentscount(?,?,?)");
        $stmt->bind_param("iss", $supplierId,$from,$to);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc(); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get order userId
     * Parameters {orderId}
     * returns json/Null
     */
    public function GetOrderUserId($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderUserId(?)");
        $stmt->bind_param("i", $orderId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get order by ordernumber
     * Parameters {ordernumber}
     * returns json/Null
     */
    public function GetOrderByOrdernumber($ordernumber)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderByOrdernumber(?)");
        $stmt->bind_param("s", $ordernumber);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get supplier uncompleted orders count
     * Parameters {userId}
     * returns json/Null
     */
    public function GetUncompletedOrders($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetUncompletedOrders(?)");
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get supplier uncompleted quotations count
     * Parameters {userId}
     * returns json/Null
     */
    public function GetUncompletedQuotations($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetUncompletedQuotations(?)");
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $quotations = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($quotations == true) {
                return $quotations;
            }
        } else return NULL;
    }
    /**
     * Get order payment by orderId
     * Parameters {orderId}
     * returns json/Null
     */
    public function GetOrderPayment($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderPayment(?)");
        $stmt->bind_param("i", $orderId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    public function AddOrderToSellerPayments($orderId, $orderNumber, $payment_type, $payment_fees, $shipment_fees, $jb_fees, $total_price, $ref_id, $status)
    {
        $stmt = $this->conn->prepare("CALL sp_AddOrderToSellerPayments(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isiddddss", $orderId, $orderNumber, $payment_type, $payment_fees, $shipment_fees, $jb_fees, $total_price, $ref_id, $status);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    public function UpdateOrderSellerPayments($orderNumber, $ref_id, $status)
    {
        $stmt = $this->conn->prepare("CALL sp_UpdateOrderSellerPayments(?,?,?)");
        $stmt->bind_param("sss",$orderNumber, $ref_id, $status);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function AddOrderToBuyerPayments($orderNumber, $payment_type, $payment_fees, $shipment_fees, $jb_fees, $total_price, $ref_id, $status)
    {
        $stmt = $this->conn->prepare("CALL sp_AddOrderToBuyerPayments(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("siddddss", $orderNumber, $payment_type, $payment_fees, $shipment_fees, $jb_fees, $total_price, $ref_id, $status);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    public function UpdateOrderBuyerPayments($orderNumber, $ref_id, $status)
    {
        $stmt = $this->conn->prepare("CALL sp_UpdateOrderBuyerPayments(?,?,?)");
        $stmt->bind_param("sss",$orderNumber, $ref_id, $status);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function UpdatePaymentReceipt($paymentId,$receipt)
    {
        $stmt = $this->conn->prepare("CALL sp_UpdatePaymentReceipt(?,?)");
        $stmt->bind_param("is", $paymentId,$receipt);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    /**
     * Get domestic shipment rate
     * Parameters {country, weight}
     * returns json/Null
     */
    public function getDomesticRateByCountry($country,$weight)
    {
        $stmt = $this->conn->prepare("CALL sp_getDomesticRateByCountry(?,?)");
        $stmt->bind_param("sd", $country,$weight);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }

    /**
     * Get all orders
     * params order Id
     * returns json/Null
     */
    public function GetOrderById($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderById(?)");
        $stmt->bind_param("i", $orderId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc(); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get order by orderdetailId
     * params {orderdetailId}
     * returns json/Null
     */
    public function GetOrderByOrderDetailId($orderdetailId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderByOrderDetailId(?)");
        $stmt->bind_param("i", $orderdetailId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc(); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }

    /**
     * Get orders by user id
     * params userId
     * returns json/Null
     */
    public function GetOrdersByUserId($userId,$from,$to)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrdersByUserId(?,?,?)");
        $stmt->bind_param("iss", $userId,$from,$to);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get orders by supplier id
     * params supplierId
     * returns json/Null
     */
    public function GetOrdersBySupplierId($supplierId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrdersBySupplierId(?)");
        $stmt->bind_param("i", $supplierId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Delete order By Id
     * params order Id
     * returns json/Null
     */
    public function DeleteOrderById($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteOrderbyId(?)");
        $stmt->bind_param("i", $orderId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    /**
     * Get order and its detail by user id
     * params userId
     * returns json/Null
     */
    public function GetOrderDetailByUserId($userId, $from, $to)
    {
        $stmt = $this->conn->prepare("CALL sp_GetOrderDetailByUserId(?,?,?)");
        $stmt->bind_param("iss", $userId, $from, $to);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }
    /**
     * Get order everything
     * params userId
     * returns json/Null
     */
    public function GetReceivedOrderDetails($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetReceivedOrderDetails(?)");
        $stmt->bind_param("i", $orderId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }

    /**
     * Submit quotation
     * params
     * returns json/Null
     */
    public function AddQuotation($user_id,$seller_id,$product_id,$required_by)
    {
        $stmt = $this->conn->prepare("CALL sp_AddQuotation(?,?,?,?)");
        $stmt->bind_param("iiis", $user_id,$seller_id,$product_id,$required_by);
        if ($stmt->execute()) {
            $negotiation = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $negotiation;
        } else return false;
    }

    /**
     * Get quotation by user id
     * params user_id
     * returns json/Null
     */
    public function GetQuotations($userId,$from,$to)
    {
        $stmt = $this->conn->prepare("CALL sp_GetQuotations(?,?,?)");
        $stmt->bind_param("iss", $userId,$from,$to);
        if ($stmt->execute()) {
            $quotations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($quotations == true) {
                return $quotations;
            }
        } else return NULL;
    }


    /**
     * Get seller quotation
     * params user_id
     * returns json/Null
     */
    public function GetSellerQuotations($seller_id, $from, $to)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerQuotations(?,?,?)");
        $stmt->bind_param("iss", $seller_id, $from, $to);
        if ($stmt->execute()) {
            $quotations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($quotations == true) {
                return $quotations;
            }
        } else return NULL;
    }

    /**
     * Get quotation by id
     * params user_id
     * returns json/Null
     */
    public function GetSellerQuotationById($qid,$sid)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerQuotationById(?,?)");
        $stmt->bind_param("ii", $qid,$sid);
        if ($stmt->execute()) {
            $quotation = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($quotation == true) {
                return $quotation;
            }
        } else return NULL;
    }
    /**
     * Get quotation by id
     * params user_id
     * returns json/Null
     */
    public function GetBuyerQuotationById($qid,$sid)
    {
        $stmt = $this->conn->prepare("CALL sp_GetBuyerQuotationById(?,?)");
        $stmt->bind_param("ii", $qid,$sid);
        if ($stmt->execute()) {
            $quotation = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($quotation == true) {
                return $quotation;
            }
        } else return NULL;
    }

    /**
     * Change quotation status
     * params user_id
     * returns json/Null
     */
    public function ChangeQuotationStatus($quoid,$quoqty,$quoprice, $quostatus)
    {
        $stmt = $this->conn->prepare("CALL sp_ChangeQuotationStatus(?,?,?,?)");
        $stmt->bind_param("iiis", $quoid,$quoqty,$quoprice,$quostatus);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    /**
     * Modified quotation with Price
     * params seller_id needs to be set later
     * returns json/Null
     */
    public function ModifyQuotationBySeller($qid, $qqty, $buyerprice, $sellerprice)
    {
        $stmt = $this->conn->prepare("CALL sp_ModifyQuotationBySeller(?,?,?,?)");
        $stmt->bind_param("iiii", $qid, $qqty, $buyerprice, $sellerprice);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    /**
     * Modified quotation with Price
     * params seller_id needs to be set later
     * returns json/Null
     */
    public function ModifyQuotationByBuyer($qid, $qqty, $buyerprice, $sellerprice)
    {
        $stmt = $this->conn->prepare("CALL sp_ModifyQuotationByBuyer(?,?,?,?)");
        $stmt->bind_param("iiii", $qid, $qqty, $buyerprice, $sellerprice);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    /**
     * Create negotiation
     * params user_id
     * returns json/Null
     */
    public function CreateNegotiation($quotation_id,$quantity,$buyer_price,$comment)
    {
        $stmt = $this->conn->prepare("CALL sp_CreateNegotiation(?,?,?,?)");
        $stmt->bind_param("iiis", $quotation_id,$quantity,$buyer_price,$comment);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    /**
     * Get negotiations of quotation by id
     * params user_id
     * returns json/Null
     */
    public function GetNegotiationsOfQuotation($qid)
    {
        $stmt = $this->conn->prepare("CALL sp_GetNegotiationsOfQuotation(?)");
        $stmt->bind_param("i", $qid);
        if ($stmt->execute()) {
            $negotiations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($negotiations == true) {
                return $negotiations;
            }
        } else return NULL;
    }

    /**
     * Change negotiation status by id and seller id
     * params user_id
     * returns json/Null
     */
    public function ChangeNegotiationStatus($nid,$nstatus,$comment)
    {
        $stmt = $this->conn->prepare("CALL sp_ChangeNegotiationStatus(?,?,?)");
        $stmt->bind_param("iss", $nid,$nstatus,$comment);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }


    /**
     * Get negotiation details by id
     * params user_id
     * returns json/Null
     */
    public function getNegotiationDetailsById($nid)
    {
        $stmt = $this->conn->prepare("CALL sp_getNegotiationDetailsById(?)");
        $stmt->bind_param("i", $nid);
        if ($stmt->execute()) {
            $negotiation = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $negotiation;
        } else return false;
    }

    /**
     * Change negotiation status by buyer id
     * params
     * returns json/Null
     */
    public function ChangeNegotiationStatusByBuyer($nid,$nstatus,$comment)
    {
        $stmt = $this->conn->prepare("CALL sp_ChangeNegotiationStatusByBuyer(?,?,?)");
        $stmt->bind_param("iss", $nid,$nstatus,$comment);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    /**
     * Delete cart
     * @param user id
     * returns Boolean
     */
    public function DeleteAllCartByUserId($uid)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteAllCartByUserId(?)");
        $stmt->bind_param("i", $uid);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }

    /**
     * Cancel order
     * @param order id, user id
     * returns Boolean
     */
    public function cancelOrder($order, $user){
        $stmt = $this->conn->prepare("CALL sp_cancelOrder(?,?)");
        $stmt->bind_param("ii", $order, $user);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * Cancel order from seller
     * @param order id, user id
     * returns Boolean
     */
    public function cancelOrderBySeller($order, $user){
        $stmt = $this->conn->prepare("CALL sp_cancelOrderBySeller(?,?)");
        $stmt->bind_param("ii", $order, $user);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    public function CompleteOrderSeller($orderId){
        $stmt = $this->conn->prepare("CALL sp_CompleteOrderSeller(?)");
        $stmt->bind_param("i", $orderId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * Refund order
     * param order id, user id
     * returns Boolean
     */
    public function refundOrder($order, $user){
        $stmt = $this->conn->prepare("CALL sp_refundOrder(?,?)");
        $stmt->bind_param("ii", $order, $user);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * get order seller and product name
     * parameters orderId
     * returns json/null
     */
    public function GetOrderUserandProductName($orderdetailId){
        $stmt = $this->conn->prepare("CALL sp_GetOrderUserandProductName(?)");
        $stmt->bind_param("i", $orderdetailId);
        $result = $stmt->execute();
        $order = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($order) return $order;
        else return NULL;
    }

    /**
     * add orderdetail shipment
     * parameters {orderId, shipped_by, type, cost, awbpdf}
     * returns json/Null
     */
    public function addshipment($orderId, $type, $shipped_by, $cost)
    {
        $stmt = $this->conn->prepare("CALL sp_addshipment(?,?,?,?)");
        $stmt->bind_param("iiid", $orderId, $type, $shipped_by, $cost);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * add orderdetail shipment
     * parameters {orderId, shipped_by, type, cost, awbpdf}
     * returns json/Null
     */
    public function addexpressshipment($orderId, $type, $shipped_by, $cost, $awb, $trknb)
    {
        $stmt = $this->conn->prepare("CALL sp_addexpressshipment(?,?,?,?,?,?)");
        $stmt->bind_param("iiidss", $orderId, $type, $shipped_by, $cost, $awb, $trknb);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    public function addshipmentreceipt($orderId,$shipment_receipt)
    {
        $stmt = $this->conn->prepare("CALL sp_addshipmentreceipt(?,?)");
        $stmt->bind_param("is", $orderId,$shipment_receipt);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * add awb pdf to order shipment
     * parameters {orderId}
     * returns boolean
     */
     public function updateAWBpdf($orderId,$file,$awbnumber){
       $stmt = $this->conn->prepare("CALL sp_updateAWBpdf(?,?,?)");
       $stmt->bind_param("isi",$orderId,$file,$awbnumber);
       $result = $stmt->execute();
       $stmt->close();
       if($result) return true;
       else return false;
   }
    /**
     * Get certain order shipment details
     * parameters {orderdetailsId}
     * returns json/Null
     */
    public function GetshipmentByOrderId($orderId) {
        $stmt = $this->conn->prepare("CALL sp_GetshipmentByOrderId(?)");
        $stmt->bind_param("i",$orderId);
        if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($orders) return $orders;
            else return NULL;
        } else return NULL;
    }
    /*************************Admin Functions********************************/
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallOrders()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallOrders()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getOrderById($id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getOrderById(?)");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function getPaymentById($paymentId)
    {
        $stmt = $this->conn->prepare("CALL sp_getPaymentById(?)");
        $stmt->bind_param("i", $paymentId);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    public function getPaymentByOrderId($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_getPaymentByOrderId(?)");
        $stmt->bind_param("i", $orderId);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    public function getPaymentByOrderNumber($ordernumber)
    {
        $stmt = $this->conn->prepare("CALL sp_getPaymentByOrderNumber(?)");
        $stmt->bind_param("s", $ordernumber);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    public function cancelPaymentByOrderNumber($ordernumber)
    {
        $stmt = $this->conn->prepare("CALL sp_cancelPaymentByOrderNumber(?)");
        $stmt->bind_param("s", $ordernumber);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    public function cancelPaymentByOrderId($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_cancelPaymentByOrderId(?)");
        $stmt->bind_param("i", $orderId);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    public function cancelShipmentByOrderId($orderId)
    {
        $stmt = $this->conn->prepare("CALL sp_cancelShipmentByOrderId(?)");
        $stmt->bind_param("i", $orderId);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    public function getAsyadRate($weight)
    {
        $stmt = $this->conn->prepare("CALL sp_getAsyadRate(?)");
        $stmt->bind_param("i", $weight);
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $order;
        } else {
            return NULL;
        }
    }
    public function Admin_getbanktransfers(){
      $stmt = $this->conn->prepare("CALL sp_Admin_getbanktransfers()");
      if ($stmt->execute()) {
          $banktransfers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
          $stmt->close();
          if ($banktransfers == true) {
              return $banktransfers;
          }
      } else return NULL;
    }
    public function Admin_updatebuyerbanktransfer($ordernumber,$status){
      $stmt = $this->conn->prepare("CALL sp_Admin_updatebuyerbanktransfer(?,?)");
      $stmt->bind_param("ss", $ordernumber,$status);
      $result = $stmt->execute();
      $stmt->close();
      if($result) return true;
      else return false;
    }
    public function Admin_updatesellerbanktransfer($ordernumber,$status){
      $stmt = $this->conn->prepare("CALL sp_Admin_updatesellerbanktransfer(?,?)");
      $stmt->bind_param("ss", $ordernumber,$status);
      $result = $stmt->execute();
      $stmt->close();
      if($result) return true;
      else return false;
    }
    public function Admin_updaterefund($refundId,$statusId){
      $stmt = $this->conn->prepare("CALL sp_Admin_updaterefund(?,?)");
      $stmt->bind_param("si", $refundId,$statusId);
      $result = $stmt->execute();
      $stmt->close();
      if($result) return true;
      else return false;
    }
}
