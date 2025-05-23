<?php
require_once 'viewmodel/AlatViewModel.php';
$viewModel = new AlatViewModel();

if(isset($_GET['id'])) {
    $alat = $viewModel->getAlatById($_GET['id']);
}

$jenisAlat = $viewModel->getAllJenisAlat();
$suppliers = $viewModel->getAllSupplier();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama' => $_POST['nama'],
        'stok' => $_POST['stok'],
        'harga' => $_POST['harga'],
        'jenis_id' => $_POST['jenis_id'],
        'supplier_id' => $_POST['supplier_id']
    ];

    if(isset($_POST['id'])) {
        $data['id'] = $_POST['id'];
        $success = $viewModel->updateAlat($data);
    } else {
        $success = $viewModel->createAlat($data);
    }

    if($success) {
        header("Location: index.php?page=alat");
        exit();
    }
}
?>

<h2><?php echo isset($alat) ? 'Edit' : 'Tambah'; ?> Alat Camping</h2>
<form method="POST">
    <?php if(isset($alat)): ?>
        <input type="hidden" name="id" value="<?php echo $alat->id; ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Nama Alat</label>
        <input type="text" class="form-control" name="nama" value="<?php echo isset($alat) ? $alat->nama : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" value="<?php echo isset($alat) ? $alat->stok : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" step="0.01" class="form-control" name="harga" value="<?php echo isset($alat) ? $alat->harga : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis Alat</label>
        <select class="form-select" name="jenis_id" required>
            <option value="">Pilih Jenis Alat</option>
            <?php while ($jenis = $jenisAlat->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $jenis['id']; ?>" 
                    <?php if(isset($alat) && $alat->jenis_id == $jenis['id']) echo 'selected'; ?>>
                    <?php echo $jenis['nama_jenis']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Supplier</label>
        <select class="form-select" name="supplier_id" required>
            <option value="">Pilih Supplier</option>
            <?php while ($supplier = $suppliers->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $supplier['id']; ?>" 
                    <?php if(isset($alat) && $alat->supplier_id == $supplier['id']) echo 'selected'; ?>>
                    <?php echo $supplier['nama']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php?page=alat" class="btn btn-secondary">Kembali</a>
</form>