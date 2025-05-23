<?php
require_once 'view/template/header.php';
require_once 'viewmodel/AlatViewModel.php';
require_once 'viewmodel/JenisAlatViewModel.php';
require_once 'viewmodel/SupplierViewModel.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'alat';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch($page) {
    case 'jenis_alat':
        $viewModel = new JenisAlatViewModel();
        if($action == 'create' || $action == 'edit') {
            require_once 'view/jenis_alat/form.php';
        } elseif($action == 'delete') {
            $viewModel->deleteJenisAlat($_GET['id']);
            header("Location: index.php?page=jenis_alat");
            exit();
        } else {
            require_once 'view/jenis_alat/list.php';
        }
        break;
        
    case 'supplier':
        $viewModel = new SupplierViewModel();
        if($action == 'create' || $action == 'edit') {
            require_once 'view/supplier/form.php';
        } elseif($action == 'delete') {
            $viewModel->deleteSupplier($_GET['id']);
            header("Location: index.php?page=supplier");
            exit();
        } else {
            require_once 'view/supplier/list.php';
        }
        break;
        
    case 'alat':
    default:
        $viewModel = new AlatViewModel();
        if($action == 'create' || $action == 'edit') {
            require_once 'view/alat/form.php';
        } elseif($action == 'delete') {
            $viewModel->deleteAlat($_GET['id']);
            header("Location: index.php?page=alat");
            exit();
        } else {
            require_once 'view/alat/list.php';
        }
        break;
}

require_once 'view/template/footer.php';
?>