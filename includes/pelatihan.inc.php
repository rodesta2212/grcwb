<?php
class Pelatihan {
	private $conn;
    private $table_pelatihan = 'pelatihan';

    public $id_pelatihan;
    public $nama;
    public $deskripsi;
    public $tgl_mulai;
    public $tgl_selesai;
	public $gambar;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_pelatihan} VALUES(?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_pelatihan);
        $stmt->bindParam(2, $this->nama);
        $stmt->bindParam(3, $this->deskripsi);
        $stmt->bindParam(4, $this->tgl_mulai);
        $stmt->bindParam(5, $this->tgl_selesai);
		$stmt->bindParam(6, $this->gambar);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_pelatihan) AS code FROM {$this->table_pelatihan}";
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

	function readAll() {
		$query = "SELECT id_pelatihan, nama, deskripsi, tgl_mulai, tgl_selesai, gambar
		FROM {$this->table_pelatihan}
		ORDER BY id_pelatihan ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readActive() {
		$query = "SELECT id_pelatihan, nama, deskripsi, tgl_mulai, tgl_selesai, gambar
		FROM {$this->table_pelatihan}
		WHERE CURDATE() <= tgl_mulai
		ORDER BY id_pelatihan ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT id_pelatihan, nama, deskripsi, tgl_mulai, tgl_selesai, gambar
		FROM {$this->table_pelatihan}
		WHERE id_pelatihan=:id_pelatihan LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_pelatihan = $row['id_pelatihan'];
		$this->nama = $row['nama'];
		$this->deskripsi = $row['deskripsi'];
		$this->tgl_mulai = $row['tgl_mulai'];
		$this->tgl_selesai = $row['tgl_selesai'];
		$this->gambar = $row['gambar'];
	}

	function update() {
		$query = "UPDATE {$this->table_pelatihan}
			SET
                id_pelatihan = :id_pelatihan,
				nama = :nama,
                deskripsi = :deskripsi,
                tgl_mulai = :tgl_mulai,
				tgl_selesai = :tgl_selesai,
				gambar = :gambar
			WHERE
				id_pelatihan = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':deskripsi', $this->deskripsi);
        $stmt->bindParam(':tgl_mulai', $this->tgl_mulai);
        $stmt->bindParam(':tgl_selesai', $this->tgl_selesai);
		$stmt->bindParam(':gambar', $this->gambar);
        $stmt->bindParam(':id', $this->id_pelatihan);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_pelatihan} WHERE id_pelatihan = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_pelatihan);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

}
