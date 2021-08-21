<?php
/**
  ** carts object
  * Getcarts --> get all carts
  * addCart --> add a new product in cart
  * updateCart --> update cart product quantity
  * GetCartById --> get certain cart details
  * DeleteCartById --> delete product from cart
  * DeleteCartByUserId --> delete product from cart
  * GetCartCount --> get total number of products in a cart
  * GetSellerCartCount --> get total number of seller in a cart
  * GetCartByUserId --> get user cart
  * GetCartBySupplierId --> Get carts of a supplier product
  * GetCartBySupplierIdfiltered --> Get carts of a supplier product filtered by product name
  * GetCartLocationBySupplierId --> Get cart's product location based on it's supplier
  * GetCartLocationByUserId --> Get cart's seller locations for buyer
  * GetCartSuppliersByUserId --> Get cart's sellers info
  * GetBuyerSellerCart --> Get cart's of user from certain seller
  * isExist_Cart --> Check if product already exist in cart
  * UpdateProductShipment --> update shipment type of product
  * UpdateProductPayment --> update payment type of product
  * SupplierCartProductsCount --> count number of supplier products added to carts
  */
class Ser_Carts {
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
     * Get all Carts
     * parameters {}
     * returns json/Null
     */
    public function Getcarts() {
        $stmt = $this->conn->prepare("CALL sp_GetCarts()");
        if ($stmt->execute()) {
            $carts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($carts) return $carts;
            else return Null;
        } else return NULL;
    }
    /**
     * add new Cart
     * parameters {userId, productId, sellerId, product_name, product_price, quantity, active}
     * returns json/null
     */
    public function addCart($userId, $productId, $sellerId, $product_name, $product_price, $quantity, $weight, $active) {
        $stmt = $this->conn->prepare("CALL sp_AddCart(?,?,?,?,?,?,?,?)");
    		$stmt->bind_param("iiisdidi",$userId, $productId, $sellerId, $product_name, $product_price, $quantity, $weight, $active);
    		$result = $stmt->execute();
        $carts = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        /*check for successful store*/
        if ($carts) return $carts;
        else return Null;
    }
    /**
     * update cart product quantity
     * parameters {userId, productId, quantity}
     * returns Boolean
     */
     public function updateCart($userId,$productId,$quantity) {
         $stmt = $this->conn->prepare("CALL sp_UpdateCart(?,?,?)");
 		    $stmt->bind_param("iii",$userId,$productId,$quantity);
         if ($stmt->execute()) {
             $carts = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
             $stmt->close();
             if ($carts) return $carts;
             else return Null;
         } else return NULL;
     }
    /**
     * Get cart details
     * params {cartId}
     * returns json/Null
     */
    public function GetCartById($cartId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartById(?)");
        $stmt->bind_param("i",$cartId);
        if ($stmt->execute()) {
            $carts = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($carts) return $carts;
            else return Null;
        } else return NULL;
    }
    /**
     * Delete product from cart
     * params {cartId}
     * returns boolean
     */
    public function DeleteCartById($cartId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCartbyId(?)");
        $stmt->bind_param("i",$cartId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    /**
     * Get user cart
     * params {userId}
     * returns json/Null
     */
    public function GetCartByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get user cart
     * params {userId}
     * returns json/Null
     */
    public function GetCartSellerWeightByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartSellerWeightByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get carts of a supplier product
     * params {userId}
     * returns json/Null
     */
    public function GetCartBySupplierId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartBySupplierId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get carts of a supplier product filtered by product name
     * params {userId, generalSearch}
     * returns json/Null
     */
    public function GetCartBySupplierIdfiltered($userId,$generalSearch) {
        $stmt = $this->conn->prepare("CALL sp_GetCartBySupplierIdfiltered(?,?)");
        $stmt->bind_param("is",$userId,$generalSearch);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart==true) return $cart;
            else return Null;
        } else return NULL;
    }

    /**
     * Get cart's product location based on it's supplier
     * params {supplierId}
     * returns json/Null
     */
    public function GetCartLocationBySupplierId($supplierId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartLocationBySupplierId(?)");
        $stmt->bind_param("i",$supplierId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get cart's seller locations for buyer
     * params {userId}
     * returns json/Null
     */
    public function GetCartLocationByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartLocationByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get cart's sellers info
     * params {userId}
     * returns json/Null
     */
    public function GetCartSuppliersByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartSuppliersByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get cart's sellers of a user
     * params {userId}
     * returns json/Null
     */
    public function getCartSellersByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_getCartSellersByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get cart's of user from certain seller
     * params {userId,sellerId}
     * returns json/Null
     */
    public function GetBuyerSellerCart($userId,$sellerId) {
        $stmt = $this->conn->prepare("CALL sp_GetBuyerSellerCart(?,?)");
        $stmt->bind_param("ii",$userId,$sellerId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get cart's sellers info
     * params {userId}
     * returns json/Null
     */
    public function GetUserCartBySuppliers($userId,$sellerId) {
        $stmt = $this->conn->prepare("CALL sp_GetUserCartBySuppliers(?,?)");
        $stmt->bind_param("ii",$userId,$sellerId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get total supplier products added to carts
     * params {supplierId}
     * returns json/Null
     */
    public function SupplierCartProductsCount($supplierId) {
        $stmt = $this->conn->prepare("CALL sp_SupplierCartProductsCount(?)");
        $stmt->bind_param("i",$supplierId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Delete product from cart
     * params {userId, cartId}
     * returns boolean
     */
    public function DeleteCartByUserId($productId, $userId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCartByUserId(?,?)");
        $stmt->bind_param("ii",$productId, $userId);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful delete*/
        if($result) return true;
        else return false;
    }
    /**
     * Check if cart already exist
     * parameters {userId, productId}
     * returns boolean
     */
    public function isExist_Cart($userId,$productId) {
        $stmt = $this->conn->prepare("CALL sp_IsExistCart(?,?)");
        $stmt->bind_param("ii",$userId,$productId);
        $result = $stmt->execute();
        $cart = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    		if($cart) return $cart;
    		else return NULL;
    }
    /**
     * Get total cart products
     * params wishlist Id
     * returns json/Null
     */
    public function GetCartCount($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartCount(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_assoc(); /*fetch data as json array*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * Get total cart sellers
     * params userId
     * returns json/Null
     */
    public function GetSellerCartCount($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetSellerCartCount(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_assoc(); /*fetch data as json array*/
            $stmt->close();
            if ($cart) return $cart;
            else return Null;
        } else return NULL;
    }
    /**
     * update shipment type of product
     * parameters {userId, type}
     * returns Boolean
     */
    public function UpdateProductShipment($userId,$type) {
        $stmt = $this->conn->prepare("CALL sp_UpdateProductShipment(?,?)");
        $stmt->bind_param("ii",$userId,$type);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    /**
     * update payment type of product
     * parameters {sellerId, userId, type}
     * returns Boolean
     */
    public function UpdateProductPayment($userId,$type) {
        $stmt = $this->conn->prepare("CALL sp_UpdateProductPayment(?,?)");
        $stmt->bind_param("ii",$userId,$type);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
}
?>
