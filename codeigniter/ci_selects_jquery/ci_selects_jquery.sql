DROP DATABASE IF EXISTS ci_selects_jquery;
CREATE DATABASE ci_selects_jquery DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE ci_selects_jquery;

DROP TABLE IF EXISTS departamentos;
CREATE TABLE IF NOT EXISTS departamentos (
	codigo_departamento int(11) NOT NULL,
	nombre_departamento varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=15 ;

INSERT INTO departamentos (codigo_departamento, nombre_departamento) VALUES
(1, 'Ahuachapan'),
(2, 'Santa Ana'),
(3, 'Sonsonate'),
(4, 'Chalatenango'),
(5, 'Cuscatlan'),
(6, 'San Salvador'),
(7, 'La Libertad'),
(8, 'San Vicente'),
(9, 'La Paz'),
(10, 'Cabañas'),
(11, 'Usulutan'),
(12, 'San Miguel'),
(13, 'Morazan'),
(14, 'La Union');

DROP TABLE IF EXISTS municipios;
CREATE TABLE IF NOT EXISTS municipios (
	codigo_municipio int(11) NOT NULL,
	codigo_departamento int(11) NOT NULL,
	nombre_municipio varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=263 ;

INSERT INTO municipios (codigo_municipio, codigo_departamento, nombre_municipio) VALUES
(1, 1, 'Ahuachapan'),
(2, 1, 'Jujutla'),
(3, 1, 'Atiquizaya'),
(4, 1, 'Concepcion de Ataco'),
(5, 1, 'El Refugio'),
(6, 1, 'Guaymango'),
(7, 1, 'Apaneca'),
(8, 1, 'San Francisco Menendez'),
(9, 1, 'San Lorenzo'),
(10, 1, 'San Pedro Puxtla'),
(11, 1, 'Tacuba'),
(12, 1, 'Turin'),
(13, 2, 'Candelaria de la Frontera'),
(14, 2, 'Chalchuapa'),
(15, 2, 'Coatepeque'),
(16, 2, 'El Congo'),
(17, 2, 'El Porvenir'),
(18, 2, 'Masahuat'),
(19, 2, 'Metapan'),
(20, 2, 'San Antonio Pajonal'),
(21, 2, 'San Sebastian Salitrillo'),
(22, 2, 'Santa Ana'),
(23, 2, 'Santa Rosa Guachipilin'),
(24, 2, 'Santiago de la Frontera'),
(25, 2, 'Texistepeque'),
(26, 3, 'Acajutla'),
(27, 3, 'Armenia'),
(28, 3, 'Caluco'),
(29, 3, 'Cuisnahuat'),
(30, 3, 'Izalco'),
(31, 3, 'Juayua'),
(32, 3, 'Nahuizalco'),
(33, 3, 'Nahulingo'),
(34, 3, 'Salcoatitan'),
(35, 3, 'San Antonio del Monte'),
(36, 3, 'San Julian'),
(37, 3, 'Santa Catarina Masahuat'),
(38, 3, 'Santa Isabel Ishuatan'),
(39, 3, 'Santo Domingo'),
(40, 3, 'Sonsonate'),
(41, 3, 'Sonzacate'),
(42, 4, 'Agua Caliente'),
(43, 4, 'Arcatao'),
(44, 4, 'Azacualpa'),
(45, 4, 'Chalatenango'),
(46, 4, 'Citala'),
(47, 4, 'Comalapa'),
(48, 4, 'Concepcion Quezaltepeque'),
(49, 4, 'Dulce Nombre de Maria'),
(50, 4, 'El Carrizal'),
(51, 4, 'El Paraiso'),
(52, 4, 'La Laguna'),
(53, 4, 'La Palma'),
(54, 4, 'La Reina'),
(55, 4, 'Las Vueltas'),
(56, 4, 'Nueva Concepcion'),
(57, 4, 'Nueva Trinidad'),
(58, 4, 'Nombre de Jesus'),
(59, 4, 'Ojos de Agua'),
(60, 4, 'Potonico'),
(61, 4, 'San Antonio de la Cruz'),
(62, 4, 'San Antonio Los Ranchos'),
(63, 4, 'San Fernando'),
(64, 4, 'San Francisco Lempa'),
(65, 4, 'San Francisco Morazan'),
(66, 4, 'San Ignacio'),
(67, 4, 'San Isidro Labrador'),
(68, 4, 'San Jose Cancasque'),
(69, 4, 'San Jose Las Flores'),
(70, 4, 'San Luis del Carmen'),
(71, 4, 'San Miguel de Mercedes'),
(72, 4, 'San Rafael'),
(73, 4, 'Santa Rita'),
(74, 4, 'Tejutla'),
(75, 5, 'Candelaria'),
(76, 5, 'Cojutepeque'),
(77, 5, 'El Carmen'),
(78, 5, 'El Rosario'),
(79, 5, 'Monte San Juan'),
(80, 5, 'Oratorio de Concepcion'),
(81, 5, 'San Bartolom? Perulapia'),
(82, 5, 'San Cristobal'),
(83, 5, 'San Jose Guayabal'),
(84, 5, 'San Pedro Perulapan'),
(85, 5, 'San Rafael Cedros'),
(86, 5, 'San Ramon'),
(87, 5, 'Santa Cruz Analquito'),
(88, 5, 'Santa Cruz Michapa'),
(89, 5, 'Suchitoto'),
(90, 5, 'Tenancingo'),
(91, 6, 'Aguilares'),
(92, 6, 'Apopa'),
(93, 6, 'Ayutuxtepeque'),
(94, 6, 'Cuscatancingo'),
(95, 6, 'Delgado'),
(96, 6, 'El Paisnal'),
(97, 6, 'Guazapa'),
(98, 6, 'Ilopango'),
(99, 6, 'Mejicanos'),
(100, 6, 'Nejapa'),
(101, 6, 'Panchimalco'),
(102, 6, 'Rosario de Mora'),
(103, 6, 'San Marcos'),
(104, 6, 'San Martin'),
(105, 6, 'San Salvador'),
(106, 6, 'Santiago Texacuangos'),
(107, 6, 'Santo Tomas'),
(108, 6, 'Soyapango'),
(109, 6, 'Tonacatepeque'),
(110, 7, 'Antiguo Cuscatlan'),
(111, 7, 'Chiltiupan'),
(112, 7, 'Ciudad Arce'),
(113, 7, 'Colon'),
(114, 7, 'Comasagua'),
(115, 7, 'Huizucar'),
(116, 7, 'Jayaque'),
(117, 7, 'Jicalapa'),
(118, 7, 'La Libertad'),
(119, 7, 'Santa Tecla'),
(120, 7, 'Nuevo Cuscatlan'),
(121, 7, 'San Juan Opico'),
(122, 7, 'Quezaltepeque'),
(123, 7, 'Sacacoyo'),
(124, 7, 'San Jose Villanueva'),
(125, 7, 'San Matias'),
(126, 7, 'San Pablo Tacachico'),
(127, 7, 'Talnique'),
(128, 7, 'Tamanique'),
(129, 7, 'Teotepeque'),
(130, 7, 'Tepecoyo'),
(131, 7, 'Zaragoza'),
(132, 8, 'Apastepeque'),
(133, 8, 'Guadalupe'),
(134, 8, 'San Cayetano Istepeque'),
(135, 8, 'San Esteban Catarina'),
(136, 8, 'San Ildefonso'),
(137, 8, 'San Lorenzo'),
(138, 8, 'San Sebastian'),
(139, 8, 'San Vicente'),
(140, 8, 'Santa Clara'),
(141, 8, 'Santo Domingo'),
(142, 8, 'Tecoluca'),
(143, 8, 'Tepetitan'),
(144, 8, 'Verapaz'),
(145, 9, 'Cuyultitlan'),
(146, 9, 'El Rosario'),
(147, 9, 'Jerusalen'),
(148, 9, 'Mercedes La Ceiba'),
(149, 9, 'Olocuilta'),
(150, 9, 'Paraiso de Osorio'),
(151, 9, 'San Antonio Masahuat'),
(152, 9, 'San Emigdio'),
(153, 9, 'San Francisco Chinameca'),
(154, 9, 'San Juan Nonualco'),
(155, 9, 'San Juan Talpa'),
(156, 9, 'San Juan Tepezontes'),
(157, 9, 'San Luis Talpa'),
(158, 9, 'San Luis La Herradura'),
(159, 9, 'San Miguel Tepezontes'),
(160, 9, 'San Pedro Masahuat'),
(161, 9, 'San Pedro Nonualco'),
(162, 9, 'San Rafael Obrajuelo'),
(163, 9, 'Santa Maria Ostuma'),
(164, 9, 'Santiago Nonualco'),
(165, 9, 'Tapalhuaca'),
(166, 9, 'Zacatecoluca'),
(167, 10, 'Cinquera'),
(168, 10, 'Dolores'),
(169, 10, 'Guacotecti'),
(170, 10, 'Ilobasco'),
(171, 10, 'Jutiapa'),
(172, 10, 'San Isidro'),
(173, 10, 'Sensuntepeque'),
(174, 10, 'Tejutepeque'),
(175, 10, 'Victoria'),
(176, 11, 'Alegria'),
(177, 11, 'Berlin'),
(178, 11, 'California'),
(179, 11, 'Concepcion Batres'),
(180, 11, 'El Triunfo'),
(181, 11, 'Ereguayquin'),
(182, 11, 'Estanzuelas'),
(183, 11, 'Jiquilisco'),
(184, 11, 'Jucuapa'),
(185, 11, 'Jucuaran'),
(186, 11, 'Mercedes Umana'),
(187, 11, 'Nueva Granada'),
(188, 11, 'Ozatlan'),
(189, 11, 'Puerto El Triunfo'),
(190, 11, 'San Agustin'),
(191, 11, 'San Buenaventura'),
(192, 11, 'San Dionisio'),
(193, 11, 'San Francisco Javier'),
(194, 11, 'Santa Elena'),
(195, 11, 'Santa Maria'),
(196, 11, 'Santiago de Maria'),
(197, 11, 'Tecapan'),
(198, 11, 'Usulutan'),
(199, 12, 'Carolina'),
(200, 12, 'Chapeltique'),
(201, 12, 'Chinameca'),
(202, 12, 'Chirilagua'),
(203, 12, 'Ciudad Barrios'),
(204, 12, 'Comacaran'),
(205, 12, 'El Transito'),
(206, 12, 'Lolotique'),
(207, 12, 'Moncagua'),
(208, 12, 'Nueva Guadalupe'),
(209, 12, 'Nuevo Eden de San Juan'),
(210, 12, 'Quelepa'),
(211, 12, 'San Antonio del Mosco'),
(212, 12, 'San Gerardo'),
(213, 12, 'San Jorge'),
(214, 12, 'San Luis de la Reina'),
(215, 12, 'San Miguel'),
(216, 12, 'San Rafael Oriente'),
(217, 12, 'Sesori'),
(218, 12, 'Uluazapa'),
(219, 13, 'Arambala'),
(220, 13, 'Cacaopera'),
(221, 13, 'Chilanga'),
(222, 13, 'Corinto'),
(223, 13, 'Delicias de Concepcion'),
(224, 13, 'El Divisadero'),
(225, 13, 'El Rosario'),
(226, 13, 'Gualococti'),
(227, 13, 'Guatajiagua'),
(228, 13, 'Joateca'),
(229, 13, 'Jocoaitique'),
(230, 13, 'Jocoro'),
(231, 13, 'Lolotiquillo'),
(232, 13, 'Meanguera'),
(233, 13, 'Osicala'),
(234, 13, 'Perquin'),
(235, 13, 'San Carlos'),
(236, 13, 'San Fernando'),
(237, 13, 'San Francisco Gotera'),
(238, 13, 'San Isidro'),
(239, 13, 'San Simon'),
(240, 13, 'Sensembra'),
(241, 13, 'Sociedad'),
(242, 13, 'Torola'),
(243, 13, 'Yamabal'),
(244, 13, 'Yoloaiquin'),
(245, 14, 'La Union'),
(246, 14, 'San Alejo'),
(247, 14, 'Yucuaiquin'),
(248, 14, 'Conchagua'),
(249, 14, 'Intipuca'),
(250, 14, 'San Jose'),
(251, 14, 'El Carmen'),
(252, 14, 'Yayantique'),
(253, 14, 'Bolivar'),
(254, 14, 'Meanguera del Golfo'),
(255, 14, 'Santa Rosa de Lima'),
(256, 14, 'Pasaquina'),
(257, 14, 'Anamoros'),
(258, 14, 'Nueva Esparta'),
(259, 14, 'El Sauce'),
(260, 14, 'Concepcion de Oriente'),
(261, 14, 'Poloros'),
(262, 14, 'Lislique');

ALTER TABLE departamentos
ADD PRIMARY KEY (codigo_departamento);

ALTER TABLE municipios
ADD PRIMARY KEY (codigo_municipio), ADD KEY pertenece (codigo_departamento);

ALTER TABLE departamentos
MODIFY codigo_departamento int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
ALTER TABLE municipios
MODIFY codigo_municipio int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=263;

ALTER TABLE municipios
ADD CONSTRAINT pertenece FOREIGN KEY (codigo_departamento) REFERENCES departamentos (codigo_departamento) ON DELETE CASCADE ON UPDATE CASCADE;
