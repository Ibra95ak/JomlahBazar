<?php 
class Ser_Addresses {
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
     * Get all addresses 
     * returns json/Null
     */
    public function Getaddresses() {
        $stmt = $this->conn->prepare("CALL sp_GetAddresses()");
        if ($stmt->execute()) {
            $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch address data and address in array
            $stmt->close();
            if ($addresses==true) {
                return $addresses;
            }
        } else return NULL;
    }
    
    /**
     * Get all addresses 
     * params address Id
     * returns json/Null
     */
    public function GetAddressById($addressId) {
        $stmt = $this->conn->prepare("CALL sp_GetAddressById(?)");
        $stmt->bind_param("i",$addressId);
        if ($stmt->execute()) {
            $addresses = $stmt->get_result()->fetch_assoc(); //fetch address data and address in array
            $stmt->close();
            if ($addresses==true) {
                return $addresses;
            }
        } else return NULL;
    }

}
?>