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
     * Get all product reviews
     * parameters {productId}
     * returns json/Null
     */
    public function GetReviewsByproductId($productId) {
        $stmt = $this->conn->prepare("CALL sp_GetReviewsByproductId(?)");
        $stmt->bind_param("i",$productId);
        if ($stmt->execute()) {
            $reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch review data and review in array
            $stmt->close();
            if ($reviews==true) {
                return $reviews;
            }
        } else return NULL;
    }
    /**
     * Get all users reviews
     * parameters {productId}
     * returns json/Null
     */
    public function GetReviewsBysupplierId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetReviewsBysupplierId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch review data and review in array
            $stmt->close();
            if ($reviews==true) {
                return $reviews;
            }
        } else return NULL;
    }
/**
     * Storing new Review
     * returns Boolean
     */
    public function addReview($productId, $userId, $stars, $description, $active) {
        $stmt = $this->conn->prepare("CALL sp_AddReview(?,?,?,?,?)");
		$stmt->bind_param("iiisi",$productId,$userId,$stars,$description,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
/**
     * Storing new Review
     * returns Boolean
     */
    public function addUserReview($supplierId, $userId, $stars, $description, $active) {
        $stmt = $this->conn->prepare("CALL sp_AdduserReview(?,?,?,?,?)");
		$stmt->bind_param("iiisi",$supplierId,$userId,$stars,$description,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit review
     * @param reviewId, username, password
     * returns Boolean
     */
    public function editReview($reviewId,$stars,$description) {
        $stmt = $this->conn->prepare("CALL sp_EditReview(?,?,?)");
		$stmt->bind_param("iis",$reviewId,$stars,$description);
        $result = $stmt->execute();
        $stmt->close();
		if($result) return true;
		else return false;
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
    /**
     * update product ranking
     * @param productId,ranking
     * returns Boolean
     */
    public function UpdateProductRanking($productId,$ranking) {
        $stmt = $this->conn->prepare("CALL sp_UpdateProductRanking(?,?)");
    $stmt->bind_param("id",$productId,$ranking);
        $result = $stmt->execute();
        $stmt->close();
    if($result) return true;
    else return false;
    }

}
?>
