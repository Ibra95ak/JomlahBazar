<?php 
class Ser_Brands {
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
     * Get all Brands 
     * returns json/Null
     */
    public function Getbrands() {
        $stmt = $this->conn->prepare("CALL sp_GetBrands()");
        if ($stmt->execute()) {
            $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch brand data and brand in array
            $stmt->close();
            if ($brands==true) {
                return $brands;
            }
        } else return NULL;
    }
    
    /**
     * Get all brands 
     * params brand Id
     * returns json/Null
     */
    public function GetBrandById($brandId) {
        $stmt = $this->conn->prepare("CALL sp_GetBrandById(?)");
        $stmt->bind_param("i",$brandId);
        if ($stmt->execute()) {
            $brands = $stmt->get_result()->fetch_assoc(); //fetch brand data and brand in array
            $stmt->close();
            if ($brands==true) {
                return $brands;
            }
        } else return NULL;
    }

}
?>