<?php
include_once "Database.php"; // Assuming Database.php contains your Database class

class Transaction {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();  
    }

    public function getAllTransactions() {
        $sql = "SELECT * FROM paper_transactions";
        return $this->db->executeQuery($sql);
    }

    public function generateTrackingCode() {
        // Generate a random tracking code (You can implement your logic here)
        return "TR-" . uniqid();
    }

    public function createPaperTransaction($tracking_code, $name, $service_type, $pickup_date, $date_requested, $purpose) {
        $status = "pending"; // Initial status for new transactions
        $sql = "INSERT INTO paper_transactions (tracking_code, name, service_type, pickup_date, date_requested, purpose, status) 
                VALUES (:tracking_code, :name, :service_type, :pickup_date, :date_requested, :purpose, :status)";
        $params = [
            ':tracking_code' => $tracking_code,
            ':name' => $name,
            ':service_type' => $service_type,
            ':pickup_date' => $pickup_date,
            ':date_requested' => $date_requested,
            ':purpose' => $purpose,
            ':status' => $status
        ];
        return $this->db->executeQuery($sql, $params);
    }

    public function searchTransaction($tracking_code) {
        $sql = "SELECT * FROM paper_transactions WHERE tracking_code = :tracking_code";
        $params = [':tracking_code' => $tracking_code];
        return $this->db->executeQuery($sql, $params);
    }
    
    public function updateTransactionStatus($tracking_code, $status) {
        $sql = "UPDATE paper_transactions SET status = :status WHERE tracking_code = :tracking_code";
        $params = [
            ':status' => $status,
            ':tracking_code' => $tracking_code
        ];
        return $this->db->executeQuery($sql, $params);
    }

    public function deleteTransaction($tracking_code) {
        $sql = "DELETE FROM paper_transactions WHERE tracking_code = :tracking_code";
        $params = [':tracking_code' => $tracking_code];
        return $this->db->executeQuery($sql, $params);
    }

    public function updateTransaction($tracking_code, $name, $service_type, $pickup_date, $date_requested, $status) {
        $sql = "UPDATE paper_transactions 
                SET name = :name, service_type = :service_type, pickup_date = :pickup_date, date_requested = :date_requested, status = :status 
                WHERE tracking_code = :tracking_code";
        $params = [
            ':tracking_code' => $tracking_code,
            ':name' => $name,
            ':service_type' => $service_type,
            ':pickup_date' => $pickup_date,
            ':date_requested' => $date_requested,
            ':status' => $status
        ];
        return $this->db->executeQuery($sql, $params);
    }



    

}
?>
