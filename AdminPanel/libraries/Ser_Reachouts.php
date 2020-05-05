<?php 
class Ser_Reachouts {
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
     * Get all Reachouts 
     * returns json/Null
     */
    public function Getreachouts() {
        $stmt = $this->conn->prepare("CALL sp_GetReachout()");
        if ($stmt->execute()) {
            $reachouts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch reachout data and reachout in array
            $stmt->close();
            if ($reachouts==true) {
                return $reachouts;
            }
        } else return NULL;
    }
    
    /**
     * Get all reachouts 
     * params reachout Id
     * returns json/Null
     */
    public function GetReachoutById($reachoutId) {
        $stmt = $this->conn->prepare("CALL sp_GetReachoutById(?)");
        $stmt->bind_param("i",$reachoutId);
        if ($stmt->execute()) {
            $reachouts = $stmt->get_result()->fetch_assoc(); //fetch reachout data and reachout in array
            $stmt->close();
            if ($reachouts==true) {
                return $reachouts;
            }
        } else return NULL;
    }

    
    /**
     * Storing new Reachout
     * returns Boolean
     */
    public function addReachout($userId,$phone,$whatsapp,$telegram,$messenger,$skype,$sms) {
        $stmt = $this->conn->prepare("CALL sp_AddReachout(?,?,?,?,?,?,?)");
		$stmt->bind_param("issssss",$userId,$phone,$whatsapp,$telegram,$messenger,$skype,$sms);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }  
    
    /**
     * Edit reachout 
     * @param reachoutId, username, password
     * returns Boolean
     */
    public function editReachout($reachoutId,$userId,$phone,$whatsapp,$telegram,$messenger,$skype,$sms) {
        $stmt = $this->conn->prepare("CALL sp_EditReachout(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iissssss",$reachoutId,$userId,$phone,$whatsapp,$telegram,$messenger,$skype,$sms);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
        /**
     * Delete Reachout By Id 
     * params Reachout Id
     * returns json/Null
     */
    public function DeleteReachoutById($reachoutId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteReachoutbyId(?)");
        $stmt->bind_param("i",$reachoutId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>