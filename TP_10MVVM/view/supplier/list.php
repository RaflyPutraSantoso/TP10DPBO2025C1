<?php
require_once 'viewmodel/SupplierViewModel.php';
$viewModel = new SupplierViewModel();
$stmt = $viewModel->getAllSupplier();
?>

<h2>Daftar Supplier</h2>
<a href="index.php?page=supplier&action=create" class="btn btn-primary mb-3">Tambah Supplier</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['telepon']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="index.php?page=supplier&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?page=supplier&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>