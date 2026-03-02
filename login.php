<?php
session_start();

$role = $_GET["role"] ?? "student";
$role = ($role === "librarian") ? "librarian" : "student";

$pageTitle = ($role === "librarian") ? "LIBRARIAN LOGIN" : "STUDENT LOGIN";
$ctaText = "Create Account";
$ctaHref = "createAccount?role=" . $role;
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
    <section class="secLogin secLogin--<?= $role ?>">
      <div class="secLogin__overlay"></div>
      <div class="secLogin__inner">
        <div class="secLogin__card">
          <a class="secLogin__back" href="index">← Go back</a>
          <h1 class="secLogin__title"><?= $pageTitle ?></h1>
          <form class="secLogin__form needs-validation" id="formLogin" novalidate autocomplete="on">
            <div class="secLogin__field">
              <label class="secLogin__label" for="username">USERNAME</label>
              <input class="secLogin__input form-control" type="text" id="username" name="username"
                autocomplete="username" required>
              <div class="secLogin__invalid-feedback invalid-feedback">Username is required.</div>
            </div>
            <div class="secLogin__field">
              <label class="secLogin__label" for="password">PASSWORD</label>
              <input class="secLogin__input form-control" type="password" id="password" name="password"
                autocomplete="current-password" required minlength="4">
              <div class="secLogin__invalid-feedback invalid-feedback">Password is required.</div>
            </div>
            <button class="secLogin__btn" type="submit" id="btnLogin">LOGIN</button>
          </form>
        </div>
        <a class="secLogin__cta" href="<?= $ctaHref ?>"><?= $ctaText ?></a>
      </div>
    </section>
  </main>
  <?php include("components/scripts.php"); ?>
  <script src="assets/js/auth.js"></script>
</body>

</html>