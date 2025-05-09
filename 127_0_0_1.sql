-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2025 a las 00:53:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plan_capacitacion`
--
CREATE DATABASE IF NOT EXISTS `plan_capacitacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `plan_capacitacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre`) VALUES
(1, 'Pedagógicos'),
(2, 'Personal Social/Gestión'),
(3, 'Técnico/Productivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_calificacion` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `nota` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `obser` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_familia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre`, `id_familia`) VALUES
(1, 'Administración Industrial', 3),
(2, 'Administración Logística', 3),
(3, 'Administración de Empresas', 3),
(4, 'Marketing y Gestión Comercial', 3),
(5, 'Administración de Negocios Internacionales', 3),
(6, 'Ingeniería de Producción Industrial', 3),
(7, 'Agroindustria', 4),
(8, 'Diseño Gráfico', 5),
(9, 'Diseño y Producción de Animación Digital', 5),
(10, 'Producción Gráfica', 5),
(11, 'Confeccionista de Prendas de Vestir', 6),
(12, 'Diseño y Gestión de Moda', 6),
(13, 'Mecatrónica en la Industria de la Moda', 6),
(14, 'Tecnología de Procesos de Producción de Prendas de Vestir', 6),
(15, 'Electrónica y Automatización Industrial', 7),
(16, 'Ingeniería Mecatrónica', 7),
(17, 'Electricidad Industrial', 7),
(18, 'Cocina Peruana Internacional', 8),
(19, 'Guía Oficial de Turismo', 8),
(20, 'Ingeniería de Industrias Alimentarias', 9),
(21, 'Panadería y Pastelería', 9),
(22, 'Control de Calidad y Procesos en la Industria Alimentaria', 9),
(23, 'Técnicas en Ingeniería de Industrias Alimentarias', 9),
(24, 'Operaciones Industriales de Alimentos y Bebidas', 9),
(25, 'Procesamiento Industrial de Alimentos', 9),
(26, 'Procesos de la Industria Alimentarias y Productos Hidrobiológicos', 9),
(27, 'Mecánico de Automotores Diésel', 10),
(28, 'Mecatrónica de Buses y Camiones', 10),
(29, 'Mantenimiento de Maquinaria Pesada para Construcción', 10),
(30, 'Mecánico de Motores Menores', 10),
(31, 'Mecatrónica de Maquinaria Agrícola', 10),
(32, 'Mecánico Automotriz', 10),
(33, 'Mecánico de Mantenimiento de Maquinaria Pesada', 10),
(34, 'Mecatrónica Automotriz', 10),
(35, 'Mantenimiento de Maquinaria Pesada', 10),
(36, 'Mecánico de Maquinaria Pesada', 10),
(37, 'Diseño Gráfico Digital', 14),
(38, 'Ingeniería de Software con Inteligencia Artificial', 14),
(39, 'Redes y Seguridad Informática', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `id_area` int(11) NOT NULL,
  `mat_cur` varchar(100) NOT NULL,
  `duracion` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facilitadores`
--

CREATE TABLE `facilitadores` (
  `id_facilitador` int(11) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `movil` varchar(20) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `facilitadores`
--

INSERT INTO `facilitadores` (`id_facilitador`, `apellidos`, `nombres`, `movil`, `correo`) VALUES
(280269, 'Moya Machado', 'Danilo', '927994793', 'dmoya@senati.pe'),
(525573, 'Gavidia Huerta', 'Dino Nino', '962920777', 'dgavidia@senati.pe'),
(627841, 'Carhuapoma Otayza', 'Rodolfo Waldo', '988460828', 'rcarhuapoma@senati.pe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id_familia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`id_familia`, `nombre`) VALUES
(1, 'Estudios Generales'),
(2, 'Cursos Transversales'),
(3, 'Administración de Empresas'),
(4, 'Agroindustria'),
(5, 'Artes Gráficas'),
(6, 'Confección de Prendas de Vestir'),
(7, 'Electrotécnia'),
(8, 'Hotelería, Turismo y Restaurantes'),
(9, 'Industria Alimentaria'),
(10, 'Mecánica Automotriz'),
(11, 'Metalmecánica'),
(12, 'Procesos Industriales'),
(13, 'Tecnologías Ambientales'),
(14, 'Tecnologías de la Información'),
(15, 'Textil'),
(16, 'Joyería, Platería y Orfebrería'),
(17, 'Mantenimiento'),
(18, 'Industria del Plástico'),
(19, 'Inglés'),
(20, 'Escuela Superior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_modalidad` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'activo',
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidades`
--

CREATE TABLE `modalidades` (
  `id_modalidad` int(11) NOT NULL,
  `modalidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `modalidades`
--

INSERT INTO `modalidades` (`id_modalidad`, `modalidad`) VALUES
(1, 'Presencial'),
(2, 'Remota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE `participantes` (
  `id_participante` int(9) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `movil` varchar(20) DEFAULT NULL,
  `correo_ins` varchar(150) DEFAULT NULL,
  `correo_per` varchar(150) DEFAULT NULL,
  `jornada` varchar(50) DEFAULT NULL,
  `id_carrera` int(11) NOT NULL,
  `id_zonal` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `participantes`
--

INSERT INTO `participantes` (`id_participante`, `apellidos`, `nombres`, `movil`, `correo_ins`, `correo_per`, `jornada`, `id_carrera`, `id_zonal`, `id_sede`, `observacion`) VALUES
(47005, 'Pinzas Anselmi', 'Luis Carlos', '979200071', 'lpinzas@senati.pe', 'lpinzas@gmail.com', 'Completa', 32, 13, 45, 'Indeterminado'),
(411640, 'Vara Chavez', 'Joffre Hugo', '979115602', 'jhvara@senati.pe', 'jhvara@outlook.com', 'Completa', 38, 13, 45, 'No indeterminado'),
(525573, 'Gavidia Huerta', 'Dino Nino', '962920777', 'dgavidia@senati.pe', 'dgavidia@outlook.com', 'Completa', 32, 13, 45, 'Indeterminado'),
(539014, 'Medina Urbina', 'Enrique', '949685252', 'medinau@senati.pe', 'medinau@outlook.com', 'Completa', 39, 13, 45, 'Indeterminado'),
(978057, 'Domínguez Pilco', 'Alexander', '962077778', 'adominguez@senati.pe', 'adominguez@gmail.com', 'Completa', 38, 13, 45, 'No indeterminado'),
(984187, 'Cachay de la Puente', 'José Luis', '964641315', 'jcachay@senati.pe', 'jcachay@outlook.com', 'Completa', 37, 13, 45, 'No indeterminado'),
(1067235, 'Baldeón Robles', 'Roberto Carlos', '929215838', 'rbaldeon@senati.pe', 'rbaldeonrobles@gmail.com', 'Completa', 37, 13, 45, 'No indeterminado'),
(1079952, 'Cajas Herrera', 'Yoni Lino', '988409892', 'ycajas@senati.pe', 'ycajas@gmail.com', 'Parcial', 39, 13, 45, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id_programa` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id_programa`, `nombre`) VALUES
(1, 'Certificación de Instructores'),
(2, 'Formación Pedagógica de Instructores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `id_zonal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `sede`, `id_zonal`) VALUES
(1, 'CFP Chimbote', 1),
(2, 'CFP Huaraz', 1),
(3, 'CFP Arequipa', 2),
(4, 'CFP Juliaca', 2),
(5, 'CFP Mollendo', 2),
(6, 'CFP Puno', 2),
(7, 'CFP Cajamarca', 3),
(8, 'CFP Moyobamba', 3),
(9, 'CFP Utcubamba', 3),
(10, 'UCP Tarapoto', 3),
(11, 'UCP Cajamarca', 3),
(12, 'UCP Jaen', 3),
(13, 'UCP Chachapoyas', 3),
(14, 'CFP Cusco', 4),
(15, 'CFP Abancay', 4),
(16, 'CFP Andahuaylas', 4),
(17, 'CFP Puerto Maldonado', 4),
(18, 'CFP Ayacucho', 5),
(19, 'CFP Chincha', 5),
(20, 'CFP Ica', 5),
(21, 'CFP Pisco', 5),
(22, 'CFP Cerro de Pasco', 6),
(23, 'CFP La Oroya', 6),
(24, 'CFP San Ramón', 6),
(25, 'CFP Huancavelica', 6),
(26, 'CFP Huancayo', 6),
(27, 'CFP Río Negro', 6),
(28, 'CFP Chiclayo', 7),
(29, 'CFP Trujillo', 8),
(30, 'CFP Surquillo', 9),
(31, 'CFP Cañete', 9),
(32, 'CFP Villa el Salvador', 9),
(33, 'CFP Callao-Ventanilla', 9),
(34, 'CFP Huaura', 9),
(35, 'CFP Luis Cáceres Graziani', 9),
(36, 'CFP Iquitos', 10),
(37, 'CFP Ilo', 11),
(38, 'CFP Tacna', 11),
(39, 'CFP Talara', 12),
(40, 'CFP Paita', 12),
(41, 'CFP Piura', 12),
(42, 'CFP Sechura', 12),
(43, 'CFP Sullana', 12),
(44, 'CFP Tumbes', 12),
(45, 'CFP Huánuco', 13),
(46, 'CFP Pucallpa', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `nombre`) VALUES
(1, 'Capacitaciones'),
(2, 'Capacitaciones por compras'),
(3, 'Eventos'),
(4, 'Inducción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonales`
--

CREATE TABLE `zonales` (
  `id_zonal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `zonales`
--

INSERT INTO `zonales` (`id_zonal`, `nombre`) VALUES
(1, 'Ancash'),
(2, 'Arequipa-Puno'),
(3, 'Cajamarca-Amazonas-San Martín'),
(4, 'Cusco-Apurímac-Madre de Dios'),
(5, 'Ica-Ayacucho'),
(6, 'Junín-Pasco-Huancavelica'),
(7, 'Lambayeque'),
(8, 'La Libertad'),
(9, 'Lima-Callao'),
(10, 'Loreto'),
(11, 'Moquegua-Tacna'),
(12, 'Piura-Tumbes'),
(13, 'Ucayali-Huánuco');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `fk_calificaciones_matriculas` (`id_matricula`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`),
  ADD KEY `fk_carreras_familias` (`id_familia`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_cursos_areas` (`id_area`),
  ADD KEY `fk_cursos_tipos` (`id_tipo`),
  ADD KEY `fk_cursos_programas` (`id_programa`);

--
-- Indices de la tabla `facilitadores`
--
ALTER TABLE `facilitadores`
  ADD PRIMARY KEY (`id_facilitador`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id_familia`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `fk_matriculas_participantes` (`id_participante`),
  ADD KEY `fk_matriculas_cursos` (`id_curso`),
  ADD KEY `fk_matriculas_modalidades` (`id_modalidad`),
  ADD KEY `fk_matriculas_facilitadores` (`id_facilitador`);

--
-- Indices de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id_modalidad`);

--
-- Indices de la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id_participante`),
  ADD KEY `fk_participantes_carreras` (`id_carrera`),
  ADD KEY `fk_participantes_zonales` (`id_zonal`),
  ADD KEY `fk_participantes_sedes` (`id_sede`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`),
  ADD KEY `fk_sedes_zonales` (`id_zonal`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `fk_usuarios_roles` (`id_rol`);

--
-- Indices de la tabla `zonales`
--
ALTER TABLE `zonales`
  ADD PRIMARY KEY (`id_zonal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id_modalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonales`
--
ALTER TABLE `zonales`
  MODIFY `id_zonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_matriculas` FOREIGN KEY (`id_matricula`) REFERENCES `matriculas` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD CONSTRAINT `fk_carreras_familias` FOREIGN KEY (`id_familia`) REFERENCES `familias` (`id_familia`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cursos_programas` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cursos_tipos` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id_tipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `fk_matriculas_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matriculas_facilitadores` FOREIGN KEY (`id_facilitador`) REFERENCES `facilitadores` (`id_facilitador`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matriculas_modalidades` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidades` (`id_modalidad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matriculas_participantes` FOREIGN KEY (`id_participante`) REFERENCES `participantes` (`id_participante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `fk_participantes_carreras` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participantes_sedes` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participantes_zonales` FOREIGN KEY (`id_zonal`) REFERENCES `zonales` (`id_zonal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD CONSTRAINT `fk_sedes_zonales` FOREIGN KEY (`id_zonal`) REFERENCES `zonales` (`id_zonal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
