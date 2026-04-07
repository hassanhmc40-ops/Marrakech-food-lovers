<?php
class Database{
    private $host = "localhost";
    private $dbname = "marrakech-food-lovers";
    private $username = "root";
    private $password = '';
    private $conn;

    public function getConnection(){
       $this->conn = null;

       try{

       $this->conn = new PDO ("mysql:host=" . $this->host . ",dbname=". $this->dbname , $this->username , $this->password);
       $this->conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
       }catch(PDOException $e){
        die("connection failed:" . $e->getMessage());
       }
       return $this->conn;
    }
    public static function connect(){
        $db = new self();
        return $db->getConnection();
    }
}

?>