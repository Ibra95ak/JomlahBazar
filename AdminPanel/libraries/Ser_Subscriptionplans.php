<?php 
class Ser_Subscriptionplans {
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
     * Get all Subscriptionplans 
     * returns json/Null
     */
    public function GetSubscriptionplans() {
        $stmt = $this->conn->prepare("CALL sp_GetSubscriptionplans()");
        if ($stmt->execute()) {
            $subscriptionplans = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch subscriptionplan data and subscriptionplan in array
            $stmt->close();
            if ($subscriptionplans==true) {
                return $subscriptionplans;
            }
        } else return NULL;
    }
    
    /**
     * Get all subscriptionplans 
     * params subscriptionplan Id
     * returns json/Null
     */
    public function GetSubscriptionplanById($subscriptionplanId) {
        $stmt = $this->conn->prepare("CALL sp_GetSubscriptionplanById(?)");
        $stmt->bind_param("i",$subscriptionplanId);
        if ($stmt->execute()) {
            $subscriptionplans = $stmt->get_result()->fetch_assoc(); //fetch subscriptionplan data and subscriptionplan in array
            $stmt->close();
            if ($subscriptionplans==true) {
                return $subscriptionplans;
            }
        } else return NULL;
    }

        /**
     * Delete Subscriptionplan By Id 
     * params Subscriptionplan Id
     * returns json/Null
     */
    public function DeleteSubscriptionplanById($subscriptionplanId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteSubscriptionplanbyId(?)");
        $stmt->bind_param("i",$subscriptionplanId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>