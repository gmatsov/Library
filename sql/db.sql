CREATE DATABASE IF NOT EXISTS `library`;
USE `library`;

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `description` longtext NOT NULL DEFAULT '',
  `image` longtext NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `is_active`, `is_admin`) VALUES
	(1, 'Ivan', 'Ivanov', 'admin@library.com', '$2y$10$af3a6WvnnxQFfQ0xaBG/SuW8cG9bLtXLLES4bmTqTj8iKdcynDW3O', 1, 1);

CREATE TABLE IF NOT EXISTS `users_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT 0,
  `book_id` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__books` (`book_id`),
  KEY `FK__users` (`user_id`),
  CONSTRAINT `FK__books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;