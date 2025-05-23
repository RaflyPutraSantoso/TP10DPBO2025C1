<?php
require_once 'viewmodel/AlatViewModel.php';
$viewModel = new AlatViewModel();
$stmt = $viewModel->getAllAlat();
?>

<h2>Daftar Alat Camping</h2>
<a href="index.php?page=alat&action=create" class="btn btn-primary mb-3">Tambah Alat</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Jenis</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo number_format($row['harga'], 2); ?></td>
            <td><?php echo $row['nama_jenis']; ?></td>
            <td><?php echo $row['supplier_name']; ?></td>
            <td>
                <a href="index.php?page=alat&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?page=alat&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>