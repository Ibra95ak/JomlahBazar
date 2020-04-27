<?php 
class Ser_Priviledges {
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
     * Get all priviledges 
     * returns json/Null
     */
    public function Getpriviledges() {
        $stmt = $this->conn->prepare("CALL sp_GetPriviledges()");
        if ($stmt->execute()) {
            $priviledges = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch priviledge data and priviledge in array
            $stmt->close();
            if ($priviledges==true) {
                return $priviledges;
            }
        } else return NULL;
    }
    
    /**
     * Get all priviledges 
     * params priviledge Id
     * returns json/Null
     */
    public function GetPriviledgeById($priviledgeId) {
        $stmt = $this->conn->prepare("CALL sp_GetPriviledgeById(?)");
        $stmt->bind_param("i",$priviledgeId);
        if ($stmt->execute()) {
            $priviledges = $stmt->get_result()->fetch_assoc(); //fetch priviledge data and priviledge in array
            $stmt->close();
            if ($priviledges==true) {
                return $priviledges;
            }
        } else return NULL;
    }

        /**
     * Delete Priviledge By Id 
     * params Priviledge Id
     * returns json/Null
     */
    public function DeletePriviledgeById($priviledgeId) {
        $stmt = $this->conn->prepare("CALL sp_DeletePriviledgebyId(?)");
        $stmt->bind_param("i",$priviledgeId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>