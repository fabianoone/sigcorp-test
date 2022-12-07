CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `sigcorp_test`.`categories` (
	`id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL,
	`description` TEXT NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE=InnoDB;

CREATE TABLE `sigcorp_test`.`products` (
	`id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(45) NOT NULL,
	`title`	VARCHAR(255) NOT NULL,
	`description` TEXT NOT NULL,
	`price` DECIMAL(10,2) NOT NULL,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`active` TINYINT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	UNIQUE KEY `unique_code` (`code`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sigcorp_test`.`products_categories` (
	`product` int(10) UNSIGNED NOT NULL,
	`category` int(10) UNSIGNED NOT NULL,
	UNIQUE KEY `unique_product_category` (`product`, `category`),
	KEY `FK_products_categories_category` (`category`),
	CONSTRAINT `FK_products_categories_product` FOREIGN KEY (`product`)
		REFERENCES `products` (`id`) ON UPDATE CASCADE,
	CONSTRAINT `FK_products_categories_category` FOREIGN KEY (`category`)
		REFERENCES `categories` (`id`) ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sigcorp_test`.`clients` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(245) NOT NULL,
	`last_name` VARCHAR(145) NOT NULL,
	`email` VARCHAR(145) NOT NULL,
	`phone` VARCHAR(15) NOT NULL,
	`status` TINYINT(1) NOT NULL DEFAULT '1',
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	UNIQUE KEY `unique_email` (`email`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;