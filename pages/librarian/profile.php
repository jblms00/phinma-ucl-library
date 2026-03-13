<?php
session_start();
include("../../phpscripts/database-connection.php");
include("../../phpscripts/check-login.php");
include("../../includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="student">
  <!-- Header -->
  <?php include("../../components/student/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secProfile">
      <div class="secProfile__inner">
        <div class="secReservation__breascrumb mb-5">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </nav>
        </div>
        <h1 class="secProfile__title animation-pulse">My Profile</h1>
        <div class="secProfile__grid">
          <!-- Edit Profile -->
          <div class="secProfile__card animation-left">
            <h2 class="secProfile__cardTitle">Edit Profile</h2>
            <form id="formUpdateProfile">
              <div class="secProfile__field">
                <label>Username</label>
                <input type="text" name="username" required>
              </div>
              <div class="secProfile__field">
                <label>Email</label>
                <input type="email" name="email" required>
              </div>
              <button type="submit" class="secProfile__btn">
                Save Changes
              </button>
            </form>
          </div>
          <!-- Change Password -->
          <div class="secProfile__card animation-right">
            <h2 class="secProfile__cardTitle">Change Password</h2>
            <form id="formChangePassword">
              <div class="secProfile__field">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
              </div>
              <div class="secProfile__field">
                <label>New Password</label>
                <input type="password" name="new_password" required>
              </div>
              <div class="secProfile__field">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required>
              </div>
              <button type="submit" class="secProfile__btn secProfile__btn--secondary">
                Change Password
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/footer.php"); ?>

  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/profile.js"></script>
</body>

</html>