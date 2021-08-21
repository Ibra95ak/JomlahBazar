<?php
/**
  ** categories object
  * addCategory --> add new category
  * editCategory --> edit category
  * GetallCategories --> get all categories
  * GetallactiveCategories --> get all active categories
  * GetCategoryById --> Get category details
  * DeleteCategoryById --> delete category
  * FilterSearchProductsCategories --> Get categories from product name
  * GetCategoryProductsCount --> Get categories total products count
  ****    Admin functions   ****
  * Admin_getallCategories --> get all categories
  */
class Ser_Categories {
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
     * add new Category
     * parameters {name, icon, active}
     * returns json/NULL
     */
    public function addCategory($name,$icon,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddCategory(?,?,?)");
    		$stmt->bind_param("ssi",$name,$icon,$active);
    		$result = $stmt->execute();
        $categories = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        // check for successful store
        if ($categories) return $categories;
        else return NULL;
    }
    /**
     * Edit category
     * parameters {categoryId, name, icon, active}
     * returns Boolean
     */
    public function editCategory($categoryId,$name,$icon,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditCategory(?,?,?,?)");
		    $stmt->bind_param("issi",$categoryId,$name,$icon,$active);
        $result = $stmt->execute();
        $stmt->close();
    		if($result) return true;
    		else return false;
    }
    /**
     * Get all categories
     * parameters {}
     * returns json/NULL
     */
    public function GetallCategories() {
        $stmt = $this->conn->prepare("CALL sp_GetCategories()");
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($categories) return $categories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get all active categories
     * parameters {}
     * returns json/NULL
     */
    public function GetallactiveCategories() {
        $stmt = $this->conn->prepare("CALL sp_GetallactiveCategories()");
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($categories) return $categories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get category details
     * parameters {categoryId}
     * returns json/NULL
     */
    public function GetCategoryById($categoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetCategoryById(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($categories) return $categories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Delete category
     * parameters {categoryId}
     * returns boolean
     */
    public function DeleteCategoryById($categoryId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCategorybyId(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    /**
     * Get categories from product name
     * parameters {text}
     * returns json/NULL
     */
    public function FilterSearchProductsCategories($text) {
        $stmt = $this->conn->prepare("CALL sp_FilterSearchProductsCategories('%$text%')");
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products) return $products;
            else return NULL;
        } else return NULL;
    }
    /**
    * Get categories total products count
    * parameters {}
     * returns json/Null
     */
    public function GetCategoryProductsCount($categoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetCategoryProductsCount(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($categories) return $categories;
            else return NULL;
        } else return NULL;
    }

    /*************************Admin Functions********************************/
    /**
     * Get all categories
     * Parameters {}
     * returns json/NULL
     */
    public function Admin_getallCategories()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallCategories()");
        $result = $stmt->execute();
        $categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($categories) return $categories;
        else  return NULL;
    }
}
?>
