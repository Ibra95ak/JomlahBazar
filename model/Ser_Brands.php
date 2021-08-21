<?php
/**
  ** brands object
  * GetallBrands --> get all brands
  * getActivebrands --> get all active brands
  * GetBrandById --> get a brand details
  * addBrand --> add new brand
  * editBrand --> edit brand details
  * GetallbrandsByCategoryId --> get all brands having same category
  * DeleteBrandById --> delete a brand
  * GetBrandCategories --> get brand categories
  * addBrandCategory --> add brand category
  * DeleteBrandCategories --> delete all brand categories
  ****    Admin functions   ****
  * Admin_getallBrands --> get all brands
  */
class Ser_Brands
{
    private $conn;
    /*constructor*/
    public function __construct()
    {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    public function __destruct()
    {
    }
    /**
     * get all brands
     * parameters {}
     * returns json/Null
     */
    public function GetallBrands()
    {
        $stmt = $this->conn->prepare("CALL sp_GetallBrands()");
        if ($stmt->execute()) {
            $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($brands==true) return $brands;
            else return null;
        } else return null;
    }
    /**
     * get all brands having same category
     * parameters {categoryId}
     * returns json/Null
     */
    public function GetallbrandsByCategoryId($categoryId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetallbrandsByCategoryId(?)");
        $stmt->bind_param("s", $categoryId);
        if ($stmt->execute()) {
            $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($brands==true) return $brands;
            else return null;
        } else return null;
    }
    /**
     * get all active brands
     * parameters {}
     * returns json/Null
     */
    public function GetActivebrands()
    {
        $stmt = $this->conn->prepare("CALL sp_GetActivebrands()");
        if ($stmt->execute()) {
            $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($brands) return $brands;
            else return null;
        } else return null;
    }
    /**
     * add new brand
     * parameters {brand_name,path,active}
     * returns json/null
     */
    public function addBrand($brand_name, $path, $active)
    {
        $stmt = $this->conn->prepare("CALL sp_AddBrand(?,?,?)");
        $stmt->bind_param("ssi", $brand_name, $path, $active);
        $stmt->execute();
        $brands = $stmt->get_result()->fetch_assoc();
        /*check for successful store*/
        if ($brands) return $brands;
        else return null;
    }
    /**
     * edit brand
     * parameters {brandId,brand_name,path,active}
     * returns Boolean
     */
    public function editBrand($brandId, $brand_name, $path, $active)
    {
        $stmt = $this->conn->prepare("CALL sp_EditBrand(?,?,?,?)");
        $stmt->bind_param("issi", $brandId, $brand_name, $path, $active);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful update*/
        if ($result) return true;
        else return false;
    }
    /**
     * get a brand details
     * parameters {brandId}
     * returns json/Null
     */
    public function GetBrandById($brandId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetBrandById(?)");
        $stmt->bind_param("i", $brandId);
        if ($stmt->execute()) {
            $brands = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($brands==true) return $brands;
            else return null;
        } else return null;
    }
    /**
     * delete brand
     * parameters {brandId}
     * returns boolean
     */
    public function DeleteBrandById($brandId)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteBrandbyId(?)");
        $stmt->bind_param("i", $brandId);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful delete*/
        if ($result) return true;
        else return false;
    }
    /**
     * get all brand categories
     * parameters {brandId}
     * returns json/Null
     */
    public function GetBrandCategories($brandId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetBrandCategories(?)");
        $stmt->bind_param("i", $brandId);
        if ($stmt->execute()) {
            $brand_categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($brand_categories) return $brand_categories;
            else return null;
        } else return null;
    }
    /**
     * add new brand category
     * parameters {brandId,categoryId}
     * returns json/null
     */
    public function addBrandCategory($brandId, $categoryId)
    {
        $stmt = $this->conn->prepare("CALL sp_addBrandCategory(?,?)");
        $stmt->bind_param("ii", $brandId, $categoryId);
        $result = $stmt->execute();
        $brand_categories = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        /*check for successful store*/
        if ($result) return $brand_categories;
        else return Null;
    }
    /**
     * delete brand categories
     * parameters brandId
     * returns boolean
     */
    public function DeleteBrandCategories($brandId)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteBrandCategories(?)");
        $stmt->bind_param("i", $brandId);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful delete*/
        if ($result) return true;
        else return false;
    }
    /**
     * Get all Maincategories
     * returns json/Null
     */
    public function GetBrandProductsCount($brandId) {
        $stmt = $this->conn->prepare("CALL sp_GetBrandProductsCount(?)");
        $stmt->bind_param("i",$brandId);
        if ($stmt->execute()) {
            $Maincategories = $stmt->get_result()->fetch_assoc(); //fetch Maincategories data and store in array
            $stmt->close();
            if ($Maincategories==true) {
                return $Maincategories;
            }
        } else return NULL;
    }
    /*************************Admin Functions********************************/
    /**
     * Get all brands
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallBrands()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallBrands()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) return $users;
        else return null;
    }
}
