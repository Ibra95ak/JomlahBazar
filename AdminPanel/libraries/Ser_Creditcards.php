<?php 
class Ser_Creditcards {
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
     * Storing new Creditcard
     * @param type,active
     * returns Boolean
     */
    public function addCreditcard($card_number,$card_expMO,$card_expYR,$creditcarddetailId) {
        $stmt = $this->conn->prepare("CALL sp_AddCreditcard(?,?,?,?)");
		$stmt->bind_param("ssii",$card_number,$card_expMO,$card_expYR,$creditcarddetailId);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit Creditcard 
     * returns Boolean
     */
    public function editCreditcard($creditcardId,$card_number,$card_expMO,$card_expYR,$creditcarddetailId) {
        $stmt = $this->conn->prepare("CALL sp_EditCreditcard(?,?,?,?,?)");
		$stmt->bind_param("isssi",$creditcardId,$card_number,$card_expMO,$card_expYR,$creditcarddetailId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    	
    /**
     * Get all creditcards 
     * returns json/Null
     */
    public function Getcreditcards() {
        $stmt = $this->conn->prepare("CALL sp_GetCreditcards()");
        if ($stmt->execute()) {
            $creditcards = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch creditcard data and creditcard in array
            $stmt->close();
            if ($creditcards==true) {
                return $creditcards;
            }
        } else return NULL;
    }
    
    /**
     * Get all creditcards 
     * params creditcard Id
     * returns json/Null
     */
    public function GetCreditcardById($creditcardId) {
        $stmt = $this->conn->prepare("CALL sp_GetCreditcardById(?)");
        $stmt->bind_param("i",$creditcardId);
        if ($stmt->execute()) {
            $creditcards = $stmt->get_result()->fetch_assoc(); //fetch creditcard data and creditcard in array
            $stmt->close();
            if ($creditcards==true) {
                return $creditcards;
            }
        } else return NULL;
    }

        /**
     * Delete creditcard By Id 
     * params creditcard Id
     * returns json/Null
     */
    public function DeleteCreditcardById($creditcardId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCreditCardbyId(?)");
        $stmt->bind_param("i",$creditcardId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>