<?php
require_once 'model/Supplier.php';
require_once 'config/Database.php';

class SupplierViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Supplier($db);
    }

    public function getAllSupplier() {
        return $this->model->read();
    }

    public function getSupplierById($id) {
        $this->model->id = $id;
        $this->model->readOne();
        return $this->model;
    }

    public function createSupplier($data) {
        $this->model->nama = $data['nama'];
        $this->model->alamat = $data['alamat'];
        $this->model->telepon = $data['telepon'];
        $this->model->email = $data['email'];
        return $this->model->create();
    }

    public function updateSupplier($data) {
        $this->model->id = $data['id'];
        $this->model->nama = $data['nama'];
        $this->model->alamat = $data['alamat'];
        $this->model->telepon = $data['telepon'];
        $this->model->email = $data['email'];
        return $this->model->update();
    }

    public function deleteSupplier($id) {
        $this->model->id = $id;
        return $this->model->delete();
    }
}
?>