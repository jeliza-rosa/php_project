<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Авторизация</title>

  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

  <meta name="theme-color" content="#393939">

  <link rel="preload" href="/fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="/fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="/fonts/roboto-700-normal.woff2" as="font">

  <link rel="icon" href="../img/favicon.png">
  <link rel="stylesheet" href="../css/style.min.css">

  <script src="../js/scripts.js" defer=""></script>
</head>
<body>
<header class="page-header">
  <a class="page-header__logo" href="#">
    <img src="../img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item" href="/">Главная</a>
      </li>
      <li>
        <a class="main-menu__item main-menu__item-new" href="#">Новинки</a>
      </li>
      <li>
        <a class="main-menu__item main-menu__item-sale" href="/index.php">Sale</a>
      </li>
      <li>
        <a class="main-menu__item" href="/delivery.php">Доставка</a>
      </li>
    </ul>
  </nav>
</header>
<main class="page-authorization">
  <h1 class="h h--1">Авторизация</h1>
  <form class="custom-form custom-form-authorization" action="/src/check_enter.php" method="post" name="authorization">
    <input type="email" class="custom-form__input" name="login" required="">
    <input type="password" class="custom-form__input" name="password" required="">
    <button class="button btn-authorization" type="submit">Войти в личный кабинет</button>
  </form>
</main>
<footer class="page-footer">
  <div class="container">
    <a class="page-footer__logo" href="#">
      <img src="../img/logo--footer.svg" alt="Fashion">
    </a>
    <nav class="page-footer__menu">
      <ul class="main-menu main-menu--footer">
        <li>
          <a class="main-menu__item" href="/">Главная</a>
        </li>
        <li>
          <a class="main-menu__item" href="#">Новинки</a>
        </li>
        <li>
          <a class="main-menu__item" href="/index.php">Sale</a>
        </li>
        <li>
          <a class="main-menu__item" href="/delivery.php">Доставка</a>
        </li>
      </ul>
    </nav>
    <address class="page-footer__copyright">
      © Все права защищены
    </address>
  </div>
</footer>
</body>
</html>
