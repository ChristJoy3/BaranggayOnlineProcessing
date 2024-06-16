<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct($host = "192.250.235.45", $username = "dfoiwidm_BaranggayOnlineProcessing", $password = "8xDT2fy;4LM4b(", $db_name = "dfoiwidm_BaranggayOnlineProcessing") {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;

        $this->getConnection();
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function executeQuery($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}
?>
