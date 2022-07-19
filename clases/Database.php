<?php 

class Database{
    private string $hostname = "localhost";
    private string $user = "root";
    private string $password = "root";
    private string $dbname = "muo-beta";
    private $db;

    
    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=".$this->hostname.";dbname=".$this->dbname.";charset=UTF8", $this->user, $this->password);
        
        } catch (\PDOException $e) {
            
        }
    }
}

?>