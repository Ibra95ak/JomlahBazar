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
     * Get all JB payment fees
     * returns json/Null
     */
    public function GetPaymentFees() {
        $stmt = $this->conn->prepare("CALL sp_GetPaymentFees()");
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    /**
     * Get JB payment fees by Id
     * parameters {feesId}
     * returns json/Null
     */
    public function GetPaymentFeesById($feesId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaymentFeesById(?)");
        $stmt->bind_param("i",$feesId);
    		$result = $stmt->execute();
        $wallets = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        // check for successful Wallet
        if ($result) return $wallets;
        else return Null;
    }
    /**
     * Get seller payment fees by Id
     * parameters {feesId}
     * returns json/Null
     */
    public function GetPaymentSellerFeesById($feesId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaymentSellerFeesById(?)");
        $stmt->bind_param("i",$feesId);
    		$result = $stmt->execute();
        $wallets = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        // check for successful Wallet
        if ($result) return $wallets;
        else return Null;
    }
    /**
     * Storing new Wallet
     * returns Boolean
     */
    public function addWallet($userId,$wallettypeId) {
      $stmt = $this->conn->prepare("CALL sp_AddWallet(?,?)");
  		$stmt->bind_param("ii",$userId,$wallettypeId);
  		$result = $stmt->execute();
      $wallets = $stmt->get_result()->fetch_assoc();
      $stmt->close();
      // check for successful Wallet
      if ($result) return $wallets;
      else return Null;
    }

    /**
     * Edit wallet
     * @param walletId, username, password
     * returns Boolean
     */
    public function editWallet($walletId,$wallettypeId,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditWallet(?,?,?)");
		$stmt->bind_param("iii",$walletId,$wallettypeId,$active);
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
    public function GetCreditcardByWalletId($walletId) {
        $stmt = $this->conn->prepare("CALL sp_GetCreditcardByWalletId(?)");
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
     * Get all wallets
     * params wallet Id
     * returns json/Null
     */
    public function GetWalletByUserId($userId) {
        $stmt = $this->conn->prepare("CALL sp_GetWalletByUserId(?)");
        $stmt->bind_param("i",$userId);
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    public function GetPaypalByWalletId($walletId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaypalByWalletId(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_assoc(); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    public function GetBankByWalletId($walletId) {
        $stmt = $this->conn->prepare("CALL sp_GetBankByWalletId(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_assoc(); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    public function GetBankBySellerId($sellerId) {
        $stmt = $this->conn->prepare("CALL sp_GetBankBySellerId(?)");
        $stmt->bind_param("i",$sellerId);
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_assoc(); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    /**
     * Get all wallets
     * params wallet Id
     * returns json/Null
     */
    public function GetCreditcardById ($creditcardId) {
        $stmt = $this->conn->prepare("CALL sp_GetCreditcardById (?)");
        $stmt->bind_param("i",$creditcardId);
        if ($stmt->execute()) {
            $wallets = $stmt->get_result()->fetch_assoc(); //fetch wallet data and wallet in array
            $stmt->close();
            if ($wallets==true) {
                return $wallets;
            }
        } else return NULL;
    }
    /**
     * Get all wallets
     * params wallet Id
     * returns json/Null
     */
    public function GetPaypalById($paypalId) {
        $stmt = $this->conn->prepare("CALL sp_GetPaypalById(?)");
        $stmt->bind_param("i",$paypalId);
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
    public function AddPaypal($walletId, $paypalemail){
        $stmt = $this->conn->prepare("CALL sp_AddPaypal(?,?)");
        $stmt->bind_param("is",$walletId, $paypalemail);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function Addcreditcard($walletId, $card_type, $cardholdername, $cardnumber, $cardname, $cardexpirymonth, $cardexpiryyear){
        $stmt = $this->conn->prepare("CALL sp_Addcreditcard(?,?,?,?,?,?,?)");
        $stmt->bind_param("iisssss",$walletId, $card_type, $cardholdername, $cardnumber, $cardname, $cardexpirymonth, $cardexpiryyear);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function AddBankAccount($walletId, $account_number, $account_name, $bank_name, $iban, $swift_code, $currency){
        $stmt = $this->conn->prepare("CALL sp_AddBankAccount(?,?,?,?,?,?,?)");
        $stmt->bind_param("issssss",$walletId, $account_number, $account_name, $bank_name, $iban, $swift_code, $currency);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function EditCreditcard($creditcardId,$walletId,$card_type,$cardholdername,$cardnumber,$cardname,$cardexpirymonth,$cardexpiryyear) {
        $stmt = $this->conn->prepare("CALL sp_EditCreditcard(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiisssss",$creditcardId,$walletId,$card_type,$cardholdername,$cardnumber,$cardname,$cardexpirymonth,$cardexpiryyear);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    public function EditPaypal($paypalId,$walletId,$paypal_email) {
        $stmt = $this->conn->prepare("CALL sp_EditPaypal(?,?,?)");
        $stmt->bind_param("iis",$paypalId,$walletId,$paypal_email);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    public function EditBankAccount($bankaccountId, $walletId, $account_number, $account_name, $bank_name, $iban, $swift_code, $currency) {
        $stmt = $this->conn->prepare("CALL sp_EditBankAccount(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iissssss",$bankaccountId, $walletId, $account_number, $account_name, $bank_name, $iban, $swift_code, $currency);
        $result = $stmt->execute();
        $stmt->close();
        if($result) return true;
        else return false;
    }
    public function DeleteCreditCardByWalletId($walletId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteCreditCardbyWalletId(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function DeletePaypalByWalletId($walletId) {
        $stmt = $this->conn->prepare("CALL sp_DeletePaypalByWalletId(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    public function DeleteBankAccountByWalletId($walletId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteBankAccountByWalletId(?)");
        $stmt->bind_param("i",$walletId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
}
