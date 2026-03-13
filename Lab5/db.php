<?php
class Service {
    private $host = "localhost";
    private $dbname = "company";
    private $user = "root";
    private $password = "password";
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->user,
                $this->password
            );
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }
    public function getAllEmployees() {
        return $this->connection->query("SELECT * FROM emp");
    }
    public function insertEmployee($fname, $lname, $email, $password, $address) {
        $stmt = $this->connection->prepare(
            "INSERT INTO emp (f_name, l_name, email, pass, address) VALUES (?,?,?,?,?)"
        );
        return $stmt->execute([$fname, $lname, $email, $password, $address]);
    }
    public function getEmployeeById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM emp WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateEmployee($id, $fname, $lname, $email, $address) {
        $stmt = $this->connection->prepare(
            "UPDATE emp SET f_name=?, l_name=?, email=?, address=? WHERE id=?"
        );
        return $stmt->execute([$fname, $lname, $email, $address, $id]);
    }
    public function deleteEmployee($id) {
        $stmt = $this->connection->prepare("DELETE FROM emp WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function authenticate($username, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM emp WHERE username = ? AND pass = ?");
        $stmt->execute([$username, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
class db extends Service {}