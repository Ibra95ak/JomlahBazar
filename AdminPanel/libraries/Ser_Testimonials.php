<?php 
class Ser_Testimonials {
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
     * Get all testimonials 
     * returns json/Null
     */
    public function Gettestimonials() {
        $stmt = $this->conn->prepare("CALL sp_Gettestimonials()");
        if ($stmt->execute()) {
            $testimonials = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch testimonial data and testimonial in array
            $stmt->close();
            if ($testimonials==true) {
                return $testimonials;
            }
        } else return NULL;
    }
    
    /**
     * Get all testimonials 
     * params testimonial Id
     * returns json/Null
     */
    public function GetTestimonialById($testimonialId) {
        $stmt = $this->conn->prepare("CALL sp_GetTestimonialById(?)");
        $stmt->bind_param("i",$testimonialId);
        if ($stmt->execute()) {
            $testimonials = $stmt->get_result()->fetch_assoc(); //fetch testimonial data and testimonial in array
            $stmt->close();
            if ($testimonials==true) {
                return $testimonials;
            }
        } else return NULL;
    }
    /**
     * Storing new Testimonial
     * returns Boolean
     */
    public function addTestimonial($name,$description,$pictureId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddTestimonial(?,?,?,?)");
		$stmt->bind_param("ssii",$name,$description,$pictureId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful Testimonial
        if ($result) return true;
        else return false;
    } 

    
    /**
     * Edit testimonial 
     * @param testimonialId, username, password
     * returns Boolean
     */
    public function editTestimonial($testimonialId,$name,$description,$pictureId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditTestimonial(?,?,?,?,?)");
		$stmt->bind_param("issii",$testimonialId,$name,$description,$pictureId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
        /**
     * Delete Testimonial By Id 
     * params Testimonial Id
     * returns json/Null
     */
    public function DeleteTestimonialById($testimonialId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteTestimonialbyId(?)");
        $stmt->bind_param("i",$testimonialId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>