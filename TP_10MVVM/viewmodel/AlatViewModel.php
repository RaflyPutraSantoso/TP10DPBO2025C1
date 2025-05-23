<?php
require_once 'model/Alat.php';
require_once 'model/JenisAlat.php';
require_once 'model/Supplier.php';
require_once 'config/Database.php';

class AlatViewModel {
    private $model;
    private $jenisAlatModel;
    private $supplierModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Alat($db);
        $this->jenisAlatModel = new JenisAlat($db);
        $this->supplierModel = new Supplier($db);
    }

    public function getAllAlat() {
        return $this->model->read();
    }

    public function getAlatById($id) {
        $this->model->id = $id;
        $this->model->readOne();
        return $this->model;
    }

    public function getAllJenisAlat() {
        return $this->jenisAlatModel->read();
    }

    public function getAllSupplier() {
        return $this->supplierModel->read();
    }

    public function createAlat($data) {
        $this->model->nama = $data['nama'];
        $this->model->stok = $data['stok'];
        $this->model->harga = $data['harga'];
        $this->model->jenis_id = $data['jenis_id'];
        $this->model->supplier_id = $data['supplier_id'];
        return $this->model->create();
    }

    public function updateAlat($data) {
        $this->model->id = $data['id'];
        $this->model->nama = $data['nama'];
        $this->model->stok = $data['stok'];
        $this->model->harga = $data['harga'];
        $this->model->jenis_id = $data['jenis_id'];
        $this->model->supplier_id = $data['supplier_id'];
        return $this->model->update();
    }

    public function deleteAlat($id) {
        $this->model->id = $id;
        return $this->model->delete();
    }
}
?>