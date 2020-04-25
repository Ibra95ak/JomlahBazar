<?php 
class Ser_Products {
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
     * Get all products 
     * returns json/Null
     */
    public function Getproducts() {
        $stmt = $this->conn->prepare("CALL sp_GetProducts()");
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    
    /**
     * Get all products 
     * params product Id
     * returns json/Null
     */
    public function GetproductById($productId) {
        $stmt = $this->conn->prepare("CALL sp_GetProductById(?)");
        $stmt->bind_param("i",$productId);
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_assoc(); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }

}
?>