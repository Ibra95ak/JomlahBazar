<?php 
class Ser_Creditcarddetails {
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
     * Get all Creditcarddetails 
     * returns json/Null
     */
    public function Getcreditcarddetails() {
        $stmt = $this->conn->prepare("CALL sp_GetCreditcarddetails()");
        if ($stmt->execute()) {
            $creditcarddetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch creditcarddetails data and creditcarddetails in array
            $stmt->close();
            if ($creditcarddetails==true) {
                return $creditcarddetails;
            }
        } else return NULL;
    }
    
    /**
     * Get all creditcarddetails 
     * params creditcarddetails Id
     * returns json/Null
     */
    public function GetCreditcarddetailsById($creditcarddetailsId) {
        $stmt = $this->conn->prepare("CALL sp_GetCreditcarddetailsById(?)");
        $stmt->bind_param("i",$creditcarddetailsId);
        if ($stmt->execute()) {
            $creditcarddetails = $stmt->get_result()->fetch_assoc(); //fetch creditcarddetails data and creditcarddetails in array
            $stmt->close();
            if ($creditcarddetails==true) {
                return $creditcarddetails;
            }
        } else return NULL;
    }

        /**
     * Delete creditcarddetails By Id 
     * params creditcarddetails Id
     * returns json/Null
     */
    public function DeleteCreditcarddetailById($creditcarddetailId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCreditcarddetailbyId(?)");
        $stmt->bind_param("i",$creditcarddetailId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>