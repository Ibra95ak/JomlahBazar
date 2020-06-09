<?php 
class Ser_Settings {
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
    public function addAboutus($aboutus) {
        $stmt = $this->conn->prepare("CALL sp_AddAboutus(?)");
		$stmt->bind_param("s",$aboutus);
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
    public function editAboutus($aboutus) {
        $stmt = $this->conn->prepare("CALL sp_EditAboutus(?)");
		$stmt->bind_param("s",$aboutus);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    	
    /**
     * Get all Faqs 
     * returns json/Null
     */
    public function GetSettings() {
        $stmt = $this->conn->prepare("CALL sp_GetSettings()");
        if ($stmt->execute()) {
            $faqs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch faq data and faq in array
            $stmt->close();
            if ($faqs==true) {
                return $faqs;
            }
        } else return NULL;
    }
}
?>