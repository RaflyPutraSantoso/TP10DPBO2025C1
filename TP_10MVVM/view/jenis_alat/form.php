<?php
require_once 'viewmodel/JenisAlatViewModel.php';
$viewModel = new JenisAlatViewModel();

if(isset($_GET['id'])) {
    $jenisAlat = $viewModel->getJenisAlatById($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama_jenis' => $_POST['nama_jenis'],
        'deskripsi' => $_POST['deskripsi']
    ];

    if(isset($_POST['id'])) {
        $data['id'] = $_POST['id'];
        $success = $viewModel->updateJenisAlat($data);
    } else {
        $success = $viewModel->createJenisAlat($data);
    }

    if($success) {
        header("Location: index.php?page=jenis_alat");
        exit();
    }
}
?>

<h2><?php echo isset($jenisAlat) ? 'Edit' : 'Tambah'; ?> Jenis Alat</h2>
<form method="POST">
    <?php if(isset($jenisAlat)): ?>
        <input type="hidden" name="id" value="<?php echo $jenisAlat->id; ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Nama Jenis</label>
        <input type="text" class="form-control" name="nama_jenis" value="<?php echo isset($jenisAlat) ? $jenisAlat->nama_jenis : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi"><?php echo isset($jenisAlat) ? $jenisAlat->deskripsi : ''; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php?page=jenis_alat" class="btn btn-secondary">Kembali</a>
</form>