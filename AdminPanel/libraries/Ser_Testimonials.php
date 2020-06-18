<?php
class Ser_Testimonials {
    private $conn;
    /*constructor*/
    function __construct() {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    function __destruct() {

    }
    /**
     * get all testimonials
     * returns json/Null
     */
     public function Gettestimonials() {
       $stmt = $this->conn->prepare("CALL sp_Gettestimonials()");
       if ($stmt->execute()) {
         $testimonials = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
         $stmt->close();
         if ($testimonials) return $testimonials;
         else return NULL;
       } else return NULL;
    }
    /**
     * get latest 6 testimonials
     * returns json/Null
     */
     public function GetLatesttestimonials() {
       $stmt = $this->conn->prepare("CALL sp_GetLatesttestimonials()");
       if ($stmt->execute()) {
         $testimonials = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
         $stmt->close();
         if ($testimonials) return $testimonials;
         else return NULL;
       } else return NULL;
    }
    /**
     * get testimonial by id
     * params testimonialId
     * returns json/Null
     */
     public function GetTestimonialById($testimonialId) {
       $stmt = $this->conn->prepare("CALL sp_GetTestimonialById(?)");
       $stmt->bind_param("i",$testimonialId);
       if ($stmt->execute()) {
         $testimonials = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
         $stmt->close();
         if ($testimonials==true) return $testimonials;
         else return NULL;
       } else return NULL;
    }
    /**
     * storing new testimonial
     * parameters name,description,path,active
     * returns boolean
     */
     public function addTestimonial($name,$description,$path,$active) {
       $stmt = $this->conn->prepare("CALL sp_AddTestimonial(?,?,?,?)");
       $stmt->bind_param("sssi",$name,$description,$path,$active);
       $result = $stmt->execute();
       $stmt->close();
        /*heck for successful store*/
        if ($result) return true;
        else return false;
    }
    /**
     * edit testimonial
     * parameters testimonialId,name,description,pictureId,active
     * returns boolean
     */
     public function editTestimonial($testimonialId,$name,$description,$path,$active) {
       $stmt = $this->conn->prepare("CALL sp_EditTestimonial(?,?,?,?,?)");
       $stmt->bind_param("isssi",$testimonialId,$name,$description,$path,$active);
       $result = $stmt->execute();
       $stmt->close();
       if($result) return true;
       else return false;
    }
    /**
     * delete testimonial by id
     * params testimonialId
     * returns boolean
     */
     public function DeleteTestimonialById($testimonialId) {
       $stmt = $this->conn->prepare("CALL sp_DeleteTestimonialbyId(?)");
       $stmt->bind_param("i",$testimonialId);
       $result = $stmt->execute();
       $stmt->close();
       if($result) return true;
       else return false;
    }
}
?>
