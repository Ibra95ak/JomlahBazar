<?php
/**
  ** Main Categories object
  * addMaincategory --> add new main category
  * editMaincategory --> edit main category
  * GetallMaincategories --> get all main categories
  * GetMaincategoryProductsCount --> Get Maincategories total products count
  * GetMaincategoryById --> get main category details
  * DeleteMaincategoryById --> Delete Maincategory By Id
  * GetCategoriesByMaincategoryId --> Get all categories under same main category
  * GetCategoriesByMaincategoryIdlim4 --> Get 4 categories under same main category
  */
class Ser_Maincategories {
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
     * add new Maincategory
     * parameters {name, icon, active}
     * returns json/NULL
     */
    public function addMaincategory($name,$icon,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddMaincategory(?,?,?)");
    		$stmt->bind_param("ssi",$name,$icon,$active);
    		$result = $stmt->execute();
        $Maincategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json array*/
        $stmt->close();
        // check for successful store
        if ($Maincategories) return $Maincategories;
        else return NULL;
    }
    /**
     * Edit Main category
     * parameters {MaincategoryId, name, icon, active}
     * returns Boolean
     */
    public function editMaincategory($MaincategoryId,$name,$icon,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditMaincategory(?,?,?,?)");
		    $stmt->bind_param("issi",$MaincategoryId,$name,$icon,$active);
        $result = $stmt->execute();
        $stmt->close();
    		if($result) return true;
    		else return false;
    }
    /**
     * Get all Maincategories
     * parameters {}
     * returns json/Null
     */
    public function GetallMaincategories() {
        $stmt = $this->conn->prepare("CALL sp_GetMaincategories()");
        if ($stmt->execute()) {
            $Maincategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($Maincategories) return $Maincategories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get Maincategories total products count
     * parameters {}
     * returns json/Null
     */
    public function GetMaincategoryProductsCount($MaincategoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetMaincategoryProductsCount(?)");
        $stmt->bind_param("i",$MaincategoryId);
        if ($stmt->execute()) {
            $Maincategories = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($Maincategories) return $Maincategories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get Maincategory details
     * parameters {MaincategoryId}
     * returns json/Null
     */
    public function GetMaincategoryById($MaincategoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetMaincategoryById(?)");
        $stmt->bind_param("i",$MaincategoryId);
        if ($stmt->execute()) {
            $Maincategories = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($Maincategories) return $Maincategories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Delete Maincategory By Id
     * parameters {MaincategoryId}
     * returns boolean
     */
    public function DeleteMaincategoryById($MaincategoryId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteMaincategorybyId(?)");
        $stmt->bind_param("i",$MaincategoryId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    /**
     * Get all categories under same main category
     * params Maincategory Id
     * returns json/Null
     */
    public function GetCategoriesByMaincategoryId($MaincategoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetCategoriesByMaincategoryId(?)");
        $stmt->bind_param("i",$MaincategoryId);
        if ($stmt->execute()) {
            $Maincategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($Maincategories) return $Maincategories;
            else return NULL;
        } else return NULL;
    }
    /**
     * Get 4 categories under same main category
     * params Maincategory Id
     * returns json/Null
     */
    public function GetCategoriesByMaincategoryIdlim4($MaincategoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetCategoriesByMaincategoryIdlim4(?)");
        $stmt->bind_param("i",$MaincategoryId);
        if ($stmt->execute()) {
            $Maincategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($Maincategories) return $Maincategories;
            else return NULL;
        } else return NULL;
    }
}
?>
