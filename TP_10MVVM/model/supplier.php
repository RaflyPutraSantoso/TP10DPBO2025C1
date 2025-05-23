<?php
class Supplier {
    private $conn;
    private $table_name = "supplier";

    public $id;
    public $nama;
    public $alamat;
    public $telepon;
    public $email;

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
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nama=:nama, alamat=:alamat, telepon=:telepon, email=:email";
        $stmt = $this->conn->prepare($query);

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->telepon = htmlspecialchars(strip_tags($this->telepon));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":telepon", $this->telepon);
        $stmt->bindParam(":email", $this->email);

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
        $this->alamat = $row['alamat'];
        $this->telepon = $row['telepon'];
        $this->email = $row['email'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama=:nama, alamat=:alamat, telepon=:telepon, email=:email 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->telepon = htmlspecialchars(strip_tags($this->telepon));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":telepon", $this->telepon);
        $stmt->bindParam(":email", $this->email);
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