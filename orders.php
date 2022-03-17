<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/get_cookie_login_products.php'; 
  $orders = getOrders();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Список заказов</title>

  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

  <meta name="theme-color" content="#393939">

  <link rel="preload" href="fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="fonts/roboto-700-normal.woff2" as="font">

  <link rel="icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/style.min.css">
  <script src="js/scripts.js" defer=""></script>
</head>
<body>
<header class="page-header">
  <a class="page-header__logo" href="/">
    <img src="img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item" href="/">Главная</a>
      </li>
      <?php if (getLogin() == 'admin@mail.ru') :?>
        <li>
          <a class="main-menu__item" href="products.php">Товары</a>
        </li>
      <?php endif; ?>
      <li>
        <a class="main-menu__item active" href="orders.php">Заказы</a>
      </li>
      <li>
        <a class="main-menu__item" href="#">Выйти</a>
      </li>
    </ul>
  </nav>
</header>
<main class="page-order">
  <h1 class="h h--1">Список заказов</h1>
  <ul class="page-order__list">
    <?php for ($i = 0; $i < count($orders); $i++) : ?>
      <li class="order-item page-order__item">
        <div class="order-item__wrapper">
          <div class="order-item__group order-item__group--id">
            <span class="order-item__title">Номер заказа</span>
            <span class="order-item__info order-item__info--id"><?= $orders[$i]['id'] ?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Сумма заказа</span>
            <?= $orders[$i]['sum'] ?> руб.
          </div>
          <button class="order-item__toggle"></button>
        </div>
        <div class="order-item__wrapper">
          <div class="order-item__group order-item__group--margin">
            <span class="order-item__title">Заказчик</span>
            <span class="order-item__info"><?= $orders[$i]['customer'] ?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Номер телефона</span>
            <span class="order-item__info">+<?= $orders[$i]['phone'] ?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Способ доставки</span>
            <span class="order-item__info"><?= $orders[$i]['delivery_method'] ?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Способ оплаты</span>
            <span class="order-item__info"><?= $orders[$i]['pay_method'] ?></span>
          </div>
          <div class="order-item__group order-item__group--status">
            <span class="order-item__title">Статус заказа</span>
            <?php if ($orders[$i]['done']) { ?>
              <span class="order-item__info order-item__info--yes">Выполнено</span>
            <?php } else { ?>
              <span class="order-item__info order-item__info--no">Не выполнено</span>
            <?php } ?>
            
            <button class="order-item__btn">Изменить</button>
          </div>
        </div>
        <?php if ($orders[$i]['address'] != null) : ?>
          <div class="order-item__wrapper">
            <div class="order-item__group">
              <span class="order-item__title">Адрес доставки</span>
              <span class="order-item__info"><?= $orders[$i]['address'] ?></span>
            </div>
          </div>
        <?php endif; ?>
        <div class="order-item__wrapper">
        <div class="order-item__group">
          <span class="order-item__title">Комментарий к заказу</span>
          <span class="order-item__info"><?php if ($orders[$i]['comment'] == "") { echo "Нет комментария"; } else { echo $orders[$i]['comment']; } ?></span>
        </div>
      </div>
      </li>
    <?php endfor;?>
  </ul>
</main>
<footer class="page-footer">
  <div class="container">
    <a class="page-footer__logo" href="/">
      <img src="img/logo--footer.svg" alt="Fashion">
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
          <a class="main-menu__item" href="index.php">Sale</a>
        </li>
        <li>
          <a class="main-menu__item" href="delivery.php">Доставка</a>
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
