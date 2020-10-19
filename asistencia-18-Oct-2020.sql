-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.37-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para asistencia
CREATE DATABASE IF NOT EXISTS `asistencia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `asistencia`;

-- Volcando estructura para tabla asistencia.asignacions
CREATE TABLE IF NOT EXISTS `asignacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gestion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `docente` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materia` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horario` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.asignacions: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `asignacions` DISABLE KEYS */;
INSERT INTO `asignacions` (`id`, `gestion`, `departamento`, `docente`, `materia`, `grupo`, `horario`, `created_at`, `updated_at`) VALUES
	(1, '2020', 'Informatica y Sistemas', 'Jorge Ramos', 'Introduccion a la Programacion', '1', '6.45 am', '2020-10-13 16:11:01', '2020-10-13 16:11:01'),
	(12, '2020', 'Industrial', 'Marco Salas', 'Elementos', '2', '12.45 pm', '2020-10-13 16:54:22', '2020-10-13 16:54:22'),
	(13, '2020', 'Informatica y Sistemas', 'Ruben Marquez', 'Elementos', '2', '12.45 pm', '2020-10-13 16:55:12', '2020-10-13 16:55:12'),
	(14, '2020', 'Informatica y Sistemas', 'Jorge Ramos', 'Introduccion a la Programacion', '2A', '6.45 am', '2020-10-13 17:16:19', '2020-10-13 17:16:19'),
	(15, '2-2020', 'Industrial', 'Jose Rodriguez', 'Contabilidad basica', '1A', '12.45 pm', '2020-10-13 18:11:14', '2020-10-13 18:11:14'),
	(16, '3-2020', 'Mecanica', 'Jose Rodriguez', 'Algebra 1', '3', '8.15 am', '2020-10-13 18:35:55', '2020-10-13 18:35:55'),
	(28, '1-2020', 'Informatica y Sistemas', 'Jorge Ramos', 'Introduccion a la Programacion', '2A', '6.45 am', '2020-10-17 05:53:13', '2020-10-17 05:53:13'),
	(30, '2-2020', 'Industrial', 'Ruben Marquez', 'Base de datos I', '2', '14.15 pm', '2020-10-17 05:55:03', '2020-10-17 05:55:03'),
	(31, '1-2021', 'Fisica', 'Ruben Marquez', 'Taller de base de datos', '1A', '3', '2020-10-18 22:17:51', '2020-10-18 22:17:51');
/*!40000 ALTER TABLE `asignacions` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.carreras
CREATE TABLE IF NOT EXISTS `carreras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigocarrera` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombrecarrera` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcioncarrera` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.carreras: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
INSERT INTO `carreras` (`id`, `codigocarrera`, `nombrecarrera`, `descripcioncarrera`, `estaactivo`, `created_at`, `updated_at`) VALUES
	(1, 'SIS - 190', 'Ingenieria de Sistemas', 'Carrera de ingenieria de sistemas', 1, NULL, '2020-10-16 23:01:17'),
	(2, 'INF - 200', 'Ingenieria Informatica', 'Carrera de ingenieria informatica', 1, NULL, NULL);
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.departamentos
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombredepa` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripciondepa` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `facultad_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.departamentos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` (`id`, `nombredepa`, `descripciondepa`, `estaactivo`, `facultad_id`, `created_at`, `updated_at`) VALUES
	(1, 'Informatica y Sistemas', 'Se ocupa de las ciencias de la computacion', 1, 0, NULL, '2020-10-13 17:52:31'),
	(2, 'Industrial', 'Encargada del departamento de industrias y desarrollo', 1, 0, NULL, '2020-10-13 17:52:07'),
	(3, 'Fisica', 'Se encarga de las carreras de fisica', 1, 0, NULL, NULL),
	(4, 'Matematicas', 'Encargada del area de matematica', 1, 0, NULL, NULL),
	(5, 'Mecanica', 'Se encarga de carreras afines a mecanica y mecatronica', 1, 2, NULL, '2020-10-18 00:09:29'),
	(6, 'Alimentos', 'Se ocupa de las carreras de alimentos', 1, 2, NULL, NULL),
	(7, 'Civil', 'Se encarga de la carrera de Ingenieria Civil', 1, 2, NULL, '2020-10-18 00:38:08');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.dias
CREATE TABLE IF NOT EXISTS `dias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dia` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.dias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `dias` DISABLE KEYS */;
INSERT INTO `dias` (`id`, `dia`, `created_at`, `updated_at`) VALUES
	(1, 'Lunes', NULL, NULL),
	(2, 'Martes', NULL, NULL),
	(3, 'Miercoles', NULL, NULL),
	(4, 'Jueves', NULL, NULL);
