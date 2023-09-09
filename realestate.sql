-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: realestate
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'pokhrelgopal27@gmail.com','123456'),(2,'ashis@gmail.com','123456');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `receiver_id` int NOT NULL,
  `sender_id` int DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `sender_email` varchar(200) DEFAULT NULL,
  `sender_phone` varchar(100) DEFAULT NULL,
  `message` text,
  `property_id` int DEFAULT NULL,
  `date_posted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `sender_id` (`sender_id`),
  KEY `property_id` (`property_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (13,70,69,'Gopal Pokhrel','pokhrelgopal27@gmail.com','','Hello Brother',79,'2023-07-13 15:53:40'),(19,69,72,'Niraj Basnet','nirajbasnet@gmail.com','9876754233','I am interested in this property.',81,'2023-08-24 12:15:24');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `property_id` int NOT NULL AUTO_INCREMENT,
  `property_type` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `province` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `listing_type` varchar(50) NOT NULL,
  `about` varchar(1500) DEFAULT NULL,
  `price` bigint NOT NULL,
  `contact_person` int DEFAULT NULL,
  `img_url` varchar(300) DEFAULT NULL,
  `iframe_src` varchar(700) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`property_id`),
  KEY `fk_contact_person` (`contact_person`),
  CONSTRAINT `fk_contact_person` FOREIGN KEY (`contact_person`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`contact_person`) REFERENCES `users` (`id`),
  CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`contact_person`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (75,'apartment','Modern 2-Bedroom Apartment near Lakeside','gandaki','Pokhara','sale','Newly constructed apartment with contemporary design and amenities. Located in a peaceful neighborhood ok.',30000,72,'images/room-2.jpeg','<iframe src=\"https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3532.3947836102575!2d85.32155546206324!3d27.705094648131624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjfCsDQyJzE4LjMiTiA4NcKwMTknMjQuOCJF!5e0!3m2!1sen!2snp!4v1691342905812!5m2!1sen!2snp\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','on'),(77,'room','Furnished Room for Rent in the City Center','sudurpaschim','Dhangadhi','rent','Comfortable room with essential furniture and utilities. Conveniently located near major transportation hubs.',10000,71,'images/room.jpeg','','on'),(78,'apartment',' Luxury 3-Bedroom Apartment with Modern Amenities','bagmati','Lalitpur','sale','Upscale apartment with a swimming pool, gym, and 24/7 security. Located in a prestigious residential area.',25000000,70,'images/apartments2.jpeg','','on'),(79,'house','Spacious 4-Bedroom House with Garden and Parking','karnali','Surkhet','rent','Large house with ample living space, a beautiful garden, and parking facilities. Ideal for a big family.',40000,70,'images/3.jpeg','','on'),(80,'room','Affordable Room for Rent near Temple','koshi','Biratnagar','sale','Well-maintained room in a quiet residential area. Close to markets, restaurants, and public transportation facilities also...',6000,69,'images/room-3.jpeg','<iframe src=\"https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3532.5908272435186!2d85.32514907529983!3d27.6990386321103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjfCsDQxJzU2LjUiTiA4NcKwMTknMzUuNyJF!5e0!3m2!1sen!2snp!4v1689481384388!5m2!1sen!2snp\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','reject'),(81,'apartment','Brand New 1-Bedroom Apartment with Scenic Views','gandaki','Tansen','sale','Newly constructed apartment with a balcony offering breathtaking views of the surrounding hills.',8500000,69,'images/apartments.jpeg','<iframe src=\"https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3532.5908272435186!2d85.32514907529983!3d27.6990386321103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjfCsDQxJzU2LjUiTiA4NcKwMTknMzUuNyJF!5e0!3m2!1sen!2snp!4v1689481384388!5m2!1sen!2snp\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','reject'),(101,'house','Amazing house(updated)','koshi','Lalitpur','sale','This house is amazing',5000000,83,'images/pexels-photo-1029599.jpeg','','on'),(102,'house','Amazing house for sale in pokhara','gandaki','Pokhara','sale','This is a good house to get updated.',50000000,69,'images/bunglow.jpg','<iframe src=\"https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1765.9158793724478!2d85.32462485650908!3d27.722480368341863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjfCsDQzJzIwLjkiTiA4NcKwMTknMzMuMyJF!5e0!3m2!1sen!2snp!4v1692887699015!5m2!1sen!2snp\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','on'),(103,'house','Newly constructed house','koshi','Lalitpur','sale','This is new house listed for sale.',50000000,69,'images/2023-08-22 21_20_19-Modern Building Against Sky · Free Stock Photo.png','','on');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (69,'Gopal Pokhrel','pokhrelgopal27@gmail.com','$2y$10$yRMEvzdfcK3XrJB.nLPMoe0fO.Wk5CrO1rlPaRvJT68YAZoHjEThO','9808592121'),(70,'Suraj Katwal','surajkatwal@gmail.com','$2y$10$m7F9NnZLOI/6/.pz9VsxFuB7BOTUOZ0SQJ2jT1G2WHDdDdx46zgh2','9849899353'),(71,'Ravin Dahal','ravindahal@gmail.com','$2y$10$mERR8o5bi8RJZDjXUU7WYOfXPCRQVTLG56IHmnkpLYWfKBJ0HuL3y','9808619221'),(72,'Niraj Basnet','nirajbasnet@gmail.com','$2y$10$PRRHhVgl7YpnkV9Xa.EQ3upmR6tecAXMCglGwUEUzAfhnOeX90upO','9876754233'),(83,'Ram Shah','ram@gmail.com','$2y$10$ikbXtqAqeaRNn6qg6uiRKeu68jq51..emuhkTWeoj9NQvO1eGCBmG','9874563210');
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

-- Dump completed on 2023-09-09 11:01:43
