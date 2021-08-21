<?php
/**
  ** Notification object
  * AddUserNotification --> Add notification details for a specific user
  * notificationseen --> change notification status to seen
  * getNotification --> get user notifications by type
  * getUnseenNotifications  --> get all unseen notifications older than 1 day
  */
class Ser_Notif{
    /*database connection variable*/
    private $conn;
    /*constructor*/
    public function __construct()
    {
        /*connecting to database*/
        require_once 'DB_Connect.php';
        /*creating connection instance*/
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    public function __destruct()
    {
    }
    /**
     * Add notification details for a specific user
     * parameters {userId, orderId, type}
     * returns boolean
     */
    public function AddUserNotification($userId, $orderId, $type){
        $stmt = $this->conn->prepare("CALL sp_AddUserNotification(?,?,?)");
		    $stmt->bind_param("iii",$userId,$orderId,$type);
		    $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    /**
     * change notification status to seen
     * parameters {userId, orderId}
     * returns boolean
     */
    public function notificationseen($userId,$orderId){
        $stmt = $this->conn->prepare("CALL sp_notificationseen(?,?)");
		    $stmt->bind_param("ii",$userId,$orderId);
		    $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    /**
     * get user notifications by type
     * parameters {userId, type, message, status}
     * returns boolean
     */
    public function getNotification($id,$type){
      $stmt = $this->conn->prepare("CALL sp_GetNotification(?,?)");
      $stmt->bind_param("is",$id,$type);
  		if ($stmt->execute()) {
        $notifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        if ($notifications) return $notifications;
        else return NULL;
      }else return NULL;
    }
    /**
     * get unseen notifications older than 1 day
     * parameters {}
     * returns json/null
     */
    public function getUnseenNotifications(){
      $stmt = $this->conn->prepare("CALL sp_getUnseenNotifications()");
      if ($stmt->execute()) {
        $notifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        if ($notifications) return $notifications;
        else return NULL;
      }else return NULL;
    }
}
