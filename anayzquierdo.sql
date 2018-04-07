-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para anayzquierdo
CREATE DATABASE IF NOT EXISTS `anayzquierdo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `anayzquierdo`;

-- Volcando estructura para tabla anayzquierdo.clas_obras
DROP TABLE IF EXISTS `clas_obras`;
CREATE TABLE IF NOT EXISTS `clas_obras` (
  `id_clas_obra` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_obra` int(10) unsigned NOT NULL,
  `id_etiqueta` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_clas_obra`),
  KEY `clas_obras_id_obra_foreign` (`id_obra`),
  KEY `clas_obras_id_etiqueta_foreign` (`id_etiqueta`),
  CONSTRAINT `clas_obras_id_etiqueta_foreign` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiquetas` (`id_etiqueta`) ON DELETE CASCADE,
  CONSTRAINT `clas_obras_id_obra_foreign` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id_obra`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.clas_obras: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `clas_obras` DISABLE KEYS */;
INSERT INTO `clas_obras` (`id_clas_obra`, `id_obra`, `id_etiqueta`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, '2017-06-16 10:18:39', '2017-06-16 10:18:39'),
	(2, 1, 3, '2017-06-16 10:18:47', '2017-06-16 10:18:47'),
	(3, 1, 21, '2017-06-16 10:19:21', '2017-06-16 10:19:21');
/*!40000 ALTER TABLE `clas_obras` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.comentarios
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_comentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_obra` int(10) unsigned NOT NULL,
  `comentario` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `comentarios_id_usuario_foreign` (`id_usuario`),
  KEY `comentarios_id_obra_foreign` (`id_obra`),
  CONSTRAINT `comentarios_id_obra_foreign` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id_obra`) ON DELETE CASCADE,
  CONSTRAINT `comentarios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.comentarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.det_pedidos
DROP TABLE IF EXISTS `det_pedidos`;
CREATE TABLE IF NOT EXISTS `det_pedidos` (
  `id_det_pedido` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pedido` int(10) unsigned NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_obra` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_det_pedido`),
  KEY `det_pedidos_id_pedido_foreign` (`id_pedido`),
  KEY `det_pedidos_id_obra_foreign` (`id_obra`),
  CONSTRAINT `det_pedidos_id_obra_foreign` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id_obra`) ON DELETE CASCADE,
  CONSTRAINT `det_pedidos_id_pedido_foreign` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.det_pedidos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `det_pedidos` DISABLE KEYS */;
INSERT INTO `det_pedidos` (`id_det_pedido`, `id_pedido`, `precio`, `cantidad`, `id_obra`, `created_at`, `updated_at`) VALUES
	(1, 1, 405.42, 1, 1, '2017-06-16 10:09:12', '2017-06-16 10:09:12'),
	(2, 1, 359.47, 1, 2, '2017-06-16 10:09:12', '2017-06-16 10:09:12');