/*!40000 ALTER TABLE `dias` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.docentes
CREATE TABLE IF NOT EXISTS `docentes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.docentes: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `docentes` DISABLE KEYS */;
INSERT INTO `docentes` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'Jorge Ramos', '2020-10-13 12:07:51', '2020-10-13 12:07:52'),
	(2, 'Marco Salas', '2020-10-13 12:43:36', '2020-10-13 12:43:37'),
	(3, 'Ruben Marquez', NULL, NULL),
	(4, 'Ricardo Lopez', NULL, NULL),
	(5, 'Antonio Cortez', NULL, NULL),
	(6, 'Jose Rodriguez', NULL, NULL);
/*!40000 ALTER TABLE `docentes` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.facultads
CREATE TABLE IF NOT EXISTS `facultads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombrefacu` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcionfacu` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.facultads: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `facultads` DISABLE KEYS */;
INSERT INTO `facultads` (`id`, `nombrefacu`, `descripcionfacu`, `estaactivo`, `created_at`, `updated_at`) VALUES
	(2, 'Tecnologia', 'Ciencias aplicadas', 1, NULL, '2020-10-13 17:53:18'),
	(3, 'Ciencias Economicas y Administrativas', 'Ciencias relacionadas a economia', 1, NULL, '2020-10-19 00:23:31'),
	(4, 'Medicina', 'Ciencias de la salud', 1, NULL, NULL);
/*!40000 ALTER TABLE `facultads` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.gestions
CREATE TABLE IF NOT EXISTS `gestions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periodogestion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `añogestion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gestion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.gestions: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `gestions` DISABLE KEYS */;
INSERT INTO `gestions` (`id`, `periodogestion`, `añogestion`, `gestion`, `estaactivo`, `created_at`, `updated_at`) VALUES
	(1, '1', '2020', '1-2020', 1, NULL, '2020-10-17 18:29:47'),
	(2, '2', '2020', '2-2020', 1, NULL, '2020-10-13 18:10:45'),
	(3, '3', '2020', '3-2020', 1, NULL, '2020-10-13 18:10:52'),
	(4, '4', '2020', '4-2020', 1, NULL, '2020-10-13 18:33:32'),
	(5, '1', '2021', '1-2021', 1, NULL, NULL);
/*!40000 ALTER TABLE `gestions` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numerogrupo` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `materia_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.grupos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`id`, `numerogrupo`, `estaactivo`, `materia_id`, `created_at`, `updated_at`) VALUES
	(2, '2', 1, 8, NULL, NULL),
	(3, '3', 1, 8, NULL, NULL),
	(4, '1A', 1, 1, NULL, NULL),
	(5, '2', 1, 1, NULL, NULL),
	(6, '4', 1, 0, NULL, NULL),
	(17, '23', 1, 1, NULL, NULL),
	(29, '1', 1, 2, NULL, NULL),
	(30, '2', 1, 4, NULL, NULL);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hora` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.horarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` (`id`, `hora`, `dia`, `grupo_id`, `created_at`, `updated_at`) VALUES
	(1, '6:45', 'Lunes', 4, NULL, '2020-10-18 20:51:09'),
	(2, '14:15', 'Miercoles', 4, '2020-10-18 12:06:37', NULL),
	(3, '8:15', 'Sabado', 29, NULL, NULL);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.horas
CREATE TABLE IF NOT EXISTS `horas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hora` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.horas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `horas` DISABLE KEYS */;
INSERT INTO `horas` (`id`, `hora`, `created_at`, `updated_at`) VALUES
	(1, '6:45', NULL, NULL),
	(2, '8:15', NULL, NULL),
	(3, '9:45', NULL, NULL),
	(4, '11:15', NULL, NULL);
