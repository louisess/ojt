<?php
class Database{

    private $host = "localhost";
    private $db = "id16930867_certdbase";
    private $username = "id16930867_admin";
    private $password = "LbYiw!I{E\GQq6wr";
    public $conn;

    
    public function getConnection(){
        $this->conn = null; // reset database every time its opened.

        try {
            $this->conn = new PDO("mysql:hosts=" .$this->host . ";dbname=" . $this->db, $this->username, $this->password); // connection to database
            
        }
        catch (PDOException $exception){
            echo "Connection error:" . $exception->getMessage();
        }
        return $this->conn;
    }



}

?>