<?php 
class Ser_Adminpriviledges {
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
     * Get all Adminpriviledges 
     * returns json/Null
     */
    public function Getadminpriviledges() {
        $stmt = $this->conn->prepare("CALL sp_GetAdminpriviledges()");
        if ($stmt->execute()) {
            $adminpriviledges = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch adminpriviledge data and adminpriviledge in array
            $stmt->close();
            if ($adminpriviledges==true) {
                return $adminpriviledges;
            }
        } else return NULL;
    }

/**
     * Storing new Adminpriviledge
     * @param adminId, priviledgeId
     * returns Boolean
     */
    public function addAdminpriviledge($adminId,$priviledgeId) {
        $stmt = $this->conn->prepare("CALL sp_AddAdminpriviledge(?,?)");
		$stmt->bind_param("ii",$adminId,$priviledgeId);
		$result = $stmt->execute();
        $stmt->close();
        if ($result) return true;
        else return false;
    }

    /**
     * Edit adminpriviledge 
     * @param adminpriviledgeId, username, password
     * returns Boolean
     */
    public function editAdminpriviledge($adminpriviledgeId,$adminId,$priviledgeId) {
        $stmt = $this->conn->prepare("CALL sp_EditAdminpriviledge(?,?,?)");
		$stmt->bind_param("iii",$adminpriviledgeId,$adminId,$priviledgeId);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    
    /**
     * Get all adminpriviledges 
     * params adminpriviledge Id
     * returns json/Null
     */
    public function GetAdminpriviledgeById($adminpriviledgeId) {
        $stmt = $this->conn->prepare("CALL sp_GetAdminpriviledgeById(?)");
        $stmt->bind_param("i",$adminpriviledgeId);
        if ($stmt->execute()) {
            $adminpriviledges = $stmt->get_result()->fetch_assoc(); //fetch adminpriviledge data and adminpriviledge in array
            $stmt->close();
            if ($adminpriviledges==true) {
                return $adminpriviledges;
            }
        } else return NULL;
    }

       /**
     * Delete adminpriviledge By Id 
     * params adminpriviledge Id
     * returns json/Null
     */
    public function DeleteAdminpriviledgeById($adminpriviledgeId) {
        $stmt = $this->conn->prepare("CALL sp_DeleteAdminpriviledgebyId(?)");
        $stmt->bind_param("i",$adminpriviledgeId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>