<?php 
class Ser_Carts {
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
     * Get all Carts 
     * returns json/Null
     */
    public function Getcarts() {
        $stmt = $this->conn->prepare("CALL sp_GetCarts()");
        if ($stmt->execute()) {
            $carts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch cart data and cart in array
            $stmt->close();
            if ($carts==true) {
                return $carts;
            }
        } else return NULL;
    }

    /**
     * Storing new Cart
     * @param userId, productId, created_date, updated_date, active
     * returns Boolean
     */
    public function addCart($userId,$productId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddCart(?,?,?)");
		$stmt->bind_param("iii",$userId,$productId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit cart 
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
     * Get all carts 
     * params cart Id
     * returns json/Null
     */
    public function GetCartById($cartId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartById(?)");
        $stmt->bind_param("i",$cartId);
        if ($stmt->execute()) {
            $carts = $stmt->get_result()->fetch_assoc(); //fetch cart data and cart in array
            $stmt->close();
            if ($carts==true) {
                return $carts;
            }
        } else return NULL;
    }

    /**
     * Delete cart By Id 
     * params cart Id
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
     * Get all wishlists 
     * params wishlist Id
     * returns json/Null
     */
    public function GetCartByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wishlist data and wishlist in array
            $stmt->close();
            if ($cart==true) {
                return $cart;
            }
        } else return NULL;
    }
    
    /**
     * Check if email already exist
     * returns array/Null
     */
    public function isExist_Cart($userId,$productId) {
        $stmt = $this->conn->prepare("CALL sp_IsExistCart(?,?)");
        $stmt->bind_param("ii",$userId,$productId);
        $result = $stmt->execute();
        $wishlist = $stmt->get_result()->fetch_assoc();
        $stmt->close(); 
		if($wishlist) return true;
		else return false;
    }
    
                /**
     * Get all wishlists 
     * params wishlist Id
     * returns json/Null
     */
    public function GetCartCount($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetCartCount(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $cart = $stmt->get_result()->fetch_assoc(); //fetch wishlist data and wishlist in array
            $stmt->close();
            if ($cart==true) {
                return $cart;
            }
        } else return NULL;
    }
}
?>