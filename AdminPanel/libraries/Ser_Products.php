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
     * Storing new Product
     * returns Boolean
     */
    public function addProduct($name,$quantity,$min_order,$unitprice,$discount,$ranking,$productdetailId,$brandId,$blockId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddProduct(?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("siiiisiiii",$name,$quantity,$min_order,$unitprice,$discount,$ranking,
        $productdetailId,$brandId,$blockId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }    
    
    /**
     * Edit product 
     * @param productId, username, password
     * returns Boolean
     */
    public function editProduct($productId,$name,$quantity,$min_order,$unitprice,$description,$ranking,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditProduct(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("isiiisii",$productId,$name,$quantity,$min_order,$unitprice,$description,$ranking,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
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

        /**
     * Delete Product By Id 
     * params Product Id
     * returns json/Null
     */
    public function DeleteProductById($productId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteProductbyId(?)");
        $stmt->bind_param("i",$productId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>