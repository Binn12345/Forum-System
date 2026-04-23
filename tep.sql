/*
SQLyog Trial v13.1.9 (64 bit)
MySQL - 8.4.3 : Database - forum_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`forum_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `forum_system`;

/*Table structure for table `activity_logs` */

DROP TABLE IF EXISTS `activity_logs`;

CREATE TABLE `activity_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `target_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `activity_logs` */

/*Table structure for table `admin_logs` */

DROP TABLE IF EXISTS `admin_logs`;

CREATE TABLE `admin_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `target_type` varchar(50) DEFAULT NULL,
  `target_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `admin_logs` */

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `status` enum('visible','deleted') DEFAULT 'visible',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_comments_post` (`post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `comments` */

/*Table structure for table `likes` */

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_like` (`post_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_likes_post` (`post_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `likes` */

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `from_user_id` int DEFAULT NULL,
  `type` enum('like','comment','reply','follow','post') DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `notifications` */

insert  into `notifications`(`id`,`user_id`,`from_user_id`,`type`,`post_id`,`message`,`is_read`,`created_at`) values 
(31,1,2,'like',5,'User2 liked your post',0,'2026-04-23 15:50:39');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('visible','hidden','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'visible',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_pinned` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_posts_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`user_id`,`title`,`content`,`image`,`status`,`created_at`,`is_admin`,`is_pinned`) values 
(2,'1',NULL,'Welcome to the forum system!',NULL,'visible','2026-04-23 16:08:12',1,0),
(43,'1',NULL,'Welcome to the forum system!',NULL,'visible','2026-04-23 16:10:00',1,0),
(44,'2',NULL,'Hello everyone! Excited to join this community.',NULL,'visible','2026-04-23 16:10:00',0,0),
(45,'3',NULL,'Good morning guys',NULL,'visible','2026-04-23 16:10:00',0,0),
(46,'4',NULL,'Anyone here working on PHP projects?',NULL,'visible','2026-04-23 16:10:00',0,0),
(47,'5',NULL,'Study grind never stops',NULL,'visible','2026-04-23 16:10:00',0,0),
(48,'1',NULL,'System Update: New features coming soon!',NULL,'visible','2026-04-23 16:10:00',1,0),
(49,'2',NULL,'Just finished my project, feeling great!',NULL,'visible','2026-04-23 16:10:00',0,0),
(50,'3',NULL,'Coffee + coding = life',NULL,'visible','2026-04-23 16:10:00',0,0),
(51,'4',NULL,'Need help with MySQL joins',NULL,'visible','2026-04-23 16:10:00',0,0),
(52,'5',NULL,'Weekend vibes are here',NULL,'visible','2026-04-23 16:10:00',0,0),
(53,'2',NULL,'This forum is actually cool',NULL,'visible','2026-04-23 16:10:00',0,0),
(54,'3',NULL,'Trying out real-time notifications',NULL,'visible','2026-04-23 16:10:00',0,0),
(55,'4',NULL,'Database errors are my worst enemy',NULL,'visible','2026-04-23 16:10:00',0,0),
(56,'5',NULL,'Who else codes at night?',NULL,'visible','2026-04-23 16:10:00',0,0),
(57,'1',NULL,'Reminder: Keep posts clean and respectful.',NULL,'visible','2026-04-23 16:10:00',1,0),
(58,'2',NULL,'Learning PHP step by step',NULL,'visible','2026-04-23 16:10:00',0,0),
(59,'3',NULL,'Frontend or backend? I choose both',NULL,'visible','2026-04-23 16:10:00',0,0),
(60,'4',NULL,'This feed layout looks nice!',NULL,'visible','2026-04-23 16:10:00',0,0),
(61,'5',NULL,'Building my own social media system',NULL,'visible','2026-04-23 16:10:00',0,0),
(62,'1',NULL,'Maintenance scheduled tonight 10PM',NULL,'visible','2026-04-23 16:10:00',1,0),
(63,'user',NULL,'dsadsa',NULL,'visible','2026-04-23 17:00:12',NULL,0),
(64,'user',NULL,'dsds',NULL,'visible','2026-04-23 17:00:18',NULL,0),
(65,'user',NULL,'dsadsadsa',NULL,'visible','2026-04-23 17:00:26',NULL,0),
(66,'user',NULL,'dsdsd',NULL,'visible','2026-04-23 17:07:49',NULL,0),
(67,'user',NULL,'dsadsadsa',NULL,'visible','2026-04-23 17:14:19',NULL,0),
(68,'user',NULL,'sss',NULL,'visible','2026-04-23 17:17:53',NULL,0),
(69,'user2',NULL,'hehehe',NULL,'visible','2026-04-23 17:19:40',NULL,0),
(70,'user',NULL,'',NULL,'visible','2026-04-23 17:37:18',NULL,0),
(71,'user',NULL,'',NULL,'visible','2026-04-23 17:37:19',NULL,0),
(72,'user',NULL,'',NULL,'visible','2026-04-23 17:37:19',NULL,0),
(73,'user',NULL,'',NULL,'visible','2026-04-23 17:37:19',NULL,0),
(74,'user',NULL,'dsds',NULL,'visible','2026-04-23 17:40:32',NULL,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` enum('active','banned') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`role`,`status`,`created_at`) values 
(1,'Admin','admin@forum.com','$2y$10$W8qo5UwcmHktKtj4nRivGuNsh/Fc1aPUiVba6.cna0GwTafzUuHu6','admin','active','2026-04-23 14:58:13'),
(2,'user','user1@gmail.com','$2y$10$omS..VirysYgWb6HgYvcIOhGfDAnNL74bE5XT6HA5sw3XbsG8JX2y','user','active','2026-04-23 14:58:47'),
(9,'Admin1',NULL,'admin123','user','banned','2026-04-23 15:52:29'),
(10,'user2',NULL,'$2y$10$omS..VirysYgWb6HgYvcIOhGfDAnNL74bE5XT6HA5sw3XbsG8JX2y','user','active','2026-04-23 15:52:29'),
(11,'User3',NULL,'user123','user','active','2026-04-23 15:52:29'),
(12,'User4',NULL,'user123','user','banned','2026-04-23 15:52:29'),
(13,'User5',NULL,'user123','user','active','2026-04-23 15:52:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
