<?php
/**
  ** filter products object
  * getallActiveEvents --> Get all active events
  * getallActiveDemands --> Get all active demands
*/
class Ser_Index
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
     * Get all active events
     * Parameters {}
     * returns json/null
     */
    public function getallActiveEvents()
    {
        $stmt = $this->conn->prepare("CALL sp_getallActiveEvents()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) return $users;
        else return null;
    }
    /**
     * Get all active demands
     * Parameters {}
     * returns json/null
     */
    public function getallActiveDemands()
    {
        $stmt = $this->conn->prepare("CALL sp_getallActiveDemands()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) return $users;
        else return null;
    }
}
