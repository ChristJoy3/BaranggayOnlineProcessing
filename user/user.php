<?php
include_once '../admin/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();  
    }
 
    public function register($username, $email, $password, $role = 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role' => $role
        ];
        return $this->db->executeQuery($sql, $params);
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        $result = $this->db->executeQuery($sql, $params);

        if ($result && $result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function getUserCount() {
        $sql = "SELECT COUNT(*) as user_count FROM users";
        $result = $this->db->executeQuery($sql);

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['user_count'];
        } else {
            return 0;
        }
    }

    public function getPaperTransactionCount() {
        $sql = "SELECT COUNT(*) as transaction_count FROM paper_transactions";
        $result = $this->db->executeQuery($sql);

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['transaction_count'];
        } else {
            return 0;
        }
    }
 
    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //   public function getUserIdByUsername($username) {
    //     $sql = "SELECT id FROM users WHERE username = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("s", $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if ($result && $result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    //         return $row['id'];
    //     } else {
    //         throw new Exception("User not found.");
    //     }
    // }
    
}
?>

 