/*!40000 ALTER TABLE `det_pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.etiquetas
DROP TABLE IF EXISTS `etiquetas`;
CREATE TABLE IF NOT EXISTS `etiquetas` (
  `id_etiqueta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_etiqueta` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_etiqueta`),
  UNIQUE KEY `etiquetas_nombre_etiqueta_unique` (`nombre_etiqueta`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.etiquetas: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` (`id_etiqueta`, `nombre_etiqueta`, `created_at`, `updated_at`) VALUES
	(1, 'Polo', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(2, 'Colón', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(3, 'Pulido', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(4, 'Sedillo', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(5, 'Figueroa', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(6, 'Muro', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(7, 'Madrigal', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(8, 'Calvillo', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(9, 'Reynoso', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(10, 'Caraballo', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(11, 'Viera', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(12, 'Cruz', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(13, 'Madrid', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(14, 'Naranjo', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(15, 'Tejeda', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(16, 'Espinosa', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(17, 'Zapata', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(18, 'Urías', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(19, 'Arribas', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(20, 'Requena', '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(21, 'Ocre', '2017-06-16 10:19:20', '2017-06-16 10:19:20');
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.favoritos
DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_favorito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_obra` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_favorito`),
  KEY `favoritos_id_usuario_foreign` (`id_usuario`),
  KEY `favoritos_id_obra_foreign` (`id_obra`),
  CONSTRAINT `favoritos_id_obra_foreign` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id_obra`) ON DELETE CASCADE,
  CONSTRAINT `favoritos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.favoritos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
INSERT INTO `favoritos` (`id_favorito`, `id_usuario`, `id_obra`, `created_at`, `updated_at`) VALUES
	(1, 12, 1, '2017-06-16 10:02:58', '2017-06-16 10:02:58');
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=532 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.migrations: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(523, '2014_10_12_000000_create_usuarios_table', 1),
	(524, '2014_10_12_100000_create_password_resets_table', 1),
	(525, '2017_04_11_184901_create_obras_table', 1),
	(526, '2017_04_12_130123_create_etiquetas_table', 1),
	(527, '2017_04_12_131952_create_favoritos_table', 1),
	(528, '2017_04_12_140424_create_pedidos_table', 1),
	(529, '2017_04_12_140859_create_det_pedidos_table', 1),
	(530, '2017_04_12_141438_create_clas_obras_table', 1),
	(531, '2017_04_12_142224_create_comentarios_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.obras
DROP TABLE IF EXISTS `obras`;
CREATE TABLE IF NOT EXISTS `obras` (
  `id_obra` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo_obra` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tecnica` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soporte` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `largo` int(11) DEFAULT NULL,
  `alto` int(11) DEFAULT NULL,
  `precio` decimal(6,2) NOT NULL,
  `vendida` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_obra`),
  UNIQUE KEY `obras_titulo_obra_unique` (`titulo_obra`),
  UNIQUE KEY `obras_imagen_unique` (`imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.obras: ~50 rows (aproximadamente)
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` (`id_obra`, `titulo_obra`, `imagen`, `tecnica`, `soporte`, `largo`, `alto`, `precio`, `vendida`, `created_at`, `updated_at`) VALUES
	(1, 'Ariadna_1', 'images/obras/1.jpg', 'Julia', 'Cesar', 500, 326, 405.42, 0, '2017-06-12 08:43:36', '2017-06-16 10:19:48'),
	(2, 'Emma_2', 'images/obras/2.jpg', 'Rocio', 'Aleix', 531, 688, 359.47, 1, '2017-06-12 08:43:36', '2017-06-16 10:09:12'),
	(3, 'Lola_3', 'images/obras/3.jpg', 'Paula', 'Aleix', 506, 123, 207.27, 0, '2017-06-12 08:43:36', '2017-06-14 19:40:57'),
	(4, 'Marti_4', 'images/obras/4.jpg', 'Martina', 'Mateo', 679, 817, 886.91, 0, '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(5, 'Diana_5', 'images/obras/5.jpg', 'Berta', 'Ivan', 187, 810, 398.65, 0, '2017-06-12 08:43:36', '2017-06-14 19:40:57'),
	(6, 'Aya_6', 'images/obras/6.jpg', 'Luna', 'Jaime', 982, 428, 834.52, 1, '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(7, 'Pau_7', 'images/obras/7.jpg', 'Carlota', 'Victor', 917, 509, 718.28, 0, '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(8, 'Adriana_8', 'images/obras/8.jpg', 'Mireia', 'Ignacio', 231, 382, 155.29, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(9, 'Mara_9', 'images/obras/9.jpg', 'Beatriz', 'Alejandro', 528, 883, 759.15, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(10, 'Sofia_10', 'images/obras/10.jpg', 'Ines', 'Aitor', 454, 786, 795.50, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(11, 'Cristina_11', 'images/obras/11.jpg', 'Lola', 'Jesus', 994, 163, 756.32, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(12, 'Julia_12', 'images/obras/12.jpg', 'Alejandra', 'Manuel', 574, 713, 601.82, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(13, 'Africa_13', 'images/obras/13.jpg', 'Jana', 'Jordi', 240, 745, 437.43, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(14, 'Gabriela_14', 'images/obras/14.jpg', 'Sandra', 'Pedro', 349, 929, 732.54, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(15, 'Lara_15', 'images/obras/15.jpg', 'Lidia', 'Jose Manuel', 403, 462, 678.81, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(16, 'Vega_16', 'images/obras/16.jpg', 'Noa', 'Andres', 799, 434, 465.77, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(17, 'Ariadna_17', 'images/obras/17.jpg', 'Alma', 'Alonso', 263, 125, 145.81, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(18, 'Berta_18', 'images/obras/18.jpg', 'Andrea', 'Martin', 590, 543, 317.36, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(19, 'Luna_19', 'images/obras/19.jpg', 'Ariadna', 'Andres', 376, 160, 865.84, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(20, 'Fatima_20', 'images/obras/20.jpg', 'Patricia', 'Ander', 779, 818, 287.48, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(21, 'Adriana_21', 'images/obras/21.jpg', 'Ainhoa', 'Marc', 397, 878, 756.64, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(22, 'Nahia_22', 'images/obras/22.jpg', 'Luna', 'Roberto', 107, 992, 471.03, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(23, 'Nil_23', 'images/obras/23.jpg', 'Clara', 'Alberto', 113, 981, 503.49, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(24, 'Ines_24', 'images/obras/24.jpg', 'Sofia', 'Angel', 650, 854, 597.87, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(25, 'Daniela_25', 'images/obras/25.jpg', 'Candela', 'Carlos', 887, 829, 886.11, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(26, 'Candela_26', 'images/obras/26.jpg', 'Olivia', 'Jordi', 357, 263, 923.06, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(27, 'Iria_27', 'images/obras/27.jpg', 'Miriam', 'Manuel', 635, 801, 781.97, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(28, 'Miriam_28', 'images/obras/28.jpg', 'Abril', 'Ignacio', 825, 714, 931.73, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(29, 'Pau_29', 'images/obras/29.jpg', 'Isabel', 'Pablo', 300, 268, 178.67, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(30, 'Andrea_30', 'images/obras/30.jpg', 'Sara', 'Mohamed', 915, 791, 828.98, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(31, 'Natalia_31', 'images/obras/31.jpg', 'Lucia', 'Enrique', 627, 977, 322.27, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(32, 'Teresa_32', 'images/obras/32.jpg', 'Nora', 'Santiago', 190, 841, 676.70, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(33, 'Carolina_33', 'images/obras/33.jpg', 'Carolina', 'Enrique', 677, 249, 799.60, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(34, 'Marti_34', 'images/obras/34.jpg', 'Leyre', 'Asier', 409, 687, 765.48, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(35, 'Eva_35', 'images/obras/35.jpg', 'Carlota', 'Francisco', 605, 521, 554.28, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(36, 'Alexandra_36', 'images/obras/36.jpg', 'Angela', 'Biel', 701, 305, 543.48, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(37, 'Carolina_37', 'images/obras/37.jpg', 'Martina', 'Jan', 296, 575, 228.84, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(38, 'Nadia_38', 'images/obras/38.jpg', 'Valeria', 'Eric', 548, 228, 893.27, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(39, 'Silvia_39', 'images/obras/39.jpg', 'Marti', 'Jon', 749, 304, 113.05, 1, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(40, 'Malak_40', 'images/obras/40.jpg', 'Candela', 'Bruno', 637, 762, 627.14, 0, '2017-06-12 08:43:37', '2017-06-12 08:43:37'),
	(41, 'Silvia_41', 'images/obras/41.jpg', 'Celia', 'Bruno', 206, 391, 841.17, 1, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(42, 'Nuria_42', 'images/obras/42.jpg', 'Ainara', 'Eduardo', 873, 306, 255.73, 1, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(43, 'Berta_43', 'images/obras/43.jpg', 'Julia', 'Arnau', 295, 824, 812.88, 0, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(44, 'Helena_44', 'images/obras/44.jpg', 'Elena', 'Arnau', 147, 578, 713.15, 1, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(45, 'Rocio_45', 'images/obras/45.jpg', 'Africa', 'Juan Jose', 948, 489, 159.09, 0, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(46, 'Alexia_46', 'images/obras/46.jpg', 'Daniela', 'Jose', 619, 364, 237.19, 1, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(47, 'Rocio_47', 'images/obras/47.jpg', 'Marti', 'Pablo', 250, 454, 517.56, 0, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(48, 'Nadia_48', 'images/obras/48.jpg', 'Erika', 'Ivan', 527, 647, 776.07, 1, '2017-06-12 08:43:38', '2017-06-12 08:43:38'),
	(49, 'Celia_49', 'images/obras/49.jpg', 'Aya', 'Jaime', 671, 376, 624.12, 1, '2017-06-12 08:43:38', '2017-06-12 08:43:38');
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.password_resets: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.pedidos
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subtotal` decimal(6,2) NOT NULL,
  `envio` decimal(5,2) DEFAULT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` enum('a','c') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'a',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `pedidos_id_usuario_foreign` (`id_usuario`),
  CONSTRAINT `pedidos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.pedidos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id_pedido`, `subtotal`, `envio`, `id_usuario`, `fecha_alta`, `fecha_cierre`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 764.89, 15.00, 12, '2017-06-16 10:09:12', '2017-06-16 10:17:59', 'c', '2017-06-16 10:09:12', '2017-06-16 10:17:59');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla anayzquierdo.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `poblacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `cp` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `provincia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `rol` enum('admin','cliente') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0',
  `confirm_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saludo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'anayzquierdo.com',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla anayzquierdo.usuarios: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `avatar`, `nombre`, `apellidos`, `telefono`, `direccion`, `poblacion`, `cp`, `provincia`, `rol`, `activo`, `bloqueado`, `confirm_token`, `saludo`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'dani@mail.com', '$2y$10$pK98Ec3rQSrlCLsQZsQbqeQvCpBO9bCnB9SblAK1D8Qyzm/w9VKdq', '', 'Daniel', 'Ferrer Almanza', '852123734', 'Ruela Quintana, 3, Entre suelo 9º', 'San Adame del Pozo', '08189', 'A Coruña', 'admin', 1, 0, 'znwaBMhZDjYbDQBx6RVrxEZlgE2VWj6Qzi8egU5v6CYDyMgi4qZ88HsK38nilLFWE09nrFtvcW0p4cVdpnzoYQ7tTsC9F7JKZVp3', 'Algo del Quijote', 'TSOooYVUYWV4fU2IqnQL4v1JqpjumFyS9rDZ6eTi4BEYoT9GsUDCHfbwtuvO', '2017-06-12 08:43:35', '2017-06-16 10:23:48'),
	(2, 'sanchez.pablo@hotmail.es', '$2y$10$oj8YtM5OZfQtxM65IR2yO.386mqTYqAghQiHrilhjgK1.cAx4LMFa', '', 'Malak', 'Ferrer Soto', '706172706', 'Avinguda Romo, 94, Ático 4º', 'O Adorno del Bages', '32294', 'Barcelona', 'cliente', 0, 1, 'QYqXXjukijXKH58mcaVrqTRt3wFqRY6zAfLtYKHRc9OrrsOym2NNOBjOtqDpvG01BXrCd5E4wMeWVjUGRSlrAqi3NBnEtYvLMNJl', 'anayzquierdo.com', 'ZJZareA7qv91SDOhIjbpdI4hontc9H0W7W54E9c9g6leGX1ygTcIqaPTDqmzLlswL9c6o5WECOz7b25MnCbGdLasjTjf7ABn1BaV', '2017-06-12 08:43:36', '2017-06-14 21:04:01'),
	(3, 'sola.arnau@robledo.es', '$2y$10$fLXKmQODhAYKummYaYyhru6kDnKsAJ7pwO5xQnUpzjHBh7AI7lsg6', '', 'Eric', 'Benito Treviño', '831373786', 'Camino Nayara, 1, 55º 4º', 'Vall Fierro de San Pedro', '54667', 'Huesca', 'cliente', 1, 0, 'kXMq8NK9xJ3cTZeWyuUL6zHsQ6GnV8DUE9zb8FhivJejWR8CQmtyEcroCOOxOKMBWMPywfsm7EvO4IfZ7GTzinYVwWvhMUXDEs6G', 'anayzquierdo.com', 't56voWZYHvnyGxC74W7c0fhchkm3wWVKa3zFF0rBE9eMIrB8rRbRMxoKEVjjWZolyR821sVmnSL4tymPZkmFWYRclf57uLebrotu', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(4, 'mara30@yahoo.com', '$2y$10$Sg8O4SPo8zAK6Mg4t/jH2ulZBQ.uHWgOGYTvE5ptHId5GVdy531Ni', '', 'David', 'Jaimes Zapata', '906928576', 'Calle Rosas, 93, 1º D', 'San Aranda de San Pedro', '65290', 'Cuenca', 'cliente', 0, 0, 'hZX5X5nfQk9PTwaUpMafW7Bmer1oqpYxXm4xsQTLY3GN4PxJhD0AOvvt3xPTHWEwPEncJHDBOAOO60WkoY4PBr8ynrKt6Sisvseo', 'anayzquierdo.com', '8raeUy6nayU8xOE5SIL3RrVFyMUS4hrsYbJoc2O5n4zF87qEqyhDdVXgKFZHRurny7OI7C2st73n2mrhYoZuhonFHpw5Qt3OiMJH', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(5, 'yeray.heredia@saavedra.org', '$2y$10$7prN6rgTX4.HOCBppQz.aOcuOORCCqezZOp/bul3S2kVQzczDi5ty', '', 'Sara', 'Malave Carrion', '653234698', 'Carrer Valdez, 41, 52º E', 'Puente del Mirador', '93351', 'Huelva', 'cliente', 1, 1, 'EEvPcieDmax6C7srB9lX4GqUqLDjnONttrbecen5C3bHjfivrkrVeV86cvXUjAdf2PkA1rz2REcgamNGfW6QYJrqFjeEnj722CkW', 'anayzquierdo.com', '3a05bBkni2zLNqo8Eh9h2aiHVLzRn9ZAB0YZzzztudsltFjtXS1sBz09Z48B', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(6, 'urazo@cantu.org', '$2y$10$JAnuATmIAi/cRuweqNgxjeCm95cBJlAgzB6ZgsN1uz4IaLRXSMxYG', '', 'Jaime', 'Villarreal Deleón', '758661300', 'Avinguda Bruno, 39, Ático 9º', 'A Miramontes', '11285', 'Cantabria', 'cliente', 1, 0, '74rcBPRfHDrdpmgPGAAfvsWqK55jTobLj1oFbdkAdhz5KFarAZ7fkChanRhaR9J1IaLMCYCBnwtKIdYbJuZPYFXjx1hmqrydhh9B', 'anayzquierdo.com', '5AbjJVv0u1YWCoGFF32GJMvjin0C416BFpIwogMFtjiiH5NxzLw8cSQD2OcuFbuc1mRdFnuHFrjafdOXVPEdYNifNLdfesYidAbS', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(7, 'chavarria.enrique@terra.com', '$2y$10$AA1QOHOLcc7D6L1fii9nK.mkB1bPEfIffYsBg9q/gHKQDOkPi4o02', '', 'Oriol', 'Manzanares Escobar', '921724382', 'Avenida Carlota, 0, 5º F', 'Villa Regalado', '87194', 'Asturias', 'cliente', 0, 0, 't9bStM2jtKfrLmT0tDZMagakxksAboo9Bx7Z0s2LRqSMt6zSvdw9p3563IiHao7FVybWHPjtLWVAvLiYgbQDFbEFlAvoxDtSb0On', 'anayzquierdo.com', 'vLp2AWQzpkuXMNeIBTyOlJ0rBp04gqNJRMHj3P1lPfPtbRDIFhoKKPO68evD6FwVEAkdwbLriEZiaqFtGCXUhnqvisMAm5I7X7jW', '2017-06-12 08:43:36', '2017-06-16 10:16:07'),
	(8, 'costa.ivan@hotmail.es', '$2y$10$sXg71xoD4QHbNL/CJLbLHezQNNWqVJdBdcstScyT.X1XLp9z7oU4.', '', 'Bruno', 'Cervántez Luevano', '928096736', 'Camiño Alarcón, 070, Entre suelo 4º', 'Gimeno de Ulla', '87542', 'Alava', 'cliente', 1, 0, 'mi6bQ5ntPM0uY0CzcpHrufMseSEEuTpKAH9bDqyDyOppZxvs0JXB7EdofDItJaj08Ah95E7pAsDvvXfIcJUembQqwIBB2StCPHbJ', 'anayzquierdo.com', 'kFJY6igtodiJzemff31aWOVVpKdKPtNouoNTkMvt6QRDGQxC0y4MOPoytTStqaLAnu6x8Rj4e8GhE3HXOhzHOOZrRCnDesUPYnxc', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(9, 'alba.armenta@terra.com', '$2y$10$ZhAtkRalTg8CLPUgpVjSX.ulSfZilFIdTkR5gMmdtwCruyuoifL2C', '', 'Aroa', 'Ureña Acosta', '633247437', 'Travesia Herrera, 718, 1º B', 'Bernal de la Sierra', '33440', 'Castellón', 'cliente', 0, 0, 'fHnV6rVeNpwsIyv5PiKCOYv5HrmmDainAa2TVuubBGwWA3sKgfl36Gmxdfjm07SKUjR237S1XvSSHGPOZVfnxubjXuzy0wwY5dqx', 'anayzquierdo.com', 'u0IaYBtSSp8JcaKN3xhD7Oymf0IvmqNsQQ4zxeSpEuAoZ2u2QoSiw137BEbEIKxhcgTdVgBuV0JUcnvxlMp1FcORbv5DyfEUEfEm', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(10, 'alicia09@rueda.es', '$2y$10$ppNQspXi5WTcQsa5eMDpH.3kyf/5oa.5Nppxl4iZSgKhnD7hhb4HO', '', 'Alma', 'Suárez Rolón', '648713614', 'Calle Tijerina, 78, 61º B', 'El Esparza', '11843', 'Badajoz', 'cliente', 0, 0, 'eq9wPorNBvzNspTyiVJRipRTCKIrw4WTmbJPFjZmif3LNxIGVdZ6DnLyjOde00rpQXJw83uE8KsnvbbQEYScjxIxj6T2iMX3mJKy', 'anayzquierdo.com', 'pNhyTyZvYOAqGAhJCzx6p946RHeo4icE72SFMmnrEvDsfy4qGQgMBnPHhY10QrjEWvSTyZ9AYR5U5iG4B2AkMYLqYcb85dEuw1bx', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(11, 'ebarraza@quiroz.com', '$2y$10$DPyOO0GFM1c1l.K7Y4VgrOOU3gzoiio0Wnp6QhGPiIeBFlZ1mSssa', '', 'Lola', 'Terrazas Bueno', '972006017', 'Paseo Peres, 5, 02º 7º', 'Riojas del Pozo', '58825', 'Asturias', 'cliente', 0, 0, 'RwU4o9fAh8pZtD7CGNfBEYsknARwHWOBm3sIhVEM6U0q0EKw8Enfl9ySOZBTHIAmqRKwSlbSm89sNa446RbHjueOG4JetPZ9ylZ9', 'anayzquierdo.com', 'YqbMj3ia5M7LKU3atwFqJAp6iA3HoBA65osq7oChfM1vtQBuISaOlretedfPoPE7XfqWpgmyk10FhDsGnPf1g21M0kw9nk2SMVKB', '2017-06-12 08:43:36', '2017-06-12 08:43:36'),
	(12, 'nous@hotmail.es', '$2y$10$qAoVHQyYHWHtGQbTvtREueY/aB0pgcWRDTQwn1vWbctg/nhiirSiS', '', 'Daniel', 'sdfdsfsdf', '222333555', 'sdfsdfsf', 'sfsfsdf', '34567', 'asturias', 'cliente', 1, 0, 'uZ31NBbP2LBqcTWKFwjG0z6sGwwYwnNJyS8002KacC0ZezxBvwNNACf6BefkSuyd6iNoAb9jfRrWoFhWzo49o2GyzTk1IlDM6akp', NULL, 'gsEfPCS935upDBkCpl7NFYS9kowXsDksbwlo9qUG9fVhKGnyQbPu3GPgD5k1', '2017-06-16 10:00:27', '2017-06-16 10:06:52');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
