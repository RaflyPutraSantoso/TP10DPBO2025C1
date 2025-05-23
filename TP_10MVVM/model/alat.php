<?php
class Alat {
    private $conn;
    private $table_name = "alat";

    public $id;
    public $nama;
    public $stok;
    public $harga;
    public $jenis_id;
    public $supplier_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT a.*, j.nama_jenis, s.nama as supplier_name 
                  FROM " . $this->table_name . " a
                  LEFT JOIN jenis_alat j ON a.jenis_id = j.id
                  LEFT JOIN supplier s ON a.supplier_id = s.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nama=:nama, stok=:stok, harga=:harga, jenis_id=:jenis_id, supplier_id=:supplier_id";
        $stmt = $this->conn->prepare($query);

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->stok = htmlspecialchars(strip_tags($this->stok));
        $this->harga = htmlspecialchars(strip_tags($this->harga));
        $this->jenis_id = htmlspecialchars(strip_tags($this->jenis_id));
        $this->supplier_id = htmlspecialchars(strip_tags($this->supplier_id));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":jenis_id", $this->jenis_id);
        $stmt->bindParam(":supplier_id", $this->supplier_id);

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

        $this->nama = $row['nama'];
        $this->stok = $row['stok'];
        $this->harga = $row['harga'];
        $this->jenis_id = $row['jenis_id'];
        $this->supplier_id = $row['supplier_id'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama=:nama, stok=:stok, harga=:harga, jenis_id=:jenis_id, supplier_id=:supplier_id 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->stok = htmlspecialchars(strip_tags($this->stok));
        $this->harga = htmlspecialchars(strip_tags($this->harga));
        $this->jenis_id = htmlspecialchars(strip_tags($this->jenis_id));
        $this->supplier_id = htmlspecialchars(strip_tags($this->supplier_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":jenis_id", $this->jenis_id);
        $stmt->bindParam(":supplier_id", $this->supplier_id);
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