<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js 4.x -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- SB Admin 2 -->
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

<!-- Demo Charts -->
    <script src="<?= base_url('js/demo/chart-area-demo.js') ?>"></script>
    <script src="<?= base_url('js/demo/chart-pie-demo.js') ?>"></script>

<!-- Main JS -->
    <script src="/ivs/js/main.js?v=1"></script>
    <script src="/ivs/js/confirmation-btn.js?v=1"></script>

    
<?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toastMessage');
    const bsToast = new bootstrap.Toast(toastEl);

    <?php if (isset($_SESSION['success'])): ?>
      toastEl.classList.remove('text-bg-danger');
      toastEl.classList.add('text-bg-success');
      toastBody.textContent = <?= json_encode($_SESSION['success']) ?>;
    <?php unset($_SESSION['success']); ?>

    <?php elseif (isset($_SESSION['error'])): ?>
      toastEl.classList.remove('text-bg-success');
      toastEl.classList.add('text-bg-danger');
      toastBody.textContent = <?= json_encode($_SESSION['error']) ?>;
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    bsToast.show();
  });
</script>
<?php endif; ?>