/*!40000 ALTER TABLE `horas` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.materias
CREATE TABLE IF NOT EXISTS `materias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigomate` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombremate` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcionmate` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivelmate` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `departamento_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.materias: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` (`id`, `codigomate`, `nombremate`, `descripcionmate`, `nivelmate`, `estaactivo`, `departamento_id`, `created_at`, `updated_at`) VALUES
	(1, 'INF - 100', 'Introduccion a la Programacion', 'Sistemas', '1', 1, 1, NULL, '2020-10-18 00:25:19'),
	(2, 'INF - 101', 'Elementos', 'Elementos y estructuras de datos', '2', 1, 0, NULL, '2020-10-13 16:39:54'),
	(3, 'INF - 103', 'Taller de programacion', 'Metodos, tecnicas y taller de programacion', '3', 1, 0, NULL, NULL),
	(4, 'INf - 200', 'Base de datos I', 'Fundamentos de bases de datos', '3', 1, 0, NULL, NULL),
	(5, 'INf - 201', 'Base de datos II', 'Temas avanzados de bases de datos', '4', 1, 0, NULL, NULL),
	(6, 'INF - 202', 'Taller de base de datos', 'Aplicacion practica de bases de datos', '5', 1, 0, NULL, NULL),
	(8, 'IND - 455', 'Costos industriales', 'Fundamentos de costos', '6', 1, 0, NULL, NULL),
	(9, 'MAT - 102', 'Algebra 1', 'Algebra basica', '1', 1, 0, NULL, '2020-10-13 18:32:24'),
	(10, 'INF - 450', 'Dinamica de sistemas', 'Estudio de sistemas dinamicos', '7', 1, 1, NULL, NULL),
	(11, 'FIS - 101', 'Fisica 1', 'Fisica basica', '1', 1, 3, NULL, NULL);
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.migrations: ~45 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(43, '2020_10_12_022122_create_departamentos_table', 1),
	(44, '2020_10_12_055056_create_facultads_table', 1),
	(45, '2020_10_12_061323_create_materias_table', 1),
	(46, '2020_10_12_064207_create_carreras_table', 1),
	(47, '2020_10_13_122320_create_usuarios_table', 1),
	(48, '2020_10_13_142433_create_grupos_table', 1),
	(49, '2020_10_13_143841_create_gestions_table', 1),
	(50, '2020_10_13_151353_create_docentes_table', 1),
	(51, '2020_10_13_152033_create_asignacions_table', 1),
	(52, '2020_10_12_022122_create_departamentos_table', 1),
	(53, '2020_10_12_055056_create_facultads_table', 1),
	(54, '2020_10_12_061323_create_materias_table', 1),
	(55, '2020_10_12_064207_create_carreras_table', 1),
	(56, '2020_10_13_122320_create_usuarios_table', 1),
	(57, '2020_10_13_142433_create_grupos_table', 1),
	(58, '2020_10_13_143841_create_gestions_table', 1),
	(59, '2020_10_13_151353_create_docentes_table', 1),
	(60, '2020_10_13_152033_create_asignacions_table', 1),
	(61, '2014_10_12_000000_create_users_table', 2),
	(72, '2014_10_12_000000_create_users_table', 1),
	(73, '2020_10_12_022122_create_departamentos_table', 1),
	(74, '2020_10_12_055056_create_facultads_table', 1),
	(75, '2020_10_12_061323_create_materias_table', 1),
	(76, '2020_10_12_064207_create_carreras_table', 1),
	(77, '2020_10_13_122320_create_usuarios_table', 1),
	(78, '2020_10_13_142433_create_grupos_table', 1),
	(79, '2020_10_13_143841_create_gestions_table', 1),
	(80, '2020_10_13_151353_create_docentes_table', 1),
	(81, '2020_10_13_152033_create_asignacions_table', 1),
	(82, '2020_10_18_152434_create_horarios_table', 3),
	(83, '2020_10_18_154146_create_horas_table', 4),
	(84, '2020_10_18_154200_create_dias_table', 4),
	(85, '2014_10_12_000000_create_users_table', 1),
	(86, '2020_10_12_022122_create_departamentos_table', 1),
	(87, '2020_10_12_055056_create_facultads_table', 1),
	(88, '2020_10_12_061323_create_materias_table', 1),
	(89, '2020_10_12_064207_create_carreras_table', 1),
	(90, '2020_10_13_122320_create_usuarios_table', 1),
	(91, '2020_10_13_142433_create_grupos_table', 1),
	(92, '2020_10_13_143841_create_gestions_table', 1),
	(93, '2020_10_13_151353_create_docentes_table', 1),
	(94, '2020_10_13_152033_create_asignacions_table', 1),
	(95, '2020_10_18_152434_create_horarios_table', 1),
	(96, '2020_10_18_154146_create_horas_table', 1),
	(97, '2020_10_18_154200_create_dias_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechanacimiento` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigosis` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contraseña` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contraseñacodificada` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_codigosis_unique` (`codigosis`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.users: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nombres`, `apellidos`, `cedula`, `fechanacimiento`, `direccion`, `profesion`, `codigosis`, `contraseña`, `contraseñacodificada`, `estaactivo`, `created_at`, `updated_at`) VALUES
	(2, 'Jorge', 'Ramos', '69746545', '1979-10-07', 'Parque La Torre', 'Ing. Sistemas', '201231321', 'jorge', '$2y$10$E9qlC1dHOpbun95hvPB4N.3TgEwYRguf0m3Cs3FNjnNLSsHnXu2dO', 1, NULL, '2020-10-17 19:27:30'),
	(3, 'Carlos', 'Perez', '1235466', '15/08/1984', 'Calle Robles', 'Ing. Electrico', '201786654', 'carlosp.1', '', 1, NULL, '2020-10-13 17:49:04'),
	(4, 'Camilo Jose', 'Castro Martinez', '8965431', '25/07/1970', 'Abedules', 'Ing. Electrico', '200523215', 'camilo.castro', '', 1, NULL, '2020-10-13 18:28:31'),
	(6, 'Carlos', 'Dominguez', '98746541', '17/04/1985', 'Lanza 512', 'Ing. Industrial', '2009541321', 'domin.carlos.12', '', 1, NULL, NULL),
	(7, 'Jose', 'Castro', '1654554', '15/09/1980', 'Baptista', 'Ing. Sistemas', '20012554', 'castro.1', '', 1, NULL, NULL),
	(8, 'Jorge', 'Robles', '135484', '1984-06-08', 'Avenida Humboldt', 'Ing. Industrial', '2010089546', 'jorgerobles', '$2y$10$hgfJBAoF3gkx.BG6X8xyne8yHIG4AHZ1qNL.WIiGkY6WxTza4A4a.', 1, NULL, '2020-10-17 18:27:23'),
	(9, 'Alberto', 'Ramirez', '652312', '1950-06-25', 'Calle Lanza', 'Adm. de empresas', '200165323', 'albertoramirez', '$2y$10$3LXqDtf9sSx3kENkjYgAvO3JD9j/WXtzo714kI6uy.CW9sm62H9mi', 1, NULL, '2020-10-17 18:28:11'),
	(11, 'Carlos', 'Garcia', '8103655', '1988-06-10', 'Calle Mendez Roca', 'Ing. de Alimentos', '2015562311', 'carlos', '$2y$10$2HP2HVPU0SoQGdhyHwPSBOF/E1mVZP8e8KimSZ8X8ngfDLMQt02Fu', 1, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla asistencia.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechanacimiento` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigosis` int(11) NOT NULL,
  `contraseña` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contraseñacodificada` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estaactivo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla asistencia.usuarios: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `cedula`, `fechanacimiento`, `direccion`, `profesion`, `codigosis`, `contraseña`, `contraseñacodificada`, `estaactivo`, `created_at`, `updated_at`) VALUES
	(2, 'Jorge', 'Ramos', '69746545', '15/01/1960', 'Parque La Torre', 'Ing. Sistemas', 201231321, 'jorge', '$2y$10$6IDcnO4f3GLrzdlW96r.muOkWoR0VytSzf30dnSsr0k/rf52RVBXq', 1, NULL, '2020-10-17 18:28:37'),
	(3, 'Carlos', 'Perez', '1235466', '15/08/1984', 'Calle Robles', 'Ing. Electrico', 201786654, 'carlosp.1', '', 1, NULL, '2020-10-13 17:49:04'),
	(4, 'Camilo Jose', 'Castro Martinez', '8965431', '25/07/1970', 'Abedules', 'Ing. Electrico', 200523215, 'camilo.castro', '', 1, NULL, '2020-10-13 18:28:31'),
	(6, 'Carlos', 'Dominguez', '98746541', '17/04/1985', 'Lanza 512', 'Ing. Industrial', 2009541321, 'domin.carlos.12', '', 1, NULL, NULL),
	(7, 'Jose', 'Castro', '1654554', '15/09/1980', 'Baptista', 'Ing. Sistemas', 20012554, 'castro.1', '', 1, NULL, NULL),
	(8, 'Jorge', 'Robles', '135484', '1984-06-08', 'Avenida Humboldt', 'Ing. Industrial', 2010089546, 'jorgerobles', '$2y$10$hgfJBAoF3gkx.BG6X8xyne8yHIG4AHZ1qNL.WIiGkY6WxTza4A4a.', 1, NULL, '2020-10-17 18:27:23'),
	(9, 'Alberto', 'Ramirez', '652312', '1950-06-25', 'Calle Lanza', 'Adm. de empresas', 200165323, 'albertoramirez', '$2y$10$3LXqDtf9sSx3kENkjYgAvO3JD9j/WXtzo714kI6uy.CW9sm62H9mi', 1, NULL, '2020-10-17 18:28:11'),
	(10, 'Martin', 'De la Via', '3023226', '1980-07-08', 'Pasaje Numero 20', 'Lic. en Matematica', 200605152, 'martin', '$2y$10$sO7sl0GU3KSi6wHqyespKOEW3F5X772DSg2GU1fatN91UgSXymeHq', 1, NULL, NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
