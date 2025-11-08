<?php
class Database {
    private $host = "localhost";
    private $dbname = "bdusua";  
    private $user = "root";
    private $pass = "";
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("❌ Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}
?>
