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

}
?>