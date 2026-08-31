

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `user_dsa_progress` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `register_number` VARCHAR(100) NOT NULL,
  `topic_slug` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_dsa_topic` (`register_number`, `topic_slug`),
  KEY `idx_user_dsa_register` (`register_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `user_python_progress` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `register_number` VARCHAR(100) NOT NULL,
  `topic_slug` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_python_topic` (`register_number`, `topic_slug`),
  KEY `idx_user_python_register` (`register_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `user_dbms_progress` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `register_number` VARCHAR(100) NOT NULL,
  `topic_slug` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_dbms_topic` (`register_number`, `topic_slug`),
  KEY `idx_user_dbms_register` (`register_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `user_cpp_progress` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `register_number` VARCHAR(100) NOT NULL,
  `topic_slug` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_cpp_topic` (`register_number`, `topic_slug`),
  KEY `idx_user_cpp_register` (`register_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
