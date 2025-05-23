<?php
require_once 'model/JenisAlat.php';
require_once 'config/Database.php';

class JenisAlatViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new JenisAlat($db);
    }

    public function getAllJenisAlat() {
        return $this->model->read();
    }

    public function getJenisAlatById($id) {
        $this->model->id = $id;
        $this->model->readOne();
        return $this->model;
    }

    public function createJenisAlat($data) {
        $this->model->nama_jenis = $data['nama_jenis'];
        $this->model->deskripsi = $data['deskripsi'];
        return $this->model->create();
    }

    public function updateJenisAlat($data) {
        $this->model->id = $data['id'];
        $this->model->nama_jenis = $data['nama_jenis'];
        $this->model->deskripsi = $data['deskripsi'];
        return $this->model->update();
    }

    public function deleteJenisAlat($id) {
        $this->model->id = $id;
        return $this->model->delete();
    }
}
?>