<?php
class User {
    private $conn;
    private $table_user = 'user';
	private $table_mahasiswa = 'mahasiswa';

    public $id_user;
    public $username;
    public $password;
    public $role;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
        $query = "INSERT INTO {$this->table_user} (id_user, username, password, role) VALUES(:id_user, :username, :password, :role)";

        $stmt = $this->conn->prepare($query);
        // user
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
    }

    function getNewId() {
		$query = "SELECT MAX(id_user) AS code FROM {$this->table_user}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function genCode($latest, $key, $chars = 0) {
        $new = intval(substr($latest, strlen($key))) + 1;
        $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
        return $key . $numb;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_user} WHERE id_user=:id_user LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_user', $this->id_user);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_user = $row['id_user'];
        $this->username = $row['username'];
		$this->password = $row['password'];
		$this->role = $row['role'];
	}

	function update() {
		$query = "UPDATE {$this->table_user}
			SET
                id_user = :id_user,
                username = :username,
				password = :password,
				role = :role
			WHERE
				id_user = :id_user";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':password', $this->password);
		$stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':id_user', $this->id_user);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

    function delete() {
		$query = "DELETE FROM {$this->table_user} WHERE id_user = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_user);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
    }

}
