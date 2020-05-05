<?php 
class Ser_Buyers {
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
     * Get all Buyers 
     * returns json/Null
     */
    public function Getbuyers() {
        $stmt = $this->conn->prepare("CALL sp_GetBuyers()");
        if ($stmt->execute()) {
            $buyers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch buyer data and buyer in array
            $stmt->close();
            if ($buyers==true) {
                return $buyers;
            }
        } else return NULL;
    }

    /**
     * Storing new buyer
     * @param productId, buyer_name, pictureId, active
     * returns Boolean
     */
    public function addBuyer($aaaId,$first_name,$last_name,$addressId,$reachoutId,$walletId,$identityId,$blockId) {
        $stmt = $this->conn->prepare("CALL sp_AddBuyer(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("issiiiii",$aaaId,$first_name,$last_name,$addressId,$reachoutId,$walletId,$identityId,$blockId);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit Buyer 
     * @param BuyerId, username, password
     * returns Boolean
     */
    public function editBuyer($userId,$aaaId,$first_name,$last_name,$addressId,$reachoutId,$walletId,$identityId,$blockId) {
        $stmt = $this->conn->prepare("CALL sp_EditBuyer(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iissiiiii",$userId,$aaaId,$first_name,$last_name,$addressId,$reachoutId,$walletId,$identityId,$blockId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    
    /**
     * Get all buyers 
     * params buyer Id
     * returns json/Null
     */
    public function GetBuyerById($buyerId) {
        $stmt = $this->conn->prepare("CALL sp_GetBuyerById(?)");
        $stmt->bind_param("i",$buyerId);
        if ($stmt->execute()) {
            $buyers = $stmt->get_result()->fetch_assoc(); //fetch buyer data and buyer in array
            $stmt->close();
            if ($buyers==true) {
                return $buyers;
            }
        } else return NULL;
    }

        /**
     * Delete buyer By Id 
     * params buyer Id
     * returns json/Null
     */
    public function DeleteBuyerById($buyerId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteBuyerbyId(?)");
        $stmt->bind_param("i",$buyerId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>