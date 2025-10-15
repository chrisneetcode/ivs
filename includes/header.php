<?php require_once __DIR__ . '/../initialize.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Management System</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FontAwesome CSS (via CDN and local backup) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

  <!-- SB Admin 2 Template CSS -->
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">

  <!-- Custom Login Page CSS -->
  <link href="<?= base_url('css/user.login.css') ?>" rel="stylesheet">

  <!-- Optional: Your global custom styles -->
  <link href="<?= base_url('css/custom.css') ?>" rel="stylesheet">

  <!-- Style CSS -->
   <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">


</head>
<body>

<!-- Toast Container: Top Center, Auto-size -->
<div class="position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1060;">
  <div id="liveToast" class="toast border-0 shadow-lg rounded-3" role="alert" aria-live="assertive" aria-atomic="true" style="width: auto; max-width: 90vw;">
    <div class="toast-body d-flex justify-content-between align-items-center gap-3 fw-semibold fs-6 px-3 py-2" id="toastMessage">
      <!-- Message gets inserted here -->
      <span class="flex-grow-1"></span>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>


