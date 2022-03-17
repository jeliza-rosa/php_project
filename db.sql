-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: course_project1
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapters`
--

LOCK TABLES `chapters` WRITE;
/*!40000 ALTER TABLE `chapters` DISABLE KEYS */;
INSERT INTO `chapters` VALUES (1,'Женщины'),(2,'Мужчины'),(3,'Дети'),(4,'Аксессуары');
/*!40000 ALTER TABLE `chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(255) NOT NULL,
  `sum` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `delivery_method` varchar(255) NOT NULL,
  `pay_method` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `comment` text,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Антонов Антон Антонович','3500.00','89994445566','Самовывоз','Наличные',NULL,'Заберу через час',1),(2,'Смирнов Павел Владимирович','5349.00','87775553366','Курьер','Безналичный расчет','г. Москва, ул. Монтажников, д.98, кв. 234','Как можно скорее',1),(3,'Максимов Максим','13592.00','82223335689','Курьер','Безналичный расчет','г. Тюмень, ул. Широтная, д.23, кв. 45','С примеркой',1),(4,'Аксентьева Ольга Николаевна','999.00','87779996655','Курьер','Наличные','г. Курган, ул. Чернореченская, д.119, кв. 10','',1),(5,'Киселев Дмитрий Анатольевич','1430.00','45556669887','Самовывоз','Безналичный расчет',NULL,'Упакуйте в подарочную упаковку',0),(6,'Кудряшова Анна Анатольевна','4499.00','29997778945','Курьер','Наличные','г. Челябинск, ул. Челюскинцев, д.23, кв. 45','',0),(7,'Шумкова Ирина','1781.00','89994445623','Самовывоз','Безналичный расчет',NULL,'',0),(8,'Якупова Мария','2500.00','79995558787','Самовывоз','Наличные',NULL,'',0),(9,'Хлебутина Алена Александровна','2599.00','87774445561','Самовывоз','Безналичный расчет',NULL,'',1),(10,'Васильева Анна Игоревна','4000.00','75486589632','Самовывоз','Безналичный расчет',NULL,'',0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_chapter`
--

