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
  <title>Student Dashboard - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="student">
  <header class="stHeader navbar navbar-expand-lg">
    <div class="container-fluid stHeader__container">
      <a class="navbar-brand stHeader__brand d-flex align-items-center" href="<?= BASE_URL ?>student/dashboard">
        <span class="stHeader__logo me-2">UCL</span>
        <span class="stHeader__brandText">Phinma UCL Library</span>
      </a>
      <button class="navbar-toggler stHeader__toggle" type="button" data-bs-toggle="collapse"
        data-bs-target="#studentNavbar" aria-controls="studentNavbar" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="studentNavbar">
        <nav class="navbar-nav stNav">
          <a class="nav-link stNav__link" href="<?= BASE_URL ?>student/dashboard">Dashboard</a>
          <a class="nav-link stNav__link" href="<?= BASE_URL ?>student/books">Books</a>
          <a class="nav-link stNav__link" href="<?= BASE_URL ?>student/borrowed">Borrowed</a>
          <a class="nav-link stNav__link" href="<?= BASE_URL ?>student/reservations">Reservations</a>
          <a class="nav-link stNav__link" href="<?= BASE_URL ?>student/history">History</a>
          <a class="nav-link stNav__link" href="<?= BASE_URL ?>student/profile">Profile</a>
          <a class="nav-link stNav__link stNav__link--logout" href="<?= BASE_URL ?>phpscripts/logout.php">Logout</a>
        </nav>
      </div>
    </div>
  </header>

  <main class="stMain">
    <section class="secStudentDashboard">
      <div class="secStudentDashboard__inner">
        <div class="secStudentDashboard__top">
          <div class="secStudentDashboard__welcome">
            <p class="secStudentDashboard__kicker">Welcome back</p>
            <h1 class="secStudentDashboard__title">Student Dashboard</h1>
            <p class="secStudentDashboard__sub">
              Quick access to your books, borrowed items, reservations, and history.
            </p>
          </div>
          <div class="secStudentDashboard__quick">
            <a class="secStudentDashboard__btn" href="<?= BASE_URL ?>student/books">
              Browse Books
            </a>
            <a class="secStudentDashboard__btn secStudentDashboard__btn--ghost" href="<?= BASE_URL ?>student/borrowed">
              View Borrowed
            </a>
          </div>
        </div>
        <div class="secStudentDashboard__stats">
          <div class="secStudentDashboard__card">
            <p class="secStudentDashboard__cardLabel">Borrowed</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Currently borrowed books</p>
          </div>
          <div class="secStudentDashboard__card">
            <p class="secStudentDashboard__cardLabel">Reservations</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Pending reservations</p>
          </div>
          <div class="secStudentDashboard__card">
            <p class="secStudentDashboard__cardLabel">Overdue</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Return as soon as possible</p>
          </div>
        </div>
        <div class="secStudentDashboard__panels">
          <div class="secStudentDashboard__panel">
            <div class="secStudentDashboard__panelHead">
              <h2 class="secStudentDashboard__panelTitle">Recent Activity</h2>
              <a class="secStudentDashboard__panelLink" href="<?= BASE_URL ?>student/history">View All</a>
            </div>
            <div class="secStudentDashboard__panelBody">
              <div class="secStudentDashboard__row">
                <div>
                  <p class="secStudentDashboard__rowMain">No activity yet. Your borrow and reservation activity will
                    appear here.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="stFooter">
    <div class="stFooter__inner">
      <p class="stFooter__text">© <?= date("Y") ?> Phinma UCL Library. Student Portal.</p>
      <div class="stFooter__links">
        <a class="stFooter__link" href="<?= BASE_URL ?>student/books">Books</a>
        <a class="stFooter__link" href="<?= BASE_URL ?>student/profile">Profile</a>
      </div>
    </div>
  </footer>
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/student/dashboard.js"></script>
</body>

</html>