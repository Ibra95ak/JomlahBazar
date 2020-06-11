<?php 
class Ser_Wishlists {
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
     * Get all Wishlists 
     * returns json/Null
     */
    public function Getwishlists() {
        $stmt = $this->conn->prepare("CALL sp_GetWishlists()");
        if ($stmt->execute()) {
            $wishlists = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wishlist data and wishlist in array
            $stmt->close();
            if ($wishlists==true) {
                return $wishlists;
            }
        } else return NULL;
    }
    
    /**
     * Get all wishlists 
     * params wishlist Id
     * returns json/Null
     */
    public function GetWishlistById($wishlistId) {
        $stmt = $this->conn->prepare("CALL sp_GetWishlistById(?)");
        $stmt->bind_param("i",$wishlistId);
        if ($stmt->execute()) {
            $wishlists = $stmt->get_result()->fetch_assoc(); //fetch wishlist data and wishlist in array
            $stmt->close();
            if ($wishlists==true) {
                return $wishlists;
            }
        } else return NULL;
    }

    /**
     * Storing new Wishlist
     * returns Boolean
     */
    public function addWishlist($userId,$productId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddWishlist(?,?,?)");
		$stmt->bind_param("iii",$userId,$productId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful Wishlist
        if ($result) return true;
        else return false;
    } 
    /**
     * Edit wishlist 
     * @param wishlistId, username, password
     * returns Boolean
     */
    public function editWishlist($wishlistId,$userId,$productId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditWishlist(?,?,?,?)");
		$stmt->bind_param("iiii",$wishlistId,$userId,$productId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }

        /**
     * Delete Wishlist By Id 
     * params Wishlist Id
     * returns json/Null
     */
    public function DeleteWishlistById($wishlistId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteWishlistbyId(?)");
        $stmt->bind_param("i",$wishlistId);
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
    public function GetWishlistByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetWishlistByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $wishlists = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wishlist data and wishlist in array
            $stmt->close();
            if ($wishlists==true) {
                return $wishlists;
            }
        } else return NULL;
    }
    
    /**
     * Check if email already exist
     * returns array/Null
     */
    public function isExist_Wishlist($userId,$productId) {
        $stmt = $this->conn->prepare("CALL sp_IsExistWishlist(?,?)");
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
    public function GetWishlistCount($userId) {
        $stmt = $this->conn->prepare("CALL GetWishlistCount(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $wishlists = $stmt->get_result()->fetch_assoc(); //fetch wishlist data and wishlist in array
            $stmt->close();
            if ($wishlists==true) {
                return $wishlists;
            }
        } else return NULL;
    }
}
?>