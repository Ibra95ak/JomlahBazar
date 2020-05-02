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
    public function editCart($cartId,$userId,$productId,$created_date,$updated_date,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditCart(?,?,?,?,?,?)");
		$stmt->bind_param("iiissi",$cartId,$userId,$productId,$created_date,$updated_date,$active);
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

}
?>