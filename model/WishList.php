<?php

class WishList{

    /*database connection variable*/
    private $conn;
    /*constructor*/
    public function __construct()
    {
        /*connecting to database*/
        require_once 'DB_Connect.php';
        /*creating connection instance*/
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }

    public function getMyWishList($uid){
        $stmt = $this->conn->prepare("CALL sp_GetWishlistByUserId(?)");
		$stmt->bind_param("i",$uid);
		if ($stmt->execute()) {
            $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($orders == true) {
                return $orders;
            }
        } else return NULL;
    }

    public function deleteWishList($id, $userId){
        $stmt = $this->conn->prepare("CALL sp_DeleteWishlistbyId(?,?)");
		$stmt->bind_param("ii",$id,$userId);
		if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    public function AddToWishList($uid,$sid,$pid){
        $stmt = $this->conn->prepare("CALL sp_AddWishlist(?,?,?)");
		$stmt->bind_param("iii",$uid,$sid,$pid);
		if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

    public function checkIfWishListExist($uid,$pid){
        $stmt = $this->conn->prepare("CALL sp_IsExistWishlist(?,?)");
		$stmt->bind_param("ii",$uid,$pid);
		if ($stmt->execute()) {
            $wishlists = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch order data and store in array
            $stmt->close();
            if ($wishlists == true) {
                return true;
            }
        } else return false;
    }


}
