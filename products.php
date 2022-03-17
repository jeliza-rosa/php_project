<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
  $products = getProducts('*');
  $chapters = getChapters();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Товары</title>

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
      <li>
        <a class="main-menu__item active" href="products.php">Товары</a>
      </li>
      <li>
        <a class="main-menu__item" href="orders.php">Заказы</a>
      </li>
      <li>
        <a class="main-menu__item" href="#">Выйти</a>
      </li>
    </ul>
  </nav>
</header>
<main class="page-products">
  <h1 class="h h--1">Товары</h1>
  <a class="page-products__button button btn_add_product" href="add.php">Добавить товар</a>
  <div class="page-products__header">
    <span class="page-products__header-field">Название товара</span>
    <span class="page-products__header-field">ID</span>
    <span class="page-products__header-field">Цена</span>
    <span class="page-products__header-field">Категория</span>
    <span class="page-products__header-field">Новинка</span>
  </div>
  <ul class="page-products__list">
 <?php 
      for ($i = 0; $i < count($products); $i++) : ?>
        <li class="product-item page-products__item">
          <b class="product-item__name"><?= $products[$i]['name'] ?></b>
          <span class="product-item__field"><?= $products[$i]['id'] ?></span>
          <span class="product-item__field"><?= $products[$i]['price'] ?> руб.</span>
          <span class="product-item__field">
            <?php for ($j=0; $j<count($chapters);$j++) {
              if ($products[$i]['id'] == $chapters[$j]['id']) : ?>
                <span><?= $chapters[$j]['chapter_name'] ?></span>
              <?php endif;
            }?>
          </span>
          <span class="product-item__field">

            <?php if ($products[$i]['novelty'] == 1) {
            echo "Да";
            } elseif ($products[$i]['novelty'] == 0) {
            echo "Нет";
            }; ?>

          </span>
          <a href="add.php" class="product-item__edit" aria-label="Редактировать"></a>
          <button class="product-item__delete"></button>
        </li>
      <?php endfor; ?>
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
