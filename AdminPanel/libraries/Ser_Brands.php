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
     * Storing new Brand
     * @param productId, brand_name, pictureId, active
     * returns Boolean
     */
    public function addBrand($categoryId,$brand_name,$pictureId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddBrand(?,?,?,?)");
		$stmt->bind_param("isii",$categoryId,$brand_name,$pictureId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit brand 
     * @param brandId, username, password
     * returns Boolean
     */
    public function editBrand($brandId,$categoryId,$brand_name,$pictureId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditBrand(?,?,?,?,?)");
		$stmt->bind_param("iisii",$brandId,$categoryId,$brand_name,$pictureId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
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

        /**
     * Delete brand By Id 
     * params brand Id
     * returns json/Null
     */
    public function DeleteBrandById($brandId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteBrandbyId(?)");
        $stmt->bind_param("i",$brandId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>