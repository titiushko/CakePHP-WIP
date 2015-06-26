DROP DATABASE IF EXISTS cp_restaurante;
CREATE DATABASE IF NOT EXISTS cp_restaurante DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE cp_restaurante;

DROP TABLE IF EXISTS meseros;
CREATE TABLE IF NOT EXISTS meseros(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	dui VARCHAR(9) NOT NULL,
	nombres VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	apellidos VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	telefono VARCHAR(8) NULL DEFAULT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS mesas;
CREATE TABLE IF NOT EXISTS mesas(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	mesero_id INT(10) UNSIGNED NOT NULL,
	serie VARCHAR(10) NOT NULL,
	puestos VARCHAR(20) NULL DEFAULT NULL,
	posicion VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL,
	CONSTRAINT fk_mesas_meseros FOREIGN KEY(mesero_id) REFERENCES meseros(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS cocineros;
CREATE TABLE IF NOT EXISTS cocineros(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombres VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	apellidos VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS platillos;
CREATE TABLE IF NOT EXISTS platillos(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	categoria_platillo_id INT(10) UNSIGNED NOT NULL,
	nombre VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	descripcion TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
	precio FLOAT(6, 2) NOT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL,
	CONSTRAINT fk_platillos_categoria_platillos FOREIGN KEY(categoria_platillo_id) REFERENCES categoria_platillos(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS categoria_platillos;
CREATE TABLE IF NOT EXISTS categoria_platillos(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	categoria VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS cocineros_platillos;
CREATE TABLE IF NOT EXISTS cocineros_platillos(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cocinero_id INT(10) UNSIGNED NOT NULL,
	platillo_id INT(10) UNSIGNED NOT NULL,
	CONSTRAINT fk_cocineros_platillos_cocineros FOREIGN KEY(cocinero_id) REFERENCES cocineros(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_cocineros_platillos_platillos FOREIGN KEY(platillo_id) REFERENCES platillos(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ============================================================================================================================================================

INSERT INTO meseros(dui, nombres, apellidos, telefono, created) VALUES
('035494014', 'William', 'Gutierrez', '77924006', NOW()),
('084134880', 'Juan', 'Peréz', '79804894', NOW()),
('789040648', 'Pedro', 'Mendoza', '79804167', NOW()),
('294804174', 'María', 'Sanchez', '79801607', NOW()), 
('846352468', 'Melinda', 'Funes', '20814180', NOW());

INSERT INTO mesas(mesero_id, serie, puestos, posicion, created) VALUES
(2, '0978', 7, 'Apartado núm.: 408, 1581 Erat Avenida', NOW()),
(2, '0668', 7, 'Apartado núm.: 551, 8235 Eu, C.', NOW()),
(5, '2084', 8, '773-3736 Sed Calle', NOW()),
(5, '7121', 10, '4293 Vulputate ', NOW()),
(4, '8748', 6, '451-586 Est Carretera', NOW()),
(2, '5497', 4, 'Apdo.:304-5517 Adipiscing Av.', NOW()),
(1, '7411', 4, 'Apartado núm.: 670, 7255 Tristique Ctra.', NOW()),
(2, '9618', 3, '172-2410 Ornare ', NOW()),
(2, '7554', 10, '3793 Pharetra Calle', NOW()),
(1, '0023', 8, 'Apartado núm.: 929, 1284 Ut Carretera', NOW()),
(1, '6911', 9, 'Apdo.:521-6712 Elit Calle', NOW()),
(1, '2244', 5, '3625 Ac, C.', NOW()),
(2, '8348', 7, 'Apartado núm.: 138, 3448 Amet Ctra.', NOW()),
(2, '3665', 2, 'Apartado núm.: 630, 8058 Malesuada C.', NOW()),
(1, '7048', 2, 'Apartado núm.: 685, 3321 Orci Carretera', NOW()),
(4, '4171', 5, 'Apdo.:857-4135 Ac C/', NOW()),
(4, '7737', 6, 'Apdo.:666-4450 Mauris ', NOW()),
(4, '0934', 3, '9828 Scelerisque C/', NOW()),
(1, '9272', 3, 'Apdo.:459-9509 Lorem, C/', NOW()),
(3, '6747', 8, 'Apdo.:821-1821 Feugiat. C/', NOW()),
(5, '0557', 5, '258-4372 Erat Ctra.', NOW()),
(2, '5072', 8, '2087 Auctor, C/', NOW()),
(4, '0315', 7, 'Apartado núm.: 547, 7420 Ipsum Ctra.', NOW()),
(2, '0676', 9, '330-1486 Dignissim C/', NOW()),
(5, '3894', 5, '973 Fringilla. C/', NOW()),
(5, '9508', 2, 'Apartado núm.: 191, 9780 Et C/', NOW()),
(2, '7504', 3, '354-4964 Lectus Ctra.', NOW()),
(1, '8833', 4, '4258 Feugiat Ctra.', NOW()),
(1, '7521', 1, '5458 In Av.', NOW()),
(3, '6644', 2, 'Apartado núm.: 679, 9268 Tellus Calle', NOW()),
(4, '1024', 4, '815-6390 Orci Carretera', NOW()),
(2, '1031', 9, '5041 Ipsum C.', NOW()),
(2, '6621', 7, 'Apdo.:813-9254 Laoreet, Calle', NOW()),
(4, '9611', 3, 'Apartado núm.: 297, 8726 Dolor Calle', NOW()),
(3, '4377', 6, 'Apartado núm.: 978, 3668 Libero. C/', NOW()),
(1, '3989', 4, '202-9824 Egestas. Av.', NOW()),
(1, '8797', 3, '5898 Lobortis ', NOW()),
(3, '6786', 10, 'Apartado núm.: 739, 2466 Posuere, Avda.', NOW()),
(5, '2175', 4, 'Apartado núm.: 550, 1875 Nec ', NOW()),
(1, '5585', 8, 'Apartado núm.: 345, 6196 Magna. Calle', NOW()),
(5, '2807', 5, 'Apartado núm.: 837, 5384 Dignissim. Carretera', NOW()),
(3, '6635', 6, '9688 Adipiscing C.', NOW()),
(4, '4822', 7, '636-1957 Lorem ', NOW()),
(1, '6654', 6, '918-9195 Nunc Carretera', NOW()),
(3, '7744', 9, '6175 Consectetuer C/', NOW()),
(3, '2135', 10, '4449 Ultrices ', NOW()),
(4, '4116', 2, '8784 Aliquet. Ctra.', NOW()),
(1, '4023', 3, '431-104 Tincidunt Avda.', NOW()),
(4, '0282', 1, '482-8657 Torquent Carretera', NOW()),
(3, '6893', 5, 'Apartado núm.: 143, 2898 Lacinia C/', NOW()),
(3, '0654', 1, '3572 In Avenida', NOW()),
(5, '0853', 8, '8005 Eu, C.', NOW()),
(5, '4207', 6, 'Apartado núm.: 808, 794 Mi. Carretera', NOW()),
(4, '3748', 1, 'Apartado núm.: 403, 8694 Pede. Av.', NOW()),
(5, '0862', 2, 'Apartado núm.: 783, 553 Dictum Ctra.', NOW()),
(1, '7063', 2, '277-1163 Mollis C.', NOW()),
(2, '7252', 1, '5331 Egestas. Avenida', NOW()),
(2, '8782', 7, '7441 Vestibulum Av.', NOW()),
(3, '5393', 4, 'Apdo.:831-494 Hymenaeos. ', NOW()),
(2, '0428', 4, 'Apdo.:184-1538 Eu, Av.', NOW()),
(2, '4067', 1, '782-1643 Lobortis, ', NOW()),
(5, '9746', 2, 'Apdo.:925-3953 Sem Calle', NOW()),
(3, '4046', 2, '4210 Ornare, Calle', NOW()),
(3, '5639', 6, '9018 Suspendisse Calle', NOW()),
(3, '6517', 10, 'Apdo.:878-8885 Cras C/', NOW()),
(5, '3515', 3, '9260 Posuere, ', NOW()),
(5, '0557', 3, '8032 Elit Avda.', NOW()),
(1, '6964', 3, '3326 Congue, Carretera', NOW()),
(1, '0028', 2, 'Apartado núm.: 733, 6618 Praesent C.', NOW()),
(5, '3159', 7, '9063 Sem Av.', NOW()),
(2, '7922', 9, '728-926 Magna. Carretera', NOW()),
(5, '5485', 6, 'Apartado núm.: 774, 7506 Integer C/', NOW()),
(3, '9616', 1, 'Apartado núm.: 895, 1268 Natoque C.', NOW()),
(1, '3477', 8, '306-9998 Ante C.', NOW()),
(4, '4533', 10, 'Apdo.:987-9152 Sodales. C.', NOW()),
(3, '8345', 6, 'Apdo.:426-4238 Orci. C.', NOW()),
(2, '8732', 7, 'Apdo.:186-4561 Euismod Ctra.', NOW()),
(1, '9387', 6, 'Apartado núm.: 603, 5242 Ridiculus C.', NOW()),
(3, '4965', 2, 'Apdo.:579-8141 Vivamus Avenida', NOW()),
(5, '9866', 3, 'Apartado núm.: 246, 9464 In C/', NOW()),
(1, '9781', 8, '9740 Lectus Avda.', NOW()),
(1, '0097', 7, '740-3283 Integer C/', NOW()),
(4, '9396', 9, 'Apdo.:601-3597 Tempor C/', NOW()),
(1, '5002', 9, '1377 Posuere Avenida', NOW()),
(3, '1278', 7, '2452 Ullamcorper, ', NOW()),
(3, '4519', 7, 'Apartado núm.: 595, 4873 Lectus C.', NOW()),
(4, '8035', 1, 'Apartado núm.: 919, 3805 Et ', NOW()),
(4, '4029', 7, '7837 Et, C.', NOW()),
(1, '1867', 4, 'Apdo.:576-1613 Id, C.', NOW()),
(5, '2669', 1, '3300 In Avda.', NOW()),
(2, '7879', 8, 'Apdo.:690-1455 Nascetur Ctra.', NOW()),
(4, '3511', 6, '6055 Nunc Av.', NOW()),
(5, '1884', 8, '1661 Pharetra. C/', NOW()),
(3, '3192', 2, 'Apdo.:563-5466 Molestie. Avenida', NOW()),
(5, '0341', 6, 'Apartado núm.: 609, 1067 Neque. ', NOW()),
(1, '7071', 7, 'Apdo.:791-4127 Morbi Ctra.', NOW()),
(3, '9008', 6, 'Apdo.:733-5631 Vulputate, Av.', NOW()),
(5, '6922', 2, 'Apdo.:563-7237 Auctor, C.', NOW()),
(3, '0877', 9, 'Apdo.:179-9509 Non, Calle', NOW()),
(4, '8366', 8, 'Apartado núm.: 738, 1220 Lorem Avda.', NOW());

INSERT INTO cocineros(nombres, apellidos, created) VALUES
('Lucas', 'Peres', NOW()),
('Pedro', 'Masiel', NOW()),
('Juan', 'Toledo', NOW());

INSERT INTO categoria_platillos(categoria) VALUES
('Entrantes Calientes'),
('Entrantes Frios'),
('Sopas y Cremas'),
('Pastas'),
('Pescados y Mariscos'),
('Aves y Carnes'),
('Postres');

INSERT INTO platillos(nombre, descripcion, precio, created, categoria_platillo_id) VALUES
('Pica Pica', 'Bombón de pollo con especías de pescado, frituras de cerdo, croquetas de jamón, cebiche y pulpo', 10.00, NOW(), 1),
('Salmón con Aroma de Vodka', 'Riquísimo', 30.00, NOW(), 4),
('Papas Picantes', 'Papas de la maldad', 50.00, NOW(), 3);

INSERT INTO cocineros_platillos(cocinero_id, platillo_id) VALUES
(2, 1),
(2, 2),
(3, 2),
(3, 1),
(1, 5),
(3, 5);
