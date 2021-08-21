<?php
/*Connection to database Object*/
class DB_Connect {
    private $conn;
    /*Connecting to database function*/
    public function connect() {
        /*Get config variables*/
        require_once 'Config.php';
        /*Connecting to mysql database*/
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        /*Set charset to utf8 for arabic language*/
        mysqli_set_charset( $this->conn,'utf8');
        /*Return database handler*/
        return $this->conn;
    }
}
?>
