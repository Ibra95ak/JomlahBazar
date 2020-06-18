<?php
class Ser_Products {
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
     * storing new product
     * parameters supplierId, productdetailId, inventoryId, name, quantity, min_order, unitprice, discount, ranking, brandId, blockId, active
     * returns boolean
     */
    public function addProduct($supplierId, $productdetailId, $inventoryId, $name, $quantity, $min_order, $unitprice, $discount, $ranking, $brandId, $blockId, $active) {
      $stmt = $this->conn->prepare("CALL sp_AddProduct(?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("iiisiiiiiiii", $supplierId, $productdetailId, $inventoryId, $name, $quantity, $min_order, $unitprice, $discount, $ranking, $brandId, $blockId, $active);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful store*/
      if ($result) return true;
      else return false;
    }
    /**
     * edit product
     * parameters productId, supplierId, productdetailId, inventoryId, name, quantity, min_order, unitprice, discount, ranking, brandId, blockId, active
     * returns boolean
     */
    public function editProduct($productId, $supplierId, $productdetailId, $inventoryId, $name, $quantity, $min_order,  $unitprice, $discount, $ranking, $brandId, $blockId, $active) {
      $stmt = $this->conn->prepare("CALL sp_EditProduct(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iiiisiiiiiiii", $productId, $supplierId, $productdetailId, $inventoryId, $name, $quantity, $min_order, $unitprice, $discount, $ranking, $brandId, $blockId, $active);
    $result = $stmt->execute();
    $stmt->close();
    /*check for successful edit*/
		if($result) return true;
		else return false;
    }
    /**
     * get all products
     * returns json/null
     */
    public function GetProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get all products
     *parameters sql{dynamic query}
     * returns json/Null
     */
    public function searchProducts($sql) {
      $stmt = $this->conn->prepare($sql);
      if ($stmt->execute()) {
        $brands = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($brands==true) return $brands;
        else return NULL;
      } else return NULL;
    }
    /**
     * count brands
     * returns json/Null
     */
    public function countProducts($sql) {
      $stmt = $this->conn->prepare($sql);
      if ($stmt->execute()) {
        $brands = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($brands==true) return $brands;
        else return NULL;
      } else return NULL;
    }
    /**
     * get all products by supplier
     * parameters supplierId
     * returns json/Null
     */
    public function GetSupplierProducts($supplierId) {
      $stmt = $this->conn->prepare("CALL sp_GetSupplierProducts(?)");
      $stmt->bind_param("i",$supplierId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * Get all products by cart
     * returns json/Null
     */
    // public function GetCartProducts($cartId) {
    //     $stmt = $this->conn->prepare("CALL sp_GetCartProducts(?)");
    //     $stmt->bind_param("i",$cartId);
    //     if ($stmt->execute()) {
    //         $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch product data and product in array
    //         $stmt->close();
    //         if ($products==true) {
    //             return $products;
    //         }
    //     } else return NULL;
    // }
    /**
     * get product by id
     * params productId
     * returns json/null
     */
    public function GetproductById($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductById(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json array*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * delete product by id
     * params productId
     * returns boolean
     */
    public function DeleteProductById($productId) {
      $stmt = $this->conn->prepare("CALL sp_DeleteProductbyId(?)");
      $stmt->bind_param("i",$productId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
  		if($result) return true;
  		else return false;
    }
    /**
     * get product picture
     * params productId
     * returns json/Null
     */
    public function GetFeaturedPicture($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetFeaturedPicture(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json array*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get 3 product picture
     * params productId
     * returns json/Null
     */
    public function GetProductSlider($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductSlider(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get product pictures
     * params productId
     * returns json/Null
     */
    public function GetProductPics($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductPics(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get best seller products
     * returns json/Null
     */
    public function GetBestSellerProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetBestSellerProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get latest products
     * returns json/Null
     */
    public function GetLatestProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetLatestProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get featured products
     * returns json/Null
     */
    public function GetFeaturedProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetFeaturedProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
}
?>
