<?php 
class Ser_Pictures {
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
     * Storing new Picture
     * returns Boolean
     */
    public function addPicture($name,$path,$active) {
        $stmt = $this->conn->prepare("CALL sp_AddPicture(?,?,?)");
		$stmt->bind_param("ssi",$name,$path,$active);
		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    	
    /**
     * Edit picture 
     * @param pictureId, username, password
     * returns Boolean
     */
    public function editPicture($pictureId,$name,$path,$active) {
        $stmt = $this->conn->prepare("CALL sp_EditPicture(?,?,?,?)");
		$stmt->bind_param("issi",$pictureId,$name,$path,$active);
        $result = $stmt->execute();
        $stmt->close(); 
		if($result) return true;
		else return false;
    }
    /**
     * Get all Pictures 
     * returns json/Null
     */
    public function Getpictures() {
        $stmt = $this->conn->prepare("CALL sp_GetPictures()");
        if ($stmt->execute()) {
            $pictures = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //fetch picture data and picture in array
            $stmt->close();
            if ($pictures==true) {
                return $pictures;
            }
        } else return NULL;
    }
    
    /**
     * Get all pictures 
     * params picture Id
     * returns json/Null
     */
    public function GetPictureById($pictureId) {
        $stmt = $this->conn->prepare("CALL sp_GetPictureById(?)");
        $stmt->bind_param("i",$pictureId);
        if ($stmt->execute()) {
            $pictures = $stmt->get_result()->fetch_assoc(); //fetch picture data and picture in array
            $stmt->close();
            if ($pictures==true) {
                return $pictures;
            }
        } else return NULL;
    }

        /**
     * Delete Picture By Id 
     * params Picture Id
     * returns json/Null
     */
    public function DeletePictureById($pictureId) {
        $stmt = $this->conn->prepare("CALL sp_DeletePicturebyId(?)");
        $stmt->bind_param("i",$pictureId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else return false;
    }

}
?>