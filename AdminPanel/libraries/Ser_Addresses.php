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
     * Storing new Address
     * @param username, password
     * returns Boolean
     */
    public function addAddress($ipaddress,$address1,$address2,$city,$state,$postalcode,$country,$latitude,$longitude) {
        $stmt = $this->conn->prepare("CALL sp_AddAddress(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssii",$ipaddress,$address1,$address2,$city,$state,$postalcode,$country,$latitude,$longitude);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }

    /**
     * Edit address 
     * @param addressId, username, password
     * returns Boolean
     */
    public function editAddress($addressId,$ipaddress,$address1,$address2,$city,$state,$postalcode,$country,$latitude,$longitude) {
        $stmt = $this->conn->prepare("CALL sp_EditAddress(?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("isssssssii",$addressId,$ipaddress,$address1,$address2,$city,$state,$postalcode,$country,$latitude,$longitude);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
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

            /**
     * Delete address By Id 
     * params address Id
     * returns json/Null
     */
    public function DeleteAddressById($addressId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteAddressbyId(?)");
        $stmt->bind_param("i",$addressId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }
    
    /**
     * Get address by supplierId 
     * params supplier Id
     * returns json/Null
     */
    public function GetAddressBySupplierId($supplierId) {
        $stmt = $this->conn->prepare("CALL sp_GetAddressBySupplierId(?)");
        $stmt->bind_param("i",$supplierId);
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