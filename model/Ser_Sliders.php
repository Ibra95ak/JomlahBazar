<?php
class Ser_Sliders {
    private $conn;
    /*constructor*/
    function __construct() {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /* destructor*/
    function __destruct() {

    }
    /**
     * storing new slider
     * parameters header1,header2,path,btn_link,btn_text
     * returns boolean
     */
    public function addSlider($header1, $header2, $path,  $btn_link, $btn_text, $active){
      $stmt = $this->conn->prepare("CALL sp_AddSlider(?,?,?,?,?,?)");
  		$stmt->bind_param("sssssi",$header1, $header2, $path, $btn_link, $btn_text, $active);
  		$result = $stmt->execute();
      $stmt->close();
      /*check for successful store*/
      if ($result) return true;
      else return false;
    }
    /**
     * Edit slider
     * parameters sliderId, header1, header2, path, btn_link, btn_text
     * returns boolean
     */
    public function editSlider($sliderId, $header1, $header2, $path, $btn_link, $btn_text, $active) {
      $stmt = $this->conn->prepare("CALL sp_EditSlider(?,?,?,?,?,?,?)");
      $stmt->bind_param("isssssi",$sliderId, $header1, $header2, $path, $btn_link, $btn_text, $active);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    /**
     * Get all sliders
     * returns json/Null
     */
    public function GetSliders() {
      $stmt = $this->conn->prepare("CALL sp_GetSliders()");
      if ($stmt->execute()) {
        $sliders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and create json object*/
        $stmt->close();
        if ($sliders) return $sliders;
        else return NULL;
      }
    }
    /**
     * Get slider by id
     * parameters sliderId
     * returns json/Null
     */
    public function GetSliderById($sliderId) {
      $stmt = $this->conn->prepare("CALL sp_GetSliderById(?)");
      $stmt->bind_param("i",$sliderId);
      if ($stmt->execute()) {
        $slider = $stmt->get_result()->fetch_assoc();  /*fetch data and create json object*/
        $stmt->close();
        if ($slider) return $slider;
        else return NULL;
      }
    }
    /**
     * Delete slider by id
     * parameters sliderId
     * returns boolean
     */
    public function DeleteSliderById($sliderId) {
      $stmt = $this->conn->prepare("CALL DeleteSliderById(?)");
      $stmt->bind_param("i",$sliderId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
      if ($result) return true;
      else return false;
    }
}
?>
