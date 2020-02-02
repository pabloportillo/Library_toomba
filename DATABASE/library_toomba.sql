
-- Volcando estructura de base de datos para library_toomba
CREATE DATABASE IF NOT EXISTS `library_toomba` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `library_toomba`;

-- Volcando estructura para tabla library_toomba.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) DEFAULT NULL,
  `book_id` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_books_categories` (`category_id`),
  CONSTRAINT `FK_books_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla library_toomba.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL DEFAULT '0',
  UNIQUE KEY `Índice 2` (`category_id`),
  KEY `Índice 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla library_toomba.token
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(250) DEFAULT NULL,
  `fecha_creacion_token` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

