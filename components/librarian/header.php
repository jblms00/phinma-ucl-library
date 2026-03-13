<header class="stHeader navbar navbar-expand-lg">
  <div class="container-fluid stHeader__container">
    <a class="navbar-brand stHeader__brand d-flex align-items-center animation-left"
      href="<?= BASE_URL ?>librarian/dashboard">
      <span class="stHeader__logo me-2">UCL</span>
      <span class="stHeader__brandText">Phinma UCL Library</span>
    </a>
    <button class="navbar-toggler stHeader__toggle" type="button" data-bs-toggle="collapse"
      data-bs-target="#librarianNavbar" aria-controls="librarianNavbar" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="librarianNavbar">
      <nav class="navbar-nav stNav">
        <a class="nav-link stNav__link animation-pulse" href="<?= BASE_URL ?>librarian/dashboard">Dashboard</a>
        <a class="nav-link stNav__link animation-pulse" href="<?= BASE_URL ?>librarian/books">Books</a>
        <a class="nav-link stNav__link animation-pulse" href="<?= BASE_URL ?>librarian/borrowings">Borrowings</a>
        <a class="nav-link stNav__link animation-pulse" href="<?= BASE_URL ?>librarian/reservations">Reservations</a>
        <a class="nav-link stNav__link animation-pulse" href="<?= BASE_URL ?>librarian/profile">Profile</a>
        <a class="nav-link stNav__link stNav__link--logout animation-pulse" href="<?= BASE_URL ?>phpscripts/logout.php">
          Logout
        </a>
      </nav>
    </div>
  </div>
</header>