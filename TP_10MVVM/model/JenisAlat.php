<?php
class JenisAlat {
    private $conn;
    private $table_name = "jenis_alat";

    public $id;
    public $nama_jenis;
    public $deskripsi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_jenis=:nama_jenis, deskripsi=:deskripsi";
        $stmt = $this->conn->prepare($query);

        $this->nama_jenis = htmlspecialchars(strip_tags($this->nama_jenis));
        $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));

        $stmt->bindParam(":nama_jenis", $this->nama_jenis);
        $stmt->bindParam(":deskripsi", $this->deskripsi);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nama_jenis = $row['nama_jenis'];
        $this->deskripsi = $row['deskripsi'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_jenis=:nama_jenis, deskripsi=:deskripsi WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama_jenis = htmlspecialchars(strip_tags($this->nama_jenis));
        $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nama_jenis", $this->nama_jenis);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>