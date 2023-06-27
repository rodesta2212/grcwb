<?php
class JadwalRinciPelatihan {
	private $conn;
    private $table_jadwal_rinci_pelatihan = 'jadwal_rinci_pelatihan';
	private $table_peserta = 'peserta';
	private $table_pelatihan = 'pelatihan';
	private $table_program = 'program';

    public $id_jadwal_rinci_pelatihan;
    public $id_peserta;
    public $id_pelatihan;
    public $id_program;
    public $status_pelatihan;
	public $status_pembayaran;
	public $file_pembayaran;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_jadwal_rinci_pelatihan} VALUES(?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_jadwal_rinci_pelatihan);
        $stmt->bindParam(2, $this->id_peserta);
        $stmt->bindParam(3, $this->id_pelatihan);
        $stmt->bindParam(4, $this->id_program);
        $stmt->bindParam(5, $this->status_pelatihan);
		$stmt->bindParam(6, $this->status_pembayaran);
		$stmt->bindParam(7, $this->file_pembayaran);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_jadwal_rinci_pelatihan) AS code FROM {$this->table_jadwal_rinci_pelatihan}";
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
		$query = "SELECT id_jadwal_rinci_pelatihan, id_peserta, id_pelatihan, id_program, status_pelatihan, status_pembayaran, file_pembayaran
		FROM {$this->table_jadwal_rinci_pelatihan}
		ORDER BY id_jadwal_rinci_pelatihan ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readPeserta() {
		$query = "SELECT A.id_jadwal_rinci_pelatihan, A.status_pelatihan, A.status_pembayaran, A.file_pembayaran,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto,
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan,
		D.id_program, D.nama AS nama_program, D.deskripsi AS deskripsi_program, D.jam_mulai, D.jam_selesai, D.gambar AS gambar_program, D.biaya, D.senin, D.selasa, D.rabu, D.kamis, D.jumat, D.sabtu, D.minggu
		FROM {$this->table_jadwal_rinci_pelatihan} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		LEFT JOIN {$this->table_program} D ON A.id_program=D.id_program 
		WHERE A.id_peserta=:id_peserta
		ORDER BY A.id_jadwal_rinci_pelatihan ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_peserta', $this->id_peserta);
		$stmt->execute();

		return $stmt;
	}

	function readPesertaPelatihan() {
		$query = "SELECT A.id_jadwal_rinci_pelatihan, A.status_pelatihan, A.status_pembayaran, A.file_pembayaran,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto,
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan,
		D.id_program, D.nama AS nama_program, D.deskripsi AS deskripsi_program, D.jam_mulai, D.jam_selesai, D.gambar AS gambar_program, D.biaya, D.senin, D.selasa, D.rabu, D.kamis, D.jumat, D.sabtu, D.minggu
		FROM {$this->table_jadwal_rinci_pelatihan} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		LEFT JOIN {$this->table_program} D ON A.id_program=D.id_program 
		WHERE C.id_pelatihan=:id_pelatihan
		ORDER BY B.nama ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
		$stmt->execute();

		return $stmt;
	}

	function readMenungguKorfirmasi() {
		$query = "SELECT A.id_jadwal_rinci_pelatihan, A.status_pelatihan, A.status_pembayaran, A.file_pembayaran,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto, 
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan,
		D.id_program, D.nama AS nama_program, D.deskripsi AS deskripsi_program, D.jam_mulai, D.jam_selesai, D.gambar AS gambar_program, D.biaya, D.senin, D.selasa, D.rabu, D.kamis, D.jumat, D.sabtu, D.minggu
		FROM {$this->table_jadwal_rinci_pelatihan} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		LEFT JOIN {$this->table_program} D ON A.id_program=D.id_program 
		WHERE A.status_pembayaran = 'menunggu konfirmasi' OR 
		A.status_pelatihan = 'pelatihan' AND C.tgl_mulai <= CURDATE() AND CURDATE() <= C.tgl_selesai
		ORDER BY A.id_jadwal_rinci_pelatihan ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readNow() {
		$query = "SELECT A.id_jadwal_rinci_pelatihan, A.status_pelatihan, A.status_pembayaran, A.file_pembayaran,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto,
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan,
		D.id_program, D.nama AS nama_program, D.deskripsi AS deskripsi_program, D.jam_mulai, D.jam_selesai, D.gambar AS gambar_program, D.biaya, D.senin, D.selasa, D.rabu, D.kamis, D.jumat, D.sabtu, D.minggu
		FROM {$this->table_jadwal_rinci_pelatihan} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		LEFT JOIN {$this->table_program} D ON A.id_program=D.id_program 
		WHERE C.tgl_mulai <= CURDATE() AND CURDATE() <= C.tgl_selesai
		ORDER BY A.id_jadwal_rinci_pelatihan ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT id_jadwal_rinci_pelatihan, id_peserta, id_pelatihan, id_program, status_pelatihan, status_pembayaran, file_pembayaran
		FROM {$this->table_jadwal_rinci_pelatihan}
		WHERE id_jadwal_rinci_pelatihan=:id_jadwal_rinci_pelatihan LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_jadwal_rinci_pelatihan', $this->id_jadwal_rinci_pelatihan);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_jadwal_rinci_pelatihan = $row['id_jadwal_rinci_pelatihan'];
		$this->id_peserta = $row['id_peserta'];
		$this->id_pelatihan = $row['id_pelatihan'];
		$this->id_program = $row['id_program'];
		$this->status_pelatihan = $row['status_pelatihan'];
		$this->status_pembayaran = $row['status_pembayaran'];
		$this->file_pembayaran = $row['file_pembayaran'];
	}

	function laporan() {
		$query = "SELECT A.id_jadwal_rinci_pelatihan, A.status_pelatihan, A.status_pembayaran, A.file_pembayaran,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto,
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan,
		D.id_program, D.nama AS nama_program, D.deskripsi AS deskripsi_program, D.jam_mulai, D.jam_selesai, D.gambar AS gambar_program, D.biaya, D.senin, D.selasa, D.rabu, D.kamis, D.jumat, D.sabtu, D.minggu
		FROM {$this->table_jadwal_rinci_pelatihan} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		LEFT JOIN {$this->table_program} D ON A.id_program=D.id_program 
		WHERE C.tgl_mulai >= :tgl_mulai OR :tgl_selesai >= C.tgl_selesai
		ORDER BY A.id_jadwal_rinci_pelatihan ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':tgl_mulai', $this->tgl_mulai);
		$stmt->bindParam(':tgl_selesai', $this->tgl_selesai);
		$stmt->execute();

		return $stmt;
	}

	function update() {
		$query = "UPDATE {$this->table_jadwal_rinci_pelatihan}
			SET
                id_jadwal_rinci_pelatihan = :id_jadwal_rinci_pelatihan,
				id_peserta = :id_peserta,
                id_pelatihan = :id_pelatihan,
                id_program = :id_program,
				status_pelatihan = :status_pelatihan,
				status_pembayaran = :status_pembayaran,
				file_pembayaran = :file_pembayaran
			WHERE
				id_jadwal_rinci_pelatihan = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_rinci_pelatihan', $this->id_jadwal_rinci_pelatihan);
		$stmt->bindParam(':id_peserta', $this->id_peserta);
        $stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
        $stmt->bindParam(':id_program', $this->id_program);
        $stmt->bindParam(':status_pelatihan', $this->status_pelatihan);
		$stmt->bindParam(':status_pembayaran', $this->status_pembayaran);
		$stmt->bindParam(':file_pembayaran', $this->file_pembayaran);
        $stmt->bindParam(':id', $this->id_jadwal_rinci_pelatihan);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function updateStatus() {
		$query = "UPDATE {$this->table_jadwal_rinci_pelatihan}
			SET
                id_jadwal_rinci_pelatihan = :id_jadwal_rinci_pelatihan,
				id_peserta = :id_peserta,
                id_pelatihan = :id_pelatihan,
                id_program = :id_program,
				status_pelatihan = :status_pelatihan,
				status_pembayaran = :status_pembayaran,
				file_pembayaran = :file_pembayaran
			WHERE
				id_jadwal_rinci_pelatihan = :id_jadwal_rinci_pelatihan";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_rinci_pelatihan', $this->id_jadwal_rinci_pelatihan);
		$stmt->bindParam(':id_peserta', $this->id_peserta);
        $stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
        $stmt->bindParam(':id_program', $this->id_program);
        $stmt->bindParam(':status_pelatihan', $this->status_pelatihan);
		$stmt->bindParam(':status_pembayaran', $this->status_pembayaran);
		$stmt->bindParam(':file_pembayaran', $this->file_pembayaran);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_jadwal_rinci_pelatihan} WHERE id_jadwal_rinci_pelatihan = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_jadwal_rinci_pelatihan);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

}
