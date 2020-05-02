<?php 
class Ser_Wallets {
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
     * Get all Wallets 
     * returns json/Null
     */
    public function Getwallets() {
        $stmt = $this->conn->prepare("CALL sp_GetWallet()");
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    /**
     * Storing new Wallet
     * returns Boolean
     */
    public function addWallet($type,$typeId,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddWallet(?,?,?)");
		$stmt->bind_param("sii",$type,$typeId,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful Wallet
        if ($result) return true;
        else return false;
    } 
    
    /**
     * Edit wallet 
     * @param walletId, username, password
     * returns Boolean
     */
    public function editWallet($walletId,$type,$typeId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditWallet(?,?,?,?)");
		$stmt->bind_param("isii",$walletId,$type,$typeId,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }

    /**
     * Get all wallets 
     * params wallet Id
     * returns json/Null
     */
    public function GetWalletById($walletId) {
        $stmt = $this->conn->prepare("CALL sp_GetWalletById(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_assoc(); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }

            /**
     * Delete Wallet By Id 
     * params Wallet Id
     * returns json/Null
     */
    public function DeleteWalletById($walletId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteWalletbyId(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>