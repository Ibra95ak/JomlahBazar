<?php


class Ser_Delivery
{
    /*Database connection variable*/
    private $conn;
    /*Constructor*/
    public function __construct()
    {
        /*Connecting to database*/
        require_once 'DB_Connect.php';
        /*Creating a connection instance*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    public function GetDeliveryFee(){
        $stmt = $this->conn->prepare("CALL sp_GetDeliveryFee()");
        if ($stmt->execute()) {
            $delivery_fee = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $delivery_fee;
        } else return false;
    }
   
}
