<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body class="adminLogin" data-role="admin">
  <section class="secAdminLogin">
    <div class="secAdminLogin__card animation-pulse">
      <div class="secAdminLogin__header">
        <h1 class="secAdminLogin__title">Admin Login</h1>
        <p class="secAdminLogin__sub">Phinma UCL Library System</p>
      </div>
      <form id="adminLoginForm" class="secAdminLogin__form needs-validation" novalidate>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
          <div class="invalid-feedback">
            Password is required.
          </div>
        </div>
        <button type="submit" id="btnLogin" class="btn secAdminLogin__btn w-100">Login</button>
      </form>
    </div>
  </section>
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/admin/login.js"></script>
</body>

</html>