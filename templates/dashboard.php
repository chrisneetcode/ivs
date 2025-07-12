<?php
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../includes/header.php';
?>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

                 <!-- Main Content -->
                <!-- Begin Page Content -->
            <?php include __DIR__ . '/../includes/topbar.php'; ?>

            <?php include __DIR__ . '/../includes/content.php'; ?>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
<?php include __DIR__ . '/../includes/scrolltotop.php'; ?>

<?php include __DIR__ . '/../templates/modals/logout.modal.php'; ?>

<?php 
include __DIR__ . '/../includes/footer.php';
?>
