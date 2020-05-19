<?php 
class Ser_Wallettypes {
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
     * Get all Wallet types 
     * returns json/Null
     */
    public function GetwalletTypes() {
        $stmt = $this->conn->prepare("CALL sp_GetWalletTypes()");
        if ($stmt->execute()) {
            $wallettype = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wallet types in array
            $stmt->close();
            if ($wallettype==true) {
                return $wallettype;
            }
        } else return NULL;
    }
    /**
     * Storing new Wallet type
     * returns Boolean
     */
    public function addWalletType($wallettype,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddWalletType(?,?)");
		$stmt->bind_param("si",$wallettype,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful Wallet
        if ($result) return true;
        else return false;
    } 
    
    /**
     * Edit wallet type 
     * @param wallettypeId, wallettype, active
     * returns Boolean
     */
    public function editWalletType($wallettypeId,$wallettype,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditWalletType(?,?,?)");
		$stmt->bind_param("isi",$wallettypeId,$wallettype,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }

    /**
     * Get wallet type by Id
     * params wallettypeId
     * returns json/Null
     */
    public function GetWalletTypeById($wallettypeId) {
        $stmt = $this->conn->prepare("CALL sp_GetWalletTypeById(?)");
        $stmt->bind_param("i",$wallettypeId);
        if ($stmt->execute()) {
            $wallettype = $stmt->get_result()->fetch_assoc(); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallettype==true) {
                return $wallettype;
            }
        } else return NULL;
    }

    /**
     * Delete Wallettype By Id 
     * params wallettypeId
     * returns json/Null
     */
    public function DeleteWalletTypeById($wallettypeId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteWalletTypebyId(?)");
        $stmt->bind_param("i",$wallettypeId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>