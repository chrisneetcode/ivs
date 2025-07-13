<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /ivs/user/login.php");
    exit;
}

$currentPage = $_GET['page'] ?? 'dashboard';
$page = basename($currentPage);


$page_path = __DIR__ . "/templates/pages/{$page}.php";

// Layout wrappers only once
require_once __DIR__ . "/includes/auth.php";
require_once __DIR__ . "/includes/header.php";
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include __DIR__ . "/includes/sidebar.php"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <?php include __DIR__ . "/includes/topbar.php"; ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php
                if (file_exists($page_path)) {
                    include $page_path;
                } else {
                    include __DIR__ . "/404.php";
                }
                ?>
            </div>
            <!-- End Page Content -->

        </div>
        <!-- End Main Content -->

        <?php include __DIR__ . "/templates/modals/logout.modal.php"; ?>
        <?php include __DIR__ . "/templates/modals/adduser.modal.php"; ?>
        <?php include __DIR__ . "/templates/modals/updateuser.modal.php"; ?>
        <?php include __DIR__ . "/templates/modals/updatesupplier.modal.php"; ?>
        <?php include __DIR__ . "/templates/modals/addsupplier.modal.php"; ?>

        <?php include __DIR__ . "/includes/footer.php"; ?>

    </div>
    <!-- End Content Wrapper -->
</div>
<!-- End Page Wrapper -->
