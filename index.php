<?php
// === GLOBAL INIT: Session + DB + Security ===
require_once __DIR__ . "/includes/conn.php"; // This includes session_start, DB, CSRF setup
require_once __DIR__ . "/includes/security.php"; // Optional if not auto-included by conn.php

// === ENFORCE LOGIN ===
require_login(); // Blocks unauthenticated users (redirects to login)

// === PAGE ROUTING ===
$currentPage = $_GET['page'] ?? 'dashboard';
$page = basename($currentPage); // Prevents path traversal like ?page=../../../etc/passwd

$page_path = __DIR__ . "/templates/pages/{$page}.php";

// === LAYOUT ===
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

            <!-- Global Modals -->
            <?php include __DIR__ . "/templates/modals/logout.modal.php"; ?>
            <?php include __DIR__ . "/templates/modals/adddivision.modal.php"; ?>
        </div>

        <?php include __DIR__ . "/templates/modals/additems.modal.php"; ?>
        <?php include __DIR__ . "/includes/footer.php"; ?>
    </div>
</div>
