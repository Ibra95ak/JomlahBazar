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