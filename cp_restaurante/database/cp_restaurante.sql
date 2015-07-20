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
	foto VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	foto_dir VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
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

DROP TABLE IF EXISTS pedidos;
CREATE TABLE IF NOT EXISTS pedidos(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	platillo_id INT(10) UNSIGNED NOT NULL,
	cantidad INT(2) UNSIGNED NOT NULL,
	subtotal DECIMAL(6, 2) NOT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL,
	CONSTRAINT fk_pedidos_platillos FOREIGN KEY(platillo_id) REFERENCES platillos(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS ordenes;
CREATE TABLE IF NOT EXISTS ordenes(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	mesa_id INT(10) UNSIGNED NOT NULL,
	mesero_id INT(10) UNSIGNED NOT NULL,
	total DECIMAL(6, 2) NOT NULL,
	cliente VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
	dui VARCHAR(9) NOT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL,
	CONSTRAINT fk_ordenes_mesas FOREIGN KEY(mesa_id) REFERENCES mesas(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_ordenes_meseros FOREIGN KEY(mesero_id) REFERENCES meseros(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS platillos_ordenes;
CREATE TABLE IF NOT EXISTS platillos_ordenes(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	platillo_id INT(10) UNSIGNED NOT NULL,
	orden_id INT(10) UNSIGNED NOT NULL,
	cantidad INT(2) UNSIGNED NOT NULL,
	subtotal DECIMAL(6, 2) NOT NULL,
	created DATETIME NULL DEFAULT NULL,
	modified DATETIME NULL DEFAULT NULL,
	CONSTRAINT fk_platillos_ordenes_platillos FOREIGN KEY(platillo_id) REFERENCES platillos(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_platillos_ordenes_ordenes FOREIGN KEY(orden_id) REFERENCES ordenes(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ============================================================================================================================================================

INSERT INTO meseros(dui, nombres, apellidos, telefono, created) VALUES
('33940100', 'Kevin Abigail', 'Marquez Martínez', '3792662', NOW()),
('54572976', 'Grissel Guillermo', 'Ayala Colocho', '4051728', NOW()),
('15406675', 'Gerardo Jesus', 'Oviedo Mencos', '9994647', NOW()),
('94644926', 'Jesus Novoa', 'Pozos Rivas', '2953337', NOW()),
('10478183', 'Kristian Tatiana', 'Cruz Monjaras', '7511198', NOW()),
('47263507', 'Marlene Edgardo', 'Cubas Cubas', '6652709', NOW()),
('91910685', 'Edenilson Juan', 'Orellana Echeverria', '5706324', NOW()),
('88571663', 'Juan Willian', 'Carranza Reyes', '7086769', NOW()),
('62732097', 'Daniel Ivette', 'Diaz Cerritos', '1333166', NOW()),
('67215725', 'Carmen Ingris', 'Cerritos Echeverria', '2653664', NOW());

INSERT INTO mesas(mesero_id, serie, puestos, posicion, created) VALUES
(7, '0037', 4, 'Lado superior derecho', NOW()),
(8, '0052', 1, 'Lado central centro', NOW()),
(4, '0268', 10, 'Lado central derecho', NOW()),
(3, '0408', 2, 'Lado superior izquierdo', NOW()),
(4, '0791', 9, 'Lado central izquierdo', NOW()),
(8, '0130', 10, 'Lado superior derecho', NOW()),
(6, '0047', 5, 'Lado superior centro', NOW()),
(3, '0288', 2, 'Lado central izquierdo', NOW()),
(8, '0570', 2, 'Lado inferior izquierdo', NOW()),
(4, '0212', 5, 'Lado superior centro', NOW()),
(7, '0284', 5, 'Lado inferior centro', NOW()),
(3, '0366', 8, 'Lado central derecho', NOW()),
(6, '0421', 7, 'Lado inferior izquierdo', NOW()),
(1, '0790', 3, 'Lado superior izquierdo', NOW()),
(9, '0696', 8, 'Lado central centro', NOW()),
(7, '0553', 6, 'Lado superior derecho', NOW()),
(6, '0062', 5, 'Lado superior derecho', NOW()),
(4, '0495', 1, 'Lado inferior derecho', NOW()),
(2, '0942', 2, 'Lado superior izquierdo', NOW()),
(2, '0966', 4, 'Lado superior izquierdo', NOW()),
(3, '0447', 7, 'Lado superior izquierdo', NOW()),
(4, '0589', 5, 'Lado central centro', NOW()),
(9, '0986', 3, 'Lado superior derecho', NOW()),
(6, '0887', 6, 'Lado central centro', NOW()),
(2, '0685', 8, 'Lado inferior izquierdo', NOW()),
(4, '0357', 1, 'Lado superior centro', NOW()),
(9, '0255', 10, 'Lado inferior centro', NOW()),
(10, '0043', 10, 'Lado central derecho', NOW()),
(4, '0124', 3, 'Lado superior derecho', NOW()),
(4, '0357', 8, 'Lado central centro', NOW()),
(5, '0506', 4, 'Lado inferior centro', NOW()),
(1, '0240', 10, 'Lado inferior izquierdo', NOW()),
(1, '0119', 9, 'Lado inferior derecho', NOW()),
(6, '0114', 3, 'Lado inferior derecho', NOW()),
(6, '0217', 5, 'Lado superior izquierdo', NOW()),
(8, '0241', 10, 'Lado superior izquierdo', NOW()),
(6, '0156', 3, 'Lado inferior izquierdo', NOW()),
(10, '0056', 6, 'Lado central centro', NOW()),
(3, '0546', 6, 'Lado inferior derecho', NOW()),
(10, '0417', 5, 'Lado inferior centro', NOW()),
(1, '0082', 3, 'Lado superior centro', NOW()),
(2, '0664', 7, 'Lado inferior derecho', NOW()),
(4, '0843', 5, 'Lado central derecho', NOW()),
(6, '0616', 5, 'Lado inferior centro', NOW()),
(7, '0471', 10, 'Lado superior centro', NOW()),
(1, '0124', 3, 'Lado central centro', NOW()),
(3, '0612', 3, 'Lado inferior centro', NOW()),
(1, '0019', 4, 'Lado central centro', NOW()),
(9, '0834', 10, 'Lado superior derecho', NOW()),
(5, '0605', 4, 'Lado superior derecho', NOW()),
(6, '0511', 8, 'Lado inferior derecho', NOW()),
(10, '0317', 5, 'Lado central centro', NOW()),
(6, '0498', 2, 'Lado inferior derecho', NOW()),
(7, '0081', 8, 'Lado inferior centro', NOW()),
(6, '0231', 6, 'Lado central centro', NOW()),
(6, '0145', 7, 'Lado central izquierdo', NOW()),
(6, '0462', 7, 'Lado inferior centro', NOW()),
(10, '0157', 8, 'Lado superior derecho', NOW()),
(7, '0344', 5, 'Lado central izquierdo', NOW()),
(5, '0953', 2, 'Lado superior izquierdo', NOW()),
(7, '0254', 3, 'Lado inferior izquierdo', NOW()),
(7, '0166', 6, 'Lado central izquierdo', NOW()),
(2, '0776', 5, 'Lado inferior izquierdo', NOW()),
(9, '0073', 5, 'Lado inferior derecho', NOW()),
(8, '0502', 9, 'Lado inferior centro', NOW()),
(3, '0159', 8, 'Lado superior centro', NOW()),
(1, '0804', 5, 'Lado inferior derecho', NOW()),
(4, '0083', 3, 'Lado superior centro', NOW()),
(5, '0122', 5, 'Lado superior centro', NOW()),
(7, '0376', 1, 'Lado inferior izquierdo', NOW()),
(5, '0862', 6, 'Lado superior derecho', NOW()),
(8, '0015', 5, 'Lado superior centro', NOW()),
(5, '0488', 9, 'Lado superior izquierdo', NOW()),
(8, '0751', 7, 'Lado inferior izquierdo', NOW()),
(9, '0261', 4, 'Lado inferior derecho', NOW()),
(1, '0790', 6, 'Lado superior izquierdo', NOW()),
(1, '0024', 2, 'Lado central derecho', NOW()),
(3, '0198', 10, 'Lado superior centro', NOW()),
(4, '0033', 3, 'Lado central derecho', NOW()),
(9, '0958', 7, 'Lado superior centro', NOW()),
(1, '0309', 6, 'Lado superior centro', NOW()),
(8, '0464', 6, 'Lado inferior centro', NOW()),
(4, '0243', 1, 'Lado central izquierdo', NOW()),
(1, '0219', 6, 'Lado central izquierdo', NOW()),
(5, '0546', 2, 'Lado central izquierdo', NOW()),
(8, '0179', 9, 'Lado central centro', NOW()),
(8, '0920', 8, 'Lado inferior izquierdo', NOW()),
(6, '0358', 2, 'Lado superior derecho', NOW()),
(6, '0495', 6, 'Lado central centro', NOW()),
(9, '0893', 2, 'Lado central centro', NOW()),
(6, '0744', 2, 'Lado superior centro', NOW()),
(7, '0984', 7, 'Lado inferior derecho', NOW()),
(3, '0689', 10, 'Lado central derecho', NOW()),
(5, '0973', 5, 'Lado central izquierdo', NOW()),
(8, '0314', 9, 'Lado inferior izquierdo', NOW()),
(5, '0083', 6, 'Lado central izquierdo', NOW()),
(1, '0733', 4, 'Lado inferior derecho', NOW()),
(5, '0308', 9, 'Lado superior centro', NOW()),
(3, '0897', 1, 'Lado inferior derecho', NOW()),
(5, '0910', 4, 'Lado central izquierdo', NOW());

INSERT INTO cocineros(nombres, apellidos, created) VALUES
('Guillermo Yosely', 'Pacheco Carranza', NOW()),
('Elmer Alexander', 'Valencia Escobar', NOW()),
('Miguel Alicia', 'Urbina Oviedo', NOW()),
('Alfredo Iris', 'Martinez Carrillo', NOW()),
('Daniel Edwin', 'Ortega Valencia', NOW());

INSERT INTO categoria_platillos(categoria) VALUES
('Carnes'),
('Pastas'),
('Ensaladas'),
('Pescados y Mariscos'),
('Sopas y Cremas'),
('Postres');

INSERT INTO platillos(categoria_platillo_id, nombre, descripcion, precio, foto, foto_dir, created) VALUES
(1, 'Albondigas Rellenas con Huevo', 'Carne molida empanizada junto con cebolla, ajo, perejil, comino, jenjibre con arroz, ensalada y salsa.', 7.50, 'Albondigas Rellenas con Huevo.jpg', '1', NOW()),
(1, 'Carne a la Plancha', 'Carne en filetes con unas gotitas de salsa inglesa, mostaza, acompañado con chirimol y arroz o casamiento.', 7.00, 'Carne a la Plancha.jpg', '2', NOW()),
(1, 'Pollo con Cerveza', 'Pollo dorado con tomates, cebolla, chile verde, cerveza y arroz', 6.75, 'Pollo con Cerveza.jpg', '3', NOW()),
(1, 'Pollo Empanizado', 'Pechugas de pollo empanizadas con mostaza, sal de ajo, sal y pimienta.', 5.25, 'Pollo Empanizado.jpg', '4', NOW()),
(1, 'Carne Guisada', 'Carne Ggisada con papas, zanahoria, tomates, chile verde, cebolla, cilantro fresco, vino y servido con arroz blanco.', 7.60, 'Carne Guisada.jpg', '5', NOW()),
(1, 'Chuletas de Cerdo Ahumadas con Tomatada', 'Chuletas doradas refrito con tomates, ajos, cebolla, chiles y un chorro de vino.', 8.40, 'Chuletas de Cerdo Ahumadas con Tomatada.jpg', '6', NOW()),
(4, 'Ensalada de Mariscos', 'Atún desmenuzado, Camarones cocidos y picados, aceitunas rellenas, apio picado, curry, mayonesa, salsa inglesa, perejil picado y arroz cocido.', 9.90, 'Ensalada de Mariscos.jpg', '7', NOW()),
(4, 'Lonjas de Pescado al Limón', 'Filete de pescado con jugo de limón decorado con el perejil picado.', 5.80, 'Lonjas de Pescado al Limón.jpg', '8', NOW()),
(4, 'Pescado Frito', 'Pescado dorado servido con ensalada y suficiente limón.', 6.30, 'Pescado Frito.jpg', '9', NOW()),
(5, 'Crema de Ayote', 'Ayote blando en crema sazonado con sal y pimienta.', 4.70, 'Crema de Ayote.jpg', '10', NOW()),
(5, 'Sopa de Mora', 'Hojas de mora con un diente de ajo, cebolla, tomate y chile verde, huevos, pipian en rodajas y ocres acompañada con unas rodajas de limón.', 4.25, 'Sopa de Mora.jpg', '11', NOW()),
(5, 'Sopa de Gallina', 'Gallina grande con tomates picados, chile verde, guisquil verde picado en cuadros pequeños, zanahorias cortadas en cuadros, papas cortadas en cuadros, dientes de ajos, cebollas, 2 cucharadas de arroz, hiervas aromaticas (apio, hierbabuena, cilantro, alcapate y perejil).', 4.00, 'Sopa de Gallina.jpg', '12', NOW()),
(3, 'Pure de Papas', 'Libra de papa con tomatesg randes y maduros, cebolla picada, sazonador de pollo.', 3.00, 'Pure de Papas.jpg', '13', NOW()),
(3, 'Ensalada de Palitos de Cangrejo y Pepino', 'Media libra de palitos de cangrejo, maíz en lata, cilantro finamente picado, mayonesa, pepinos, sal y pimienta y cebolla finamente picada.', 3.50, 'Ensalada de Palitos de Cangrejo y Pepino.jpg', '14', NOW()),
(3, 'Guacamole', 'Pasta de aguacates picados con tomate, ajo, cilantro, cebolla, jugo de limón, aceite de oliva, sal y pimienta.', 2.25, 'Guacamole.jpg', '15', NOW()),
(2, 'Fettuccini a la Crema', 'Fettuccini con lascas de tocino picado, mantequilla, crema agria, sal y pimienta.', 6.40, 'Fettuccini a la Crema.jpg', '16', NOW()),
(2, 'Lasaña de Carne', 'Lasaña con aalsa de carne o boloñesa, salsa bechamel y queso rallado.', 6.50, 'Lasaña de Carne.jpg', '17', NOW()),
(6, 'Arroz en Leche', 'Arroz blanco corriente, leche, azucar, rajas de canela, vainilla, sal, canela molida y pasas.', 2.00, 'Arroz en Leche.jpg', '18', NOW()),
(6, 'Nuegados de Yuca', 'Yuca grande cortada en cuadros con huevos y queso duro rallado.', 2.00, 'Nuegados de Yuca.jpg', '19', NOW()),
(6, 'Flan de Elote', 'Maíz tierno, azucar, yemas de huevo, leche, leche condensada.', 1.75, 'Flan de Elote.jpg', '20', NOW());

INSERT INTO cocineros_platillos(cocinero_id, platillo_id) VALUES
(4, 17),
(4, 7),
(1, 12),
(5, 10),
(1, 2),
(2, 15),
(2, 2),
(2, 9),
(4, 6),
(2, 12),
(4, 14),
(4, 4),
(5, 7),
(5, 11),
(5, 2),
(2, 7),
(2, 1),
(1, 15),
(5, 14),
(4, 19),
(3, 11),
(4, 14),
(5, 10),
(4, 19),
(5, 6),
(1, 17),
(5, 6),
(3, 1),
(2, 9),
(4, 5),
(1, 2),
(1, 3),
(1, 17),
(2, 16),
(1, 13),
(5, 20),
(5, 10),
(4, 2),
(3, 1),
(2, 7),
(3, 1),
(3, 16),
(4, 15),
(1, 17),
(1, 5),
(3, 19),
(3, 9),
(2, 9),
(5, 20),
(2, 8);

INSERT INTO pedidos(platillo_id, cantidad, subtotal, created) VALUES
(19, 3, '6.00', NOW()),
(7, 2, '19.80', NOW()),
(15, 2, '4.50', NOW());

INSERT INTO ordenes( mesa_id, total, cliente, dui, created) VALUES
(14, '22.30', 'Javier Galdámez', '326598741', NOW()),
(41, '52.60', 'Tito Miguel', '124578301', NOW());

INSERT INTO platillos_ordenes(platillo_id, orden_id, cantidad, subtotal, created) VALUES
(16, 1, 1, '6.40', NOW()),
(1, 1, 1, '7.50', NOW()),
(6, 1, 1, '8.40', NOW()),
(20, 2, 6, '10.50', NOW()),
(5, 2, 3, '22.80', NOW()),
(8, 2, 1, '5.80', NOW()),
(3, 2, 2, '13.50', NOW());
