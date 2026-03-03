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