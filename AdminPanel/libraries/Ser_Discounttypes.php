<?php 
class Ser_Discounttypes {
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
     * Get all Discounttypes 
     * returns json/Null
     */
    public function Getdiscounttypes() {
        $stmt = $this->conn->prepare("CALL sp_GetDiscounttypes()");
        if ($stmt->execute()) {
            $discounttypes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch discounttypes data and discounttypes in array
            $stmt->close();
            if ($discounttypes==true) {
                return $discounttypes;
            }
        } else return NULL;
    }

/**
     * Storing new Discounttype
     * @param type,active
     * returns Boolean
     */
    public function addDiscounttype($type,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddDiscounttype(?,?)");
		$stmt->bind_param("si",$type,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit discounttype 
     * @param discounttypeId, username, password
     * returns Boolean
     */
    public function editDiscounttype($discounttypeId,$type,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditDiscounttype(?,?,?)");
		$stmt->bind_param("isi",$discounttypeId,$type,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    
    /**
     * Get all discounttypes 
     * params discounttypes Id
     * returns json/Null
     */
    public function GetDiscounttypeById($discounttypeId) {
        $stmt = $this->conn->prepare("CALL sp_GetDiscounttypeById(?)");
        $stmt->bind_param("i",$discounttypeId);
        if ($stmt->execute()) {
            $discounttypes = $stmt->get_result()->fetch_assoc(); //fetch discounttype data and discounttype in array
            $stmt->close();
            if ($discounttypes==true) {
                return $discounttypes;
            }
        } else return NULL;
    }

        /**
     * Delete discounttype By Id 
     * params discounttype Id
     * returns json/Null
     */
    public function DeleteDiscounttypeById($discounttypeId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteDiscounttypebyId(?)");
        $stmt->bind_param("i",$discounttypeId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>