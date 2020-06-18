<?php
class Ser_Brands {
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
     * get all brands
     * returns json/Null
     */
    public function Getbrands() {
      $stmt = $this->conn->prepare("CALL sp_GetBrands()");
      if ($stmt->execute()) {
        $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($brands==true) return $brands;
        else return NULL;
      } else return NULL;
    }
    /**
     * get all brands
     * returns json/Null
     */
    public function searchbrands($sql) {
      $stmt = $this->conn->prepare($sql);
      if ($stmt->execute()) {
        $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($brands==true) return $brands;
        else return NULL;
      } else return NULL;
    }
    /**
     * count brands
     * returns json/Null
     */
    public function countbrands($sql) {
      $stmt = $this->conn->prepare($sql);
      if ($stmt->execute()) {
        $brands = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($brands==true) return $brands;
        else return NULL;
      } else return NULL;
    }
    /**
     * storing new brand
     * parameters brandcategoryId,brand_name,path,active
     * returns Boolean
     */
     public function addBrand($brandcategoryId,$brand_name,$path,$active) {
       $stmt = $this->conn->prepare("CALL sp_AddBrand(?,?,?,?)");
       $stmt->bind_param("issi",$brandcategoryId,$brand_name,$path,$active);
       $result = $stmt->execute();
       $stmt->close();
       /*check for successful store*/
       if ($result) return true;
       else return false;
    }
    /**
     * edit brand
     * parameters brandId,brandcategoryId,brand_name,path,active
     * returns Boolean
     */
    public function editBrand($brandId,$brandcategoryId,$brand_name,$path,$active) {
      $stmt = $this->conn->prepare("CALL sp_EditBrand(?,?,?,?,?)");
      $stmt->bind_param("iissi",$brandId,$brandcategoryId,$brand_name,$path,$active);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful update*/
      if($result) return true;
      else return false;
    }
    /**
     * get all brands
     * parameters brandId
     * returns json/Null
     */
     public function GetBrandById($brandId) {
       $stmt = $this->conn->prepare("CALL sp_GetBrandById(?)");
       $stmt->bind_param("i",$brandId);
       if ($stmt->execute()) {
         $brands = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
         $stmt->close();
         if ($brands==true) return $brands;
         else return NULL;
       } else return NULL;
    }
    /**
     * delete brand by id
     * parameters brandId
     * returns boolean
     */
     public function DeleteBrandById($brandId) {
       $stmt = $this->conn->prepare("CALL sp_DeleteBrandbyId(?)");
       $stmt->bind_param("i",$brandId);
       $result = $stmt->execute();
       $stmt->close();
       /*check for successful delete*/
       if($result) return true;
       else return false;
    }
}
?>
