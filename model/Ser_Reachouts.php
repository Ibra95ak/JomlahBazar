<?php
/**
  ** Reachout object
  * GetReachoutByUserId --> get user reachouts
  */
class Ser_Reachouts
{
    private $conn;
    /*constructor*/
    public function __construct()
    {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    public function __destruct()
    {
    }
    /**
     * Get reachout by user Id
     * params {userId}
     * returns json/Null
     */
    public function GetReachoutById($reachoutId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetReachoutById(?)");
        $stmt->bind_param("i", $reachoutId);
        $result = $stmt->execute();
        $reachouts = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($reachouts) {
            return $reachouts;
        } else {
            return null;
        }
    }
    public function GetReachoutByUserId($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetReachoutByUserId(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $reachouts = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($reachouts) {
            return $reachouts;
        } else {
            return null;
        }
    }
    /**
     * storing new reachout
     * parameters phone, whatsapp, telegram, messenger, linkedin, sms, facebook, instagram, teams, zoom
     * returns json/NULL
     */
    public function addReachout($phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom)
    {
        $stmt = $this->conn->prepare("CALL sp_AddReachout(?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssss", $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom);
        $result = $stmt->execute();
        $reachouts = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        /*check for successful store*/
        if ($reachouts) {
            return $reachouts;
        } else {
            return NULL;
        }
    }
    /**
     * edit reachout
     * parameters reachoutId, phone, whatsapp, telegram, messenger, linkedin, sms
     * returns Boolean
     */
    public function editReachout($reachoutId, $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom)
    {
        $stmt = $this->conn->prepare("CALL sp_EditReachout(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssssssss", $reachoutId, $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms,$facebook, $instagram, $teams, $zoom);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful edit*/
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * delete reachout by id
     * parameters reachoutId
     * returns json/Null
     */
    public function DeleteReachoutById($reachoutId)
    {
        $stmt = $this->conn->prepare("CALL sp_DeleteReachoutbyId(?)");
        $stmt->bind_param("i", $reachoutId);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful delete*/
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /*************************Admin Functions********************************/
    public function Admin_getUserReachouts($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserReachouts(?)");
        $stmt->bind_param("i", $Id);
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
