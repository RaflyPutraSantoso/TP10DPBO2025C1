<?php
require_once 'viewmodel/JenisAlatViewModel.php';
$viewModel = new JenisAlatViewModel();
$stmt = $viewModel->getAllJenisAlat();
?>

<h2>Daftar Jenis Alat Camping</h2>
<a href="index.php?page=jenis_alat&action=create" class="btn btn-primary mb-3">Tambah Jenis Alat</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Jenis</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama_jenis']; ?></td>
            <td><?php echo $row['deskripsi']; ?></td>
            <td>
                <a href="index.php?page=jenis_alat&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?page=jenis_alat&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>