-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.41


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Base de datos: `ci_googlemaps_mysql`
--

DROP DATABASE IF EXISTS ci_googlemaps_mysql;
-- -------------------------------------------------------------------------------------
CREATE DATABASE ci_googlemaps_mysql DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE ci_googlemaps_mysql;

-- --------------------------------------------------------

--
-- Definition of table `mapa`
--

DROP TABLE IF EXISTS `mapa`;
CREATE TABLE `mapa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `imagen` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapa`
--

/*!40000 ALTER TABLE `mapa` DISABLE KEYS */;
INSERT INTO `mapa` (`id`,`nombre`,`direccion`,`lat`,`lng`,`tipo`,`imagen`) VALUES 
 (4,'Acapulco','Gerrero, Mexico',16.972740,-99.843750,NULL,NULL),
 (2,'Ciudad de Mexico',NULL,19.394068,-99.184570,NULL,NULL),
 (3,'Yucatan','Mexico',20.344627,-88.681641,NULL,NULL),
 (5,'Chihuahua','Mexico',28.613459,-106.171875,NULL,NULL),
 (6,'Oaxaca','Mexico',17.014769,-96.635742,NULL,NULL);
/*!40000 ALTER TABLE `mapa` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
