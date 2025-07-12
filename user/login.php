<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php?page=dashboard");
    exit;
}
?>
<?php 
include '../includes/header.php'; 
?>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <!-- Logo and Title -->
                <div class="d-flex align-items-center mb-4">
                  <img src="../src/images/dar_logo.png" alt="logo" style="width: 100px; height: auto;">
                  <div class="ms-3">
                    <div class="fw-bold fs-5">Department of Agrarian Reform</div>
                    <div class="text-muted">Province of La Union</div>
                  </div>
                </div>

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?= $error ?></div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="login.process.php">
                  <div class="mb-4 text-center fw-bold">Welcome to Integrated Supplies and Management System</div>
                  <p class="text-center">Please login to your account</p>

                  <div class="form-outline mb-4">
                    <input type="text" name="username" class="form-control" required />
                    <label class="form-label">Username</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password" class="form-control" required />
                    <label class="form-label">Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Log in</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include '../includes/footer.php'; ?>
