<?php
class Login {
    private $conn;
    private $table_user = "user";
    private $table_peserta = "peserta";

    public $user;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkPeserta();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['id_peserta'] = $user['id_peserta'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['foto'] = $user['foto'];
            $_SESSION['role'] = $user['role'];
            return $user['nama'];
        }else {
            $user = $this->checkAdmin();
            if ($user) {
                $this->user = $user;
                session_start();
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                // $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                return $user['id_user'];
            }
        }
        return false;
    }

    protected function checkPeserta() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_peserta.' ON '.$this->table_user.'.id_user='.$this->table_peserta.'.id_user WHERE username=? AND password=? AND role="peserta" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    protected function checkAdmin() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' WHERE username=? AND password=? AND role!="peserta" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
}
