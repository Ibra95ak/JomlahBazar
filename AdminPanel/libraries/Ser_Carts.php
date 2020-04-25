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

}
?>