<?php
/**
  ** Roles object
  * getallActiveRoles --> get all active roles
*/
class Ser_Roles
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
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function getallActiveRoles()
    {
        $stmt = $this->conn->prepare("CALL sp_getallActiveRoles()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function getallActiveServiceRoles()
    {
        $stmt = $this->conn->prepare("CALL sp_getallActiveServiceRoles()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function getRoleByuserId($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getRoleByuserId(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
}
