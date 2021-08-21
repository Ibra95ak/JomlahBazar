<?php
/**
  ** Wishlists object
  * GetWishlists --> get all Wishlists
  * addCart --> add a new cart product
  * updateCart --> update cart products
  * GetCartById --> get certain cart data
  * DeleteCartById --> delete whole cart
  * DeleteCartByUserId --> delete whole user cart
  * GetCartCount --> get tottal number of products in a cart
  */
class Ser_Wishlists {
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
     * Get all Wishlists
     * parameters {}
     * returns json/Null
     */
    public function GetWishlists() {
        $stmt = $this->conn->prepare("CALL sp_GetWishlists()");
        if ($stmt->execute()) {
            $Wishlists = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($Wishlists==true) {
                return $Wishlists;
            }
        } else return NULL;
    }
    /**
     * add new Cart
     * parameters {userId, productId, sellerId, product_name, product_price, quantity, active}
     * returns Boolean
     */
    public function addCart($userId, $productId, $sellerId, $product_name, $product_price, $quantity, $active) {
        $stmt = $this->conn->prepare("CALL sp_AddCart(?,?,?,?,?,?,?)");
    		$stmt->bind_param("iiisiii",$userId, $productId, $sellerId, $product_name, $product_price, $quantity, $active);
    		$result = $stmt->execute();
        $stmt->close();
        /*check for successful store*/
        if ($result) return true;
        else return false;
    }

    /**
     * edit cart
     * parameters {cartId, userId, productId, active}
     * returns Boolean
     */
    public function editCart($cartId,$userId,$productId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditCart(?,?,?,?)");
    		$stmt->bind_param("iiii",$cartId,$userId,$productId,$active);
        $result = $stmt->execute();
        $stmt->close();
    		if($result) return true;
    		else return false;
        }
    /**
     * update cart
     * parameters {userId, productId, quantity}
     * returns Boolean
     */
    public function updateCart($userId,$productId,$quantity) {
        $stmt = $this->conn->prepare("CALL sp_UpdateCart(?,?,?)");
		    $stmt->bind_param("iii",$userId,$productId,$quantity);
        $result = $stmt->execute();
        $stmt->close();
    		if($result) return true;
    		else return false;
        }
    /**
     * Get cart by id
     * params {cartId}
     * returns json/Null
     */
    public function GetCartById($cartId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartById(?)");
        $stmt->bind_param("i",$cartId);
        if ($stmt->execute()) {
            $Wishlists = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $stmt->close();
            if ($Wishlists==true) {
                return $Wishlists;
            }
        } else return NULL;
    }
    /**
     * Delete cart
     * params {cartId}
     * returns json/Null
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
     * Get all user Wishlists
     * params {userId}
     * returns json/Null
     */
    public function GetCartByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart==true) {
                return $cart;
            }
        } else return NULL;
    }
    /**
     * Delete user cart
     * params {userId, cartId}
     * returns json/Null
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
     * returns array/Null
     */
    public function isExist_Cart($userId,$productId) {
        $stmt = $this->conn->prepare("CALL sp_IsExistCart(?,?)");
        $stmt->bind_param("ii",$userId,$productId);
        $result = $stmt->execute();
        $cart = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    		if($cart) return true;
    		else return false;
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
            if ($cart==true) {
                return $cart;
            }
        } else return NULL;
    }
    /**
     * Get all user carts
     * params {userId}
     * returns json/Null
     */
    public function GetWishListBySupplierId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetWishListBySupplierId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart==true) {
                return $cart;
            }
        } else return NULL;
    }
    public function GetWishlistLocationBySupplierId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetWishlistLocationBySupplierId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($cart==true) {
                return $cart;
            }
        } else return NULL;
    }
}
?>
