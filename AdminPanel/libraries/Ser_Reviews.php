<?php 
class Ser_Reviews{
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
     * Get all Reviews
     * returns json/Null
     */
    public function GetReviews() {
        $stmt = $this->conn->prepare("CALL sp_GetReviews()");
        if ($stmt->execute()) {
            $reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch review data and review in array
            $stmt->close();
            if ($reviews==true) {
                return $reviews;
            }
        } else return NULL;
    }
    
    /**
     * Get all reviews 
     * params review Id
     * returns json/Null
     */
    public function GetReviewById($reviewId) {
        $stmt = $this->conn->prepare("CALL sp_GetReviewById(?)");
        $stmt->bind_param("i",$reviewId);
        if ($stmt->execute()) {
            $reviews = $stmt->get_result()->fetch_assoc(); //fetch review data and review in array
            $stmt->close();
            if ($reviews==true) {
                return $reviews;
            }
        } else return NULL;
    }

        /**
     * Delete Review By Id 
     * params Review Id
     * returns json/Null
     */
    public function DeleteReviewById($reviewId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteReviewbyId(?)");
        $stmt->bind_param("i",$reviewId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>