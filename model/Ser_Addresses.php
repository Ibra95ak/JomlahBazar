<?php
/**
  ** addresses object
  * GetAddressesUsers --> get all addresses with Users info
  * getDefaultAddressByUserId --> get default address info of user
  * getAllAddressesByUserId --> get all addresses of a user
  * getUserAddressById --> get user address details by addressId
  * getAddressByProductId --> get product location
  * EditUserAddress --> edit user address details
  * AddUserAddress --> add user address details
  * getcountrystates --> get all states of a country
  * ResetUserAddresses --> reset all addresses by setting default_address=2
  * getcountries --> get all countries
  * getstatescities --> get all cities of a state
  * DeleteUserAddressbyId --> delete address
  * getAddressById --> get address details
  ****    Admin functions   ****
  * Admin_getUserAddresses --> get all addresses of a user
  * Admin_getAddressById --> get address details
  */
class Ser_Addresses
{
    /*database connection variable*/
    private $conn;
    /*constructor*/
    public function __construct()
    {
        /*connecting to database*/
        require_once 'DB_Connect.php';
        /*creating connection instance*/
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    public function __destruct()
    {
    }
    /**
     * get all users info and address
     * parameters {}
     * returns json/Null
     */
    public function GetAddressesUsers()
    {
        $stmt = $this->conn->prepare("CALL sp_GetAddressesUsers()");
        if ($stmt->execute()) {
            $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
            $stmt->close();
            if ($addresses) return $addresses;
            else return null;
        } else return null;
    }
    /**
     * get user default address details
     * parameters {userId}
     * returns json/Null
     */
    public function getDefaultAddressByUserId($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getDefaultAddressByUserId(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get all addresses details of a user
     * parameters {userId}
     * returns json/Null
     */
    public function getAllAddressesByUserId($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getAllAddressesByUserId(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get user address details by addressId
     * parameters {addressId,userId}
     * returns json/Null
     */
    public function getUserAddressById($addressId,$userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserAddressById(?,?)");
        $stmt->bind_param("ii", $addressId, $userId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get product location
     * parameters {productId}
     * returns json/Null
     */
    public function getAddressByProductId($productId)
    {
        $stmt = $this->conn->prepare("CALL sp_getAddressByProductId(?)");
        $stmt->bind_param("i", $productId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * edit user address details
     * parameters {addressId, userId, ipaddress, address1, address2, city, postalcode, country, latitude, longitude}
     * returns boolean
     */
    public function EditUserAddress($addressId, $userId, $ipaddress, $addresstitle, $address_type, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $default)
    {
      $stmt = $this->conn->prepare("CALL sp_EditUserAddress(?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
      $stmt->bind_param("iississssssddi", $addressId, $userId, $ipaddress, $addresstitle, $address_type, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $default);
      $result = $stmt->execute();
      $stmt->close();
      if ($result) return true;
      else return false;
    }
    /**
     * Add user address details
     * parameters {userId, ipaddress, address1, address2, city, postalcode, country, latitude, longitude, language, default}
     * returns json/Null
     */
    public function AddUserAddress($userId, $ipaddress, $addresstitle, $address_type, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $language, $default)
    {
      $stmt = $this->conn->prepare("CALL sp_AddUserAddress(?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
      $stmt->bind_param("ississssssddsi", $userId, $ipaddress, $addresstitle, $address_type, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude, $language, $default);
      $result = $stmt->execute();
      $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
      $stmt->close();
      if ($addresses) return $addresses;
      else return Null;
    }
    /**
     * get all states of a country
     * parameters {iso}
     * returns json/Null
     */
    public function getcountrystates($iso)
    {
        $stmt = $this->conn->prepare("CALL sp_getcountrystates(?)");
        $stmt->bind_param("s", $iso);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * reset all addresses by setting default_address=2
     * parameters {userId}
     * returns boolean
     */
    public function ResetUserAddresses($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_ResetUserAddresses(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * get all countries
     * parameters {}
     * returns json/Null
     */
    public function getcountries()
    {
        $stmt = $this->conn->prepare("CALL sp_getcountries()");
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get all cities of a state
     * parameters {stateId}
     * returns json/Null
     */
    public function getstatescities($stateId)
    {
        $stmt = $this->conn->prepare("CALL sp_getstatescities(?)");
        $stmt->bind_param("i", $stateId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get country by iso
     * parameters {stateId}
     * returns json/Null
     */
    public function getCountryByISO($iso)
    {
        $stmt = $this->conn->prepare("CALL sp_getCountryByISO(?)");
        $stmt->bind_param("s", $iso);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get all oman Areas
     * parameters {}
     * returns json/Null
     */
    public function getOmanAreas()
    {
        $stmt = $this->conn->prepare("CALL sp_getOmanAreas()");
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get oman Areas details
     * parameters {area}
     * returns json/Null
     */
    public function getAreaInfo($area)
    {
        $stmt = $this->conn->prepare("CALL sp_getAreaInfo(?)");
        $stmt->bind_param("s", $area);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json object*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * Delete address
     * parameters {addressId, userId}
     * returns boolean
     */
    public function DeleteUserAddressbyId($addresId,$userId)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteUserAddressbyId(?,?)");
        $stmt->bind_param("ii", $addresId,$userId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
    /**
     * get address details
     * parameters {addressId}
     * returns json/Null
     */
    public function getAddressById($addressId)
    {
        $stmt = $this->conn->prepare("CALL sp_getAddressById(?)");
        $stmt->bind_param("i", $addressId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /*********************************Admin*************************************/
    /**
     * get all addresses of a user
     * parameters {userId}
     * returns json/Null
     */
    public function Admin_getUserAddresses($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserAddresses(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
    /**
     * get addresses details
     * parameters {addressId}
     * returns json/Null
     */
    public function Admin_getAddressById($addressId)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getAddressById(?)");
        $stmt->bind_param("i", $addressId);
        $result = $stmt->execute();
        $addresses = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($addresses) return $addresses;
        else return null;
    }
}
