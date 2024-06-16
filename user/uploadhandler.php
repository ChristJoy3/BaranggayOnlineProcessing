<?php
class UploadHandler {
    private $targetDir;
    private $allowedTypes;
    private $maxFileSize;
    private $conn;

    public function __construct($targetDir = "uploads/", $allowedTypes = ["image/jpeg", "image/png", "image/gif"], $maxFileSize = 500000) {
        $this->targetDir = $targetDir;
        $this->allowedTypes = $allowedTypes;
        $this->maxFileSize = $maxFileSize;

        // Create the target directory if it doesn't exist
        if (!is_dir($this->targetDir)) {
            if (!mkdir($this->targetDir, 0777, true) && !is_dir($this->targetDir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $this->targetDir));
            }
        }

        // Database connection
        $this->conn = new mysqli('localhost', 'root', '', 'system');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function upload($file, $username) {
        $fileName = basename($file["name"]);
        $uploadedFilePath = $this->targetDir . $fileName;
        $fileType = mime_content_type($file["tmp_name"]);

        if (!in_array($fileType, $this->allowedTypes)) {
            throw new Exception("Unsupported file type.");
        }

        if ($file["size"] > $this->maxFileSize) {
            throw new Exception("File is too large.");
        }

        if (!move_uploaded_file($file["tmp_name"], $uploadedFilePath)) {
            throw new Exception("Error uploading file.");
        }

        return $uploadedFilePath;
    }

    public function storeFilePathInDatabase($username, $filePath) {
        try {
            $userId = $this->getUserIdByUsername($username);
            $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $filePath, $userId);
            if (!$stmt->execute()) {
                throw new Exception("Error storing file path in database: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error storing file path in database: " . $e->getMessage());
        }
    }

    private function getUserIdByUsername($username) {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        } else {
            throw new Exception("User not found.");
        }
    }

    public function __destruct() {
        // Close database connection
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
