<?php 
class Ser_Categories {
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
     * Storing new Category
     * returns Boolean
     */
    public function addCategory($name,$icon,$productId,$subcategoryId,$brandId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddCategory(?,?,?,?,?,?)");
		$stmt->bind_param("ssiiii",$name,$icon,$productId,$subcategoryId,$brandId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit category 
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
     * returns json/Null
     */
    public function GetCategories() {
        $stmt = $this->conn->prepare("CALL sp_GetCategories()");
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch categories data and store in array
            $stmt->close();
            if ($categories==true) {
                return $categories;
            }
        } else return NULL;
    }

    /**
     * Delete categories by Id
     * params category Id
     * returns json/Null
     */
    public function DeleteCategory() {
        $stmt = $this->conn->prepare("CALL sp_DeleteCategoryById(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch categories data and store in array
            $stmt->close();
            if ($categories==true) {
                return $categories;
            }
        } else return NULL;
    }
    
    /**
     * Get all categories 
     * params category Id
     * returns json/Null
     */
    public function GetCategoryById($categoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetCategoryById(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $categories = $stmt->get_result()->fetch_assoc(); //fetch categories data and store in array
            $stmt->close();
            if ($categories==true) {
                return $categories;
            }
        } else return NULL;
    }

    /**
     * Delete category By Id 
     * params category Id
     * returns json/Null
     */
    public function DeleteCategoryById($categoryId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCategorybyId(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
}
?>