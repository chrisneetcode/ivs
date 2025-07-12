<?php
include __DIR__ . '/includes/auth.php';
include __DIR__ . '/includes/header.php';
?>

<div class="container text-center mt-5 pt-5">
    <div class="error mx-auto" data-text="404" style="font-size: 10rem; font-weight: 800; color: #5a5c69;">404</div>
    <p class="lead text-gray-800 mb-4">Page Not Found</p>
    <p class="text-gray-500 mb-4">It looks like you found a glitch in the matrix...</p>
    <a href="<?= base_url('/') ?>" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php
include __DIR__ . '/includes/footer.php';
?>
