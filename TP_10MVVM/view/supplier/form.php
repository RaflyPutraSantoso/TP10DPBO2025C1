<?php
require_once 'viewmodel/SupplierViewModel.php';
$viewModel = new SupplierViewModel();

if(isset($_GET['id'])) {
    $supplier = $viewModel->getSupplierById($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'telepon' => $_POST['telepon'],
        'email' => $_POST['email']
    ];

    if(isset($_POST['id'])) {
        $data['id'] = $_POST['id'];
        $success = $viewModel->updateSupplier($data);
    } else {
        $success = $viewModel->createSupplier($data);
    }

    if($success) {
        header("Location: index.php?page=supplier");
        exit();
    }
}
?>

<h2><?php echo isset($supplier) ? 'Edit' : 'Tambah'; ?> Supplier</h2>
<form method="POST">
    <?php if(isset($supplier)): ?>
        <input type="hidden" name="id" value="<?php echo $supplier->id; ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Nama Supplier</label>
        <input type="text" class="form-control" name="nama" value="<?php echo isset($supplier) ? $supplier->nama : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat"><?php echo isset($supplier) ? $supplier->alamat : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" class="form-control" name="telepon" value="<?php echo isset($supplier) ? $supplier->telepon : ''; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo isset($supplier) ? $supplier->email : ''; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php?page=supplier" class="btn btn-secondary">Kembali</a>
</form>