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

}
?>