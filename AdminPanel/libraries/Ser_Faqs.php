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

}
?>