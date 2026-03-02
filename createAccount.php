<?php
session_start();

$role = $_GET["role"] ?? "student";
$role = ($role === "librarian") ? "librarian" : "student";

$pageTitle = ($role === "librarian") ? "Create Librarian Account" : "Create Student Account";
$extraLabel = ($role === "librarian") ? "PHINMA EMAIL" : "STUDENT ID";
$extraName = ($role === "librarian") ? "phinma_email" : "student_id";
$extraType = ($role === "librarian") ? "email" : "text";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?> - Phinma UCL Library</title>
  <?php include("components/head.php"); ?>
</head>

<body data-role="<?= $role ?>">
  <main>
    <section class="secCreate secCreate--<?= $role ?>">
      <div class="secCreate__overlay"></div>
      <div class="secCreate__inner">
        <div class="secCreate__card">
          <a class="secCreate__back" href="login?role=<?= $role ?>">← Go back</a>
          <h1 class="secCreate__title"><?= $pageTitle ?></h1>
          <form class="secCreate__form needs-validation" id="formCreateAccount" novalidate autocomplete="on">
            <div class="secCreate__field">
              <label class="secCreate__label" for="username">USERNAME</label>
              <input class="secCreate__input form-control" type="text" id="username" name="username"
                autocomplete="username" required>
              <div class="secCreate__invalid-feedback invalid-feedback">Username is required.</div>
            </div>
            <div class="secCreate__field">
              <label class="secCreate__label" for="password">PASSWORD</label>
              <input class="secCreate__input form-control" type="password" id="password" name="password"
                autocomplete="new-password" required minlength="4">
              <div class="secCreate__invalid-feedback invalid-feedback">Password is required (min 4 chars).</div>
            </div>
            <div class="secCreate__field">
              <label class="secCreate__label" for="extra"><?= $extraLabel ?></label>
              <input class="secCreate__input form-control" type="<?= $extraType ?>" id="extra" name="<?= $extraName ?>"
                required>
              <div class="secCreate__invalid-feedback invalid-feedback"><?= $extraLabel ?> is required.</div>
            </div>
            <button class="secCreate__btn" type="submit" id="btnCreateAccount">CREATE</button>
          </form>
        </div>
      </div>
    </section>
  </main>
  <?php include("components/scripts.php"); ?>
  <script src="assets/js/auth.js"></script>
</body>

</html>