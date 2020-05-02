<?php 
class Ser_Faqs {
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
     * Storing new Faq
     * @param type,active
     * returns Boolean
     */
    public function addFaq($question,$answer,$position,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddFaq(?,?,?,?)");
		$stmt->bind_param("ssii",$question,$answer,$position,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    /**
     * Edit faq 
     * @param faqId, username, password
     * returns Boolean
     */
    public function editFaq($faqId,$question,$answer,$position,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditFaq(?,?,?,?,?)");
		$stmt->bind_param("issii",$faqId,$question,$answer,$position,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    	
    /**
     * Get all Faqs 
     * returns json/Null
     */
    public function Getfaqs() {
        $stmt = $this->conn->prepare("CALL sp_GetFaqs()");
        if ($stmt->execute()) {
            $faqs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch faq data and faq in array
            $stmt->close();
            if ($faqs==true) {
                return $faqs;
            }
        } else return NULL;
    }
    
    /**
     * Get all faqs 
     * params faq Id
     * returns json/Null
     */
    public function GetFaqById($faqId) {
        $stmt = $this->conn->prepare("CALL sp_GetFaqById(?)");
        $stmt->bind_param("i",$faqId);
        if ($stmt->execute()) {
            $faqs = $stmt->get_result()->fetch_assoc(); //fetch faq data and faq in array
            $stmt->close();
            if ($faqs==true) {
                return $faqs;
            }
        } else return NULL;
    }

        /**
     * Delete faq By Id 
     * params faq Id
     * returns json/Null
     */
    public function DeleteFaqById($faqId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteFaqbyId(?)");
        $stmt->bind_param("i",$faqId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>