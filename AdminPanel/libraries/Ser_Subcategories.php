<?php 
class Ser_Subcategories {
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
     * Get all Subcategories 
     * returns json/Null
     */
    public function Getsubcategories() {
        $stmt = $this->conn->prepare("CALL sp_GetSubcategories()");
        if ($stmt->execute()) {
            $subcategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch subcategory data and subcategory in array
            $stmt->close();
            if ($subcategories==true) {
                return $subcategories;
            }
        } else return NULL;
    }

    /**
     * Storing new Subcategory
     * returns Boolean
     */
    public function addSubcategory($categoryId,$productId,$brandId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddSubcategory(?,?,?,?)");
		$stmt->bind_param("iii",$categoryId,$productId,$brandId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful Subcategory
        if ($result) return true;
        else return false;
    } 
    
    /**
     * Edit subcategory 
     * @param subcategoryId, username, password
     * returns Boolean
     */
    public function editSubcategory($subcategoryId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditSubcategory(?,?)");
		$stmt->bind_param("ii",$subcategoryId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    /**
     * Get all subcategories 
     * params subcategory Id
     * returns json/Null
     */
    public function GetSubcategoryById($subcategoryId) {
        $stmt = $this->conn->prepare("CALL sp_GetSubcategoryById(?)");
        $stmt->bind_param("i",$subcategoryId);
        if ($stmt->execute()) {
            $subcategories = $stmt->get_result()->fetch_assoc(); //fetch subcategory data and subcategory in array
            $stmt->close();
            if ($subcategories==true) {
                return $subcategories;
            }
        } else return NULL;
    }

        /**
     * Delete Subcategory By Id 
     * params Subcategory Id
     * returns json/Null
     */
    public function DeleteSubcategoryById($subcategoryId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteSubcategorybyId(?)");
        $stmt->bind_param("i",$subcategoryId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
}
?>