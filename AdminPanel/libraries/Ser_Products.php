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
    public function addProduct($supplierId,$productdetailId,$inventoryId,$name,$quantity,$min_order,$unitprice,$discount,$ranking,$brandId,$blockId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddProduct(?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iiisiiiiiiii",$supplierId,$productdetailId,$inventoryId,$name,$quantity,$min_order,$unitprice,$discount,$ranking,$brandId,$blockId,$active);
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
    public function editProduct($productId,$supplierId,$productdetailId,$inventoryId,$name,$quantity,$min_order,$unitprice,$discount,$ranking,$brandId,$blockId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditProduct(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iiiisiiiiiiii",$productId,$supplierId,$productdetailId,$inventoryId,$name,$quantity,$min_order,$unitprice,$discount,$ranking,$brandId,$blockId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    /**
     * Get all products 
     * returns json/Null
     */
    public function GetProducts() {
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
     * Get all products by supplier 
     * returns json/Null
     */
    public function GetSupplierProducts($supplierId) {
        $stmt = $this->conn->prepare("CALL sp_GetSupplierProducts(?)");
        $stmt->bind_param("i",$supplierId);
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    /**
     * Get all products by cart 
     * returns json/Null
     */
    public function GetCartProducts($cartId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartProducts(?)");
        $stmt->bind_param("i",$cartId);
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
    /**
     * Get product picture 
     * params product Id
     * returns json/Null
     */
    public function GetProductPicture($productId) {
        $stmt = $this->conn->prepare("CALL sp_GetProductPic(?)");
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
     * Get product pictures 
     * params product Id
     * returns json/Null
     */
    public function GetProductPics($productId) {
        $stmt = $this->conn->prepare("CALL sp_GetProductPic(?)");
        $stmt->bind_param("i",$productId);
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    
    /**
     * Get Best seller products 
     * returns json/Null
     */
    public function GetBestSellerProducts() {
        $stmt = $this->conn->prepare("CALL sp_GetBestSellerProducts()");
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    
    /**
     * Get latest products 
     * returns json/Null
     */
    public function GetLatestProducts() {
        $stmt = $this->conn->prepare("CALL sp_GetLatestProducts()");
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    
    /**
     * Get featured products 
     * returns json/Null
     */
    public function GetFeaturedProducts() {
        $stmt = $this->conn->prepare("CALL sp_GetFeaturedProducts()");
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    
    /**
     * search all products 
     * returns json/Null
     */
    public function SearchProducts($text) {
        $stmt = $this->conn->prepare("CALL sp_SearchProducts('%$text%')");
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
    
    /**
     * search all products 
     * returns json/Null
     */
    public function SearchProductsByCategory($categoryId) {
        $stmt = $this->conn->prepare("CALL sp_SearchProductsByCategory(?)");
        $stmt->bind_param("i",$categoryId);
        if ($stmt->execute()) {
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
            $stmt->close();
            if ($products==true) {
                return $products;
            }
        } else return NULL;
    }
}
?>