DROP TABLE IF EXISTS `product_chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_chapter` (
  `products_id` int(11) NOT NULL,
  `chapters_id` int(11) NOT NULL,
  KEY `fk_product_chapter_products_idx` (`products_id`),
  KEY `fk_product_chapter_chapters1_idx` (`chapters_id`),
  CONSTRAINT `fk_product_chapter_chapters1` FOREIGN KEY (`chapters_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_chapter_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_chapter`
--

LOCK TABLES `product_chapter` WRITE;
/*!40000 ALTER TABLE `product_chapter` DISABLE KEYS */;
INSERT INTO `product_chapter` VALUES (235454349,1),(235454353,1),(235454354,1),(235454355,1),(235454355,4),(235454356,1),(235454356,4),(235454357,2),(235454358,2),(235454359,2),(235454360,2),(235454361,2),(235454362,2),(235454361,4),(235454362,4),(235454363,3),(235454364,3),(235454365,3),(235454366,3),(235454367,3),(235454368,3),(235454369,3),(235454370,3),(235454367,4),(235454368,4),(235454369,4),(235454370,4),(235454371,4),(235454372,4),(235454373,4),(235454373,1),(235454374,1),(235454374,4),(235454375,4),(235454375,1),(235454376,1),(235454377,1),(235454378,1),(235454379,1),(235454380,1),(235454381,1),(367549412,3),(367549412,4),(280428596,1),(874903884,1),(807595430,2),(517311573,2),(826703550,2),(438916129,2),(438916129,4),(429699823,2),(429699823,4),(512116144,3),(512116144,4),(235454347,1),(235454348,1),(235454348,4),(235454350,1),(235454350,4),(235454351,1),(235454352,1),(588196849,1),(565033713,1);
/*!40000 ALTER TABLE `product_chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `novelty` tinyint(1) DEFAULT '0',
  `sale` tinyint(1) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=874903885 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (235454347,'Рубашка в клетку',2229.00,1,1,'product-3.jpg'),(235454348,'Часы женские',4000.00,1,0,'product-4.jpg'),(235454349,'Брюки пляжные',1700.00,0,1,'product-5.jpg'),(235454350,'Сумка кожаная',6800.00,1,0,'product-6.jpg'),(235454351,'Платье красное коктейльное',5490.00,0,1,'product-7.jpg'),(235454352,'Пальто с коротким рукавом',4500.00,1,1,'product-8.jpg'),(235454353,'Джинсы с высокой посадкой',2800.00,1,0,'product-9.jpg'),(235454354,'Ботильоны на каблуке',5349.00,0,1,'product-10.jpg'),(235454355,'Шапка женская',899.00,0,1,'product-11.jpg'),(235454356,'Очки женские',1300.00,1,0,'product-12.jpg'),(235454357,'Пуховик мужской',13592.00,1,1,'product-13.jpg'),(235454358,'Костюм спортивный',7999.00,1,0,'product-14.jpg'),(235454359,'Свитшот',1200.00,0,0,'product-15.jpg'),(235454360,'Джинсы мужские',1199.00,0,1,'product-16.jpg'),(235454361,'Ремень мужской',2358.00,1,1,'product-17.jpg'),(235454362,'Очки мужские',1500.00,0,1,'product-18.jpg'),(235454363,'Комбинезон',4190.00,1,0,'product-19.jpg'),(235454364,'Пижама',1199.00,0,0,'product-20.jpg'),(235454365,'Куртка утепленная',12990.00,0,1,'product-21.jpg'),(235454366,'Платье',549.00,1,0,'product-22.jpg'),(235454367,'Сумка',699.00,0,1,'product-23.jpg'),(235454368,'Рюкзак',999.00,1,1,'product-24.jpg'),(235454369,'Панама',1430.00,0,1,'product-25.jpg'),(235454370,'Ободок',1190.00,1,1,'product-26.jpg'),(235454371,'Зонт складной',3900.00,1,1,'product-27.jpg'),(235454372,'Чехол для iPhone13',2690.00,0,0,'product-28.jpg'),(235454373,'Подвеска',3920.00,1,0,'product-29.jpg'),(235454374,'Повязка',1799.00,0,1,'product-30.jpg'),(235454375,'Серьги',359.00,0,1,'product-31.jpg'),(235454376,'Дубленка',7999.00,1,0,'product-32.jpg'),(235454377,'Водолазка',3990.00,0,1,'product-33.jpg'),(235454378,'Комплект термобелья',2160.00,1,0,'product-34.jpg'),(235454379,'Брюки',1199.00,0,0,'product-35.jpg'),(235454380,'Блуза',1781.00,1,1,'product-36.jpg'),(235454381,'Жакет',1399.00,1,1,'product-37.jpg'),(280428596,'Платье',5499.00,1,0,'new-product-39.jpg'),(367549412,'Браслеты',459.00,1,1,'new-product-46.jpg'),(429699823,'Шарф мужской',1200.00,1,0,'new-product-44.jpg'),(438916129,'Галстук',1800.00,1,0,'new-product-43.jpg'),(512116144,'Кепка для девочки',890.00,0,1,'new-product-45.jpg'),(517311573,'Джогеры мужские',3900.00,0,1,'new-product-41.jpg'),(565033713,'Платье Нежная роза',4870.00,0,1,'new-product-2.jpg'),(588196849,'Туфли черные',3580.00,1,0,'new-product-1.jpg'),(807595430,'Пуховик',10500.00,1,0,'new-product-40.jpg'),(826703550,'Рубашка клетчатая',2500.00,1,1,'new-product-42.jpg'),(874903884,'Рубашка зеленая',3450.00,0,1,'new-product-38.jpg');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@mail.ru','$2y$10$BWegPPdlx4y5QZ2veQgZeO61sjtQFHDQ3nIK86d0.Lr20CLeYGljW'),(2,'operator@mail.ru','$2y$10$EaHas1Wsjbx4aQbVeI3auOdBgpXl71zplxZJgRY1UBF8YVVptv1T.');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-20 22:43:34
