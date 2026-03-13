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
  <title>Users - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="admin">
  <!-- Header -->
  <?php include("../../components/admin/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secAdminUsers">
      <div class="secAdminUsers__inner">
        <h1 class="secAdminUsers__title animation-downwards">User Management</h1>
        <p class="secAdminUsers__sub animation-downwards">View all system users by role.</p>
        <!-- ================= ADMINS ================= -->
        <div class="secAdminUsers__panel animation-left">
          <h2>Admins</h2>
          <div class="secAdminUsers__tableWrap">
            <table id="adminTable" class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Date Created</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <!-- ================= LIBRARIANS ================= -->
        <div class="secAdminUsers__panel animation-left">
          <h2>Librarians</h2>
          <div class="secAdminUsers__tableWrap">
            <table id="librarianTable" class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Date Created</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <!-- ================= STUDENTS ================= -->
        <div class="secAdminUsers__panel animation-left">
          <h2>Students</h2>
          <div class="secAdminUsers__tableWrap">
            <table id="studentTable" class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Date Created</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/footer.php"); ?>
  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?= BASE_URL ?>assets/js/admin/users.js"></script>

</body>

</html>