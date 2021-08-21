<?php
/**
  ** Devices object
  * AddUserDevice --> add users trusted devices
  * GetDevicesByUserId --> Get user's trusted devices
  * DeleteDeviceById --> Delete user's trusted device
*/
class Ser_Devices
{
    /*Database connection variable*/
    private $conn;
    /*Constructor*/
    public function __construct()
    {
        /*Connecting to database*/
        require_once 'DB_Connect.php';
        /*Creating a connection instance*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*Destructor*/
    public function __destruct()
    {
    }
    /**
     * Add users' trusted devices
     * Parameters {userId, type, os, os_version, os_platform, browser, browser_version, engine}
     * returns json/NULL
     */
    public function AddUserDevice($userId, $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $ipaddress)
    {
        $stmt = $this->conn->prepare("CALL sp_AddUserDevice(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssssss",$userId, $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $ipaddress);
        $result = $stmt->execute();
        $devices = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($devices) return $devices;
        else return NULL;
    }
    /**
     * Get user's trusted devices
     * Parameters {userId}
     * returns json/Null
     */
    public function GetDevicesByUserId($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetDevicesByUserId(?)");
        $stmt->bind_param("i",$userId);
        $result = $stmt->execute();
        $devices = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($devices) return $devices;
        else return Null;
    }
    /**
     * Delete user's trusted device
     * Parameters {deviceId}
     * returns Boolean
     */
    public function DeleteDeviceById($deviceId)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteDeviceById(?)");
        $stmt->bind_param("i",$deviceId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }
}
