-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-06-2024 a las 16:21:52
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

DROP TABLE IF EXISTS `barrios`;
CREATE TABLE IF NOT EXISTS `barrios` (
  `idBarrio` int(11) NOT NULL AUTO_INCREMENT,
  `codBarrio` varchar(20) NOT NULL,
  `barrio` varchar(50) NOT NULL,
  `tipoBarrio` varchar(20) NOT NULL,
  `distrito` varchar(20) NOT NULL,
  PRIMARY KEY (`idBarrio`),
  UNIQUE KEY `codBarrio` (`codBarrio`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `barrios`
--

INSERT INTO `barrios` (`idBarrio`, `codBarrio`, `barrio`, `tipoBarrio`, `distrito`) VALUES
(1, '001LIP01', 'LIPULULO', 'BARRIO', 'U001'),
(2, '002SAN01', 'SANTA CLARA', 'BARRIO', 'U001'),
(3, '003LLA01', 'LLANO DE LA CRUZ', 'BARRIO', 'U001'),
(4, '004ELI01', 'EL LIMON', 'BARRIO', 'U001'),
(5, '005LTR01', 'LAS TRINCHERAS', 'BARRIO', 'U001'),
(6, '006LCO01', 'LAS CONCHITAS', 'BARRIO', 'U001'),
(7, '007PUL01', 'PUERTO LOCO', 'BARRIO', 'U001'),
(8, '008EPO01', 'EL PORTILLO', 'BARRIO', 'U001'),
(9, '009BOM01', 'BOCA DEL MONTE', 'BARRIO', 'U001'),
(10, '010LAG01', 'LA LAGUNA', 'BARRIO', 'U001'),
(11, '011BSA02', 'B. SANDINO', 'BARRIO', 'U002'),
(12, '012BGR02', 'B. GRACIAS A DIOS', 'BARRIO', 'U002'),
(13, '013VVA02', 'VILLA VALENCIA', 'BARRIO', 'U002'),
(14, '014BML02', 'B. MOISES LOPEZ', 'BARRIO', 'U002'),
(15, '015BSA02', 'B. SAN ANTONIO', 'BARRIO', 'U002'),
(16, '016BCR02', 'B. CARLOS RIZO', 'BARRIO', 'U002'),
(17, '017BCO02', 'B. CAMILO ORTEGA', 'BARRIO', 'U002'),
(18, '018BJN02', 'B. 19 DE JULIO', 'BARRIO', 'U002'),
(19, '019VNO02', 'VILLA NORTE', 'BARRIO', 'U002'),
(20, '020CPE02', 'COLONIA PEDRO ESTRADA', 'BARRIO', 'U002'),
(21, '021BAR02', 'B. ALEJANDRO RAMOS', 'BARRIO', 'U002'),
(22, '022BER03', 'B. ERNESTO ROSALES', 'BARRIO', 'U003'),
(23, '023BJR03', 'B. JUAN RAMON COREA', 'BARRIO', 'U003'),
(24, '024BCA03', 'B. CENTRO AMERICA', 'BARRIO', 'U003'),
(25, '025VLI03', 'VILLA LIBERTAD', 'BARRIO', 'U003'),
(26, '026BSZ03', 'B. SANTIAGO ZELEDON', 'BARRIO', 'U003'),
(27, '027BAL03', 'B. ALFREDO ALEGRIA', 'BARRIO', 'U003'),
(28, '028PLV03', 'PROYECTO LINDA VISTA', 'BARRIO', 'U003'),
(29, '029BCN03', 'B. CARLOS NUNEZ', 'BARRIO', 'U003'),
(30, '030BRH03', 'B. ROGER HAMGUIEN I Y II ETAPA', 'BARRIO', 'U003'),
(31, '031LTC03', 'LAS TRES CRUCES', 'BARRIO', 'U003'),
(32, '032BJM03', 'B. 20 DE MAYO', 'BARRIO', 'U003'),
(33, '033BDT03', 'B. DANIEL TELLER', 'BARRIO', 'U003'),
(34, '034BLA03', 'B. LOS ANGELES', 'BARRIO', 'U003'),
(35, '035BEJ03', 'B. EL JOCOTE', 'BARRIO', 'U003'),
(36, '036BSC03', 'B. SAN CRISTOBAL', 'BARRIO', 'U003'),
(37, '037BBZ03', 'B. BENJAMIN ZELEDON', 'BARRIO', 'U003'),
(38, '038BPA03', 'B. PANORAMA', 'BARRIO', 'U003'),
(39, '039BLV03', 'B. LINDA VISTA SUR', 'BARRIO', 'U003'),
(40, '040PAL03', 'PALMIRA', 'BARRIO', 'U003'),
(41, '041ELI04', 'EL LIMITO', 'BARRIO', 'U004'),
(42, '042BPI04', 'LOS PINOS', 'BARRIO', 'U004'),
(43, '043FDP04', 'FLOR DE PINO', 'BARRIO', 'U004'),
(44, '044EOC04', 'EL OCOTALILLO', 'BARRIO', 'U004'),
(45, '045CES04', 'CUATRO ESQUINAS', 'BARRIO', 'U004'),
(46, '046LCH04', 'LOS CHAGUITES', 'BARRIO', 'U004'),
(47, '047EJO04', 'EL JOBO', 'BARRIO', 'U004'),
(48, '048LTE04', 'LA TEJERA', 'BARRIO', 'U004'),
(49, '049EGU05', 'EL GUANACASTE', 'BARRIO', 'U005'),
(50, '050LMO05', 'LA MONTANITA', 'BARRIO', 'U005'),
(51, '051BMA05', 'B. MAURICIO ALTAMIRANO', 'BARRIO', 'U005'),
(52, '052BSI05', 'B. SAN ISIDRO - LA CURVA', 'BARRIO', 'U005'),
(53, '053LME05', 'LAS MESITAS', 'BARRIO', 'U005'),
(54, '054LCA05', 'LA CAL', 'BARRIO', 'U005'),
(55, '055BOG05', 'B. OMAR GARCIA', 'BARRIO', 'U005'),
(56, '056BGP06', 'B. GERMAN POMARES', 'BARRIO', 'U006'),
(57, '057VLC06', 'VILLA LA CRUZ', 'BARRIO', 'U006'),
(58, '058EOC06', 'EL OCOTALILLO - CERRO LA CRUZ', 'BARRIO', 'U006'),
(59, '059PLC06', 'PENA LA CRUZ', 'BARRIO', 'U006'),
(60, '060SFC07', 'SAN FRANCISCO DE LOS CEDROS', 'COMUNIDAD', 'R001'),
(61, '061A1207', 'ASTURIAS 1 Y 2', 'COMUNIDAD', 'R001'),
(62, '062MON07', 'MONTERREY', 'COMUNIDAD', 'R001'),
(63, '063LVA07', 'LA VIRGEN 1 Y 2', 'COMUNIDAD', 'R001'),
(64, '064ALP07', 'LOS ALPES', 'COMUNIDAD', 'R001'),
(65, '065SEL07', 'SANTA ELENA', 'COMUNIDAD', 'R001'),
(66, '066SEN07', 'SAN ENRIQUE', 'COMUNIDAD', 'R001'),
(67, '067SIS07', 'SAN ISIDRO', 'COMUNIDAD', 'R001'),
(68, '068EDI07', 'EL DIAMANTE', 'COMUNIDAD', 'R001'),
(69, '069LES07', 'LA ESPERANZA', 'COMUNIDAD', 'R001'),
(70, '070EPO07', 'EL POTRERILLOS', 'COMUNIDAD', 'R001'),
(71, '071EDO07', 'EL DORADO', 'COMUNIDAD', 'R001'),
(72, '072LCU07', 'LAS CUCHILLAS', 'COMUNIDAD', 'R001'),
(73, '073SJO07', 'SAN JOSE', 'COMUNIDAD', 'R001'),
(74, '074LCE07', 'LA CEIBA', 'COMUNIDAD', 'R001'),
(75, '075LFL07', 'LA FLOR', 'COMUNIDAD', 'R001'),
(76, '076SDO07', 'SANTO DOMINGO', 'COMUNIDAD', 'R001'),
(77, '077ESA08', 'EL SARDINAL', 'COMUNIDAD', 'R002'),
(78, '078EES08', 'EL ESCAMBRAY', 'COMUNIDAD', 'R002'),
(79, '079MON08', 'MONTECRISTO', 'COMUNIDAD', 'R002'),
(80, '080SIS08', 'SANTA ISABEL', 'COMUNIDAD', 'R002'),
(81, '081LSP08', 'LA SORPRESA', 'COMUNIDAD', 'R002'),
(82, '082LDC08', 'LOS CERRONES 1 Y 2', 'COMUNIDAD', 'R002'),
(83, '083LAM08', 'LAS AMERICAS', 'COMUNIDAD', 'R002'),
(84, '084LPL08', 'LA PERLITA', 'COMUNIDAD', 'R002'),
(85, '085LPA08', 'LAS PARCERLAS', 'COMUNIDAD', 'R002'),
(86, '086LSA08', 'EL SARAYAL', 'COMUNIDAD', 'R002'),
(87, '087LCO08', 'EL CONSUELO', 'COMUNIDAD', 'R002'),
(88, '088SIS08', 'SAN ISIDRO', 'COMUNIDAD', 'R002'),
(89, '089SAD08', 'SAN ANDRES', 'COMUNIDAD', 'R002'),
(90, '090CEA08', 'COOPERATIVA ERNESTO ACUNA', 'COMUNIDAD', 'R002'),
(91, '091LBR08', 'LAS BRISAS', 'COMUNIDAD', 'R002'),
(92, '092STE08', 'SANTA TERESITA', 'COMUNIDAD', 'R002'),
(93, '093LPT08', 'LA PAZ DEL TUMA', 'COMUNIDAD', 'R002'),
(94, '094JIG09', 'JIGUINA', 'COMUNIDAD', 'R003'),
(95, '095DAT09', 'DATANLI', 'COMUNIDAD', 'R003'),
(96, '096PNU09', 'PUEBLO NUEVO', 'COMUNIDAD', 'R003'),
(97, '097STE09', 'SANTA TERESITA', 'COMUNIDAD', 'R003'),
(98, '098GOL09', 'EL GOBIADO - COOPERATIVA LINA HERRERA', 'COMUNIDAD', 'R003'),
(99, '099LTR09', 'LA TRAMPA', 'COMUNIDAD', 'R003'),
(100, '100RAY09', 'RAYCERO', 'COMUNIDAD', 'R003'),
(101, '101APQ09', 'APAQUILA 1 Y 2', 'COMUNIDAD', 'R003'),
(102, '102LRO09', 'LOS ROBLES', 'COMUNIDAD', 'R003'),
(103, '103LLA09', 'LAS LAJAS', 'COMUNIDAD', 'R003'),
(104, '104SAL09', 'EL SALTO', 'COMUNIDAD', 'R003'),
(105, '105CUY09', 'CUYALI', 'COMUNIDAD', 'R003'),
(106, '106SGE09', 'SANTA GERTRUDIS', 'COMUNIDAD', 'R003'),
(107, '107SMA09', 'SANTA MAURA', 'COMUNIDAD', 'R003'),
(108, '108CFI09', 'CORINTO FINCA', 'COMUNIDAD', 'R003'),
(109, '109BRO09', 'BARRO 1', 'COMUNIDAD', 'R003'),
(110, '110SES09', 'SAN ESTEBAN', 'COMUNIDAD', 'R003'),
(111, '111LME10', 'LAS MERCEDES', 'COMUNIDAD', 'R004'),
(112, '112LSU10', 'LA SULTANA', 'COMUNIDAD', 'R004'),
(113, '113LLA10', 'LAS LATAS', 'COMUNIDAD', 'R004'),
(114, '114PAL10', 'PALESTINA', 'COMUNIDAD', 'R004'),
(115, '115CJR10', 'COOPERATIVA JUAN RAMON COREA', 'COMUNIDAD', 'R004'),
(116, '116CLT10', 'COOPERATIVA LAZARO TALAVERA', 'COMUNIDAD', 'R004'),
(117, '117SLA10', 'SANTA LASTENIA', 'COMUNIDAD', 'R004'),
(118, '118LBA10', 'LAS BANQUITAS', 'COMUNIDAD', 'R004'),
(119, '119SPA10', 'SANTOS PALACIOS', 'COMUNIDAD', 'R004'),
(120, '120SEN10', 'SANTA ENRIQUETA', 'COMUNIDAD', 'R004'),
(121, '121PBL10', 'PALO BLANCO', 'COMUNIDAD', 'R004'),
(122, '122LFD10', 'LA FUNDADORA', 'COMUNIDAD', 'R004'),
(123, '123LPR10', 'LA PARRANDA', 'COMUNIDAD', 'R004'),
(124, '124ELI10', 'EL LIMON', 'COMUNIDAD', 'R004'),
(125, '125LMS10', 'LA MASCOTA', 'COMUNIDAD', 'R004'),
(126, '126LEM10', 'LA ESMERALDA', 'COMUNIDAD', 'R004'),
(127, '127LDO10', 'LAS DOLORES', 'COMUNIDAD', 'R004'),
(128, '128CES10', 'CUATRO ESQUINAS', 'COMUNIDAD', 'R004'),
(129, '129LCA10', 'LAS CAMELIAS', 'COMUNIDAD', 'R004'),
(130, '130ECH10', 'EL CHIMBORAZO', 'COMUNIDAD', 'R004'),
(131, '131SCA10', 'SANTA CARMELA', 'COMUNIDAD', 'R004'),
(132, '132LLM11', 'LAS LOMAS', 'COMUNIDAD', 'R005'),
(133, '133YAG11', 'YAGUALICA', 'COMUNIDAD', 'R005'),
(134, '134STA11', 'SANTA ANA', 'COMUNIDAD', 'R005'),
(135, '135ESL11', 'EL SALTO', 'COMUNIDAD', 'R005'),
(136, '136ENA11', 'EL NARANJO', 'COMUNIDAD', 'R005'),
(137, '137CAL11', 'LOS CALPULES', 'COMUNIDAD', 'R005'),
(138, '138TOM11', 'TOMATOYA', 'COMUNIDAD', 'R005'),
(139, '139LJO11', 'LA JOYA', 'COMUNIDAD', 'R005'),
(140, '140LCU11', 'LAS CURENAS', 'COMUNIDAD', 'R005'),
(141, '141ECA11', 'EL CACAO', 'COMUNIDAD', 'R005'),
(142, '142PHU11', 'PITA DEL HORNO', 'COMUNIDAD', 'R005'),
(143, '143SJH11', 'SAN JOSE HUMURE', 'COMUNIDAD', 'R005'),
(144, '144JOC11', 'JOCOMICO', 'COMUNIDAD', 'R005'),
(145, '145ELI11', 'EL LIMON', 'COMUNIDAD', 'R005'),
(146, '146LNN11', 'LOMA DEL NANCE', 'COMUNIDAD', 'R005'),
(147, '147EHA11', 'EL HATILLO', 'COMUNIDAD', 'R005'),
(148, '148ETA11', 'EL TANQUE', 'COMUNIDAD', 'R005'),
(149, '149LRL11', 'RICON LARGO', 'COMUNIDAD', 'R005'),
(150, '150WAL11', 'WALASA', 'COMUNIDAD', 'R005'),
(151, '151MJA12', 'EL MOJON ARRIBA', 'COMUNIDAD', 'R006'),
(152, '152MJB12', 'EL MOJON ABAJO', 'COMUNIDAD', 'R006'),
(153, '153PRE12', 'PASO REAL', 'COMUNIDAD', 'R006'),
(154, '154CGA12', 'CHAGUITE GRANDE ARRIBA', 'COMUNIDAD', 'R006'),
(155, '155SAS12', 'SASLE 1', 'COMUNIDAD', 'R006'),
(156, '156MAC12', 'MANCOTAL ARRIBA', 'COMUNIDAD', 'R006'),
(157, '157MAB12', 'MANCOTAL ABAJO', 'COMUNIDAD', 'R006'),
(158, '158YAN12', 'YANKEE', 'COMUNIDAD', 'R006'),
(159, '159ANI12', 'ANITA', 'COMUNIDAD', 'R006'),
(160, '160CAG12', 'CERRO DE AGUA', 'COMUNIDAD', 'R006'),
(161, '161SGR12', 'SAN GREGORIO', 'COMUNIDAD', 'R006'),
(162, '162LAN12', 'LOS ANGELES', 'COMUNIDAD', 'R006'),
(163, '163NAN12', 'LA NARANJA', 'COMUNIDAD', 'R006'),
(164, '164SAS12', 'SASLE', 'COMUNIDAD', 'R006'),
(165, '165TMY12', 'TOMAYUNCA', 'COMUNIDAD', 'R006'),
(166, '166REF12', 'LA REFORMA', 'COMUNIDAD', 'R006'),
(167, '167ALQ12', 'ANTIOQUIA (LAS QUEBRADAS)', 'COMUNIDAD', 'R006'),
(168, '168SAS12', 'SAN ANTONIO DE SISLE', 'COMUNIDAD', 'R006'),
(169, '169SSI12', 'SISLE 2', 'COMUNIDAD', 'R006'),
(170, '170CGA12', 'CHAGUITE GRANDE ABAJO', 'COMUNIDAD', 'R006');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(1) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `categoria`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cementerios`
--

DROP TABLE IF EXISTS `cementerios`;
CREATE TABLE IF NOT EXISTS `cementerios` (
  `idCementerio` int(11) NOT NULL AUTO_INCREMENT,
  `cementerio` varchar(20) NOT NULL,
  PRIMARY KEY (`idCementerio`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cementerios`
--

INSERT INTO `cementerios` (`idCementerio`, `cementerio`) VALUES
(1, 'NUEVO'),
(2, 'VIEJO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

DROP TABLE IF EXISTS `cuotas`;
CREATE TABLE IF NOT EXISTS `cuotas` (
  `idCuota` int(11) NOT NULL AUTO_INCREMENT,
  `idPago` int(11) NOT NULL,
  `fecCuota` date NOT NULL,
  `montoCuota` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idCuota`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`idCuota`, `idPago`, `fecCuota`, `montoCuota`) VALUES
(1, 3, '2024-05-06', '300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudos`
--

DROP TABLE IF EXISTS `deudos`;
CREATE TABLE IF NOT EXISTS `deudos` (
  `idDeudo` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) NOT NULL,
  `nomDeudo` varchar(100) NOT NULL,
  `sexo` enum('F','M') NOT NULL,
  `fecDefuncion` date NOT NULL,
  `codLote` varchar(20) NOT NULL,
  PRIMARY KEY (`idDeudo`),
  KEY `codigo_lote` (`codLote`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudos`
--

INSERT INTO `deudos` (`idDeudo`, `cedula`, `nomDeudo`, `sexo`, `fecDefuncion`, `codLote`) VALUES
(1, '001-190745-0001Q', 'SOFIA JIMENEZ', 'M', '1965-07-12', 'CV8890'),
(2, '242-221061-0005A', 'ALEJANDRO TORRES', 'F', '1980-04-25', 'CV1020'),
(3, '241-220641-0008Z', 'DANIEL GOMEZ', 'F', '1998-11-15', 'CN0151'),
(4, '241-150184-0020R', 'GABRIELA FLORES', 'M', '1958-03-28', 'CV4081'),
(5, 'N/A', 'MARTIN DIAZ', 'F', '1955-08-19', 'CV4081'),
(6, '241-220369-0006H', 'TERESA VALVERDE', 'M', '1990-12-06', 'CV4081');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

DROP TABLE IF EXISTS `distritos`;
CREATE TABLE IF NOT EXISTS `distritos` (
  `idDistrito` int(11) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(30) NOT NULL,
  PRIMARY KEY (`idDistrito`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`idDistrito`, `distrito`) VALUES
(1, 'U001'),
(2, 'U002'),
(3, 'U003'),
(4, 'U004'),
(5, 'U005'),
(6, 'R001'),
(7, 'R002'),
(8, 'R003'),
(9, 'R004'),
(10, 'R005');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fierros`
--

DROP TABLE IF EXISTS `fierros`;
CREATE TABLE IF NOT EXISTS `fierros` (
  `codFinca` varchar(10) NOT NULL,
  `comunidad` varchar(100) DEFAULT NULL,
  `fecRegistro` date DEFAULT NULL,
  `estadoFierro` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  PRIMARY KEY (`codFinca`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fierros`
--

INSERT INTO `fierros` (`codFinca`, `comunidad`, `fecRegistro`, `estadoFierro`) VALUES
('9874', 'SASLE 1', '2024-05-06', 'ACTIVO'),
('1152', 'LAS LOMAS', '2024-05-06', 'INACTIVO'),
('9156', 'PUEBLO NUEVO', '2024-05-02', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ibi`
--

DROP TABLE IF EXISTS `ibi`;
CREATE TABLE IF NOT EXISTS `ibi` (
  `codIBI` int(11) NOT NULL AUTO_INCREMENT,
  `codCatastral` varchar(30) NOT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `finca` varchar(100) DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  `tomo` int(11) DEFAULT NULL,
  `asiento` int(11) DEFAULT NULL,
  `valorCatastral` decimal(10,2) NOT NULL,
  `construccion` varchar(50) DEFAULT NULL,
  `estadoIBI` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  PRIMARY KEY (`codIBI`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ibi`
--

INSERT INTO `ibi` (`codIBI`, `codCatastral`, `ubicacion`, `finca`, `folio`, `tomo`, `asiento`, `valorCatastral`, `construccion`, `estadoIBI`) VALUES
(1, '0604U003043014', 'ESQUINA SUR-ESTE DEL C/S BUENA VIDA', 'Finca 1', 1, 1, 1, '100000.00', 'CASA', 'ACTIVO'),
(2, '0604U000012455', 'FRENTE AL PUENTE LOS ENAMORADOS', 'Finca 2', 2, 2, 2, '150000.00', 'CASA', 'ACTIVO'),
(3, '0604R330006971', 'COLEGIO RUBEN DARIO, 50 VRS SUR', 'Finca 3', 3, 3, 3, '120000.00', 'BODEGA', 'ACTIVO'),
(4, '0604R410002950', 'SILAIS, 2C, AL OESTE, 20 VRS. NORTE', 'Finca 4', 4, 4, 4, '200000.00', 'LOTE VALDIO', 'ACTIVO'),
(5, '0604U233007982', 'IGLESIA RESTAURACION, 50 VRS. ESTE', 'Finca 5', 5, 5, 5, '180000.00', 'CASA', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

DROP TABLE IF EXISTS `lotes`;
CREATE TABLE IF NOT EXISTS `lotes` (
  `codLote` varchar(20) NOT NULL,
  `cementerio` enum('VIEJO','NUEVO') NOT NULL,
  `sector` varchar(20) NOT NULL,
  `categoria` enum('A','B','C') DEFAULT NULL,
  `fecRegistro` date DEFAULT NULL,
  `medidas` varchar(50) DEFAULT NULL,
  `lindeNorte` varchar(100) DEFAULT NULL,
  `lindeSur` varchar(100) DEFAULT NULL,
  `lindeEste` varchar(100) DEFAULT NULL,
  `lindeOeste` varchar(100) DEFAULT NULL,
  `estadoLote` enum('LIBRE','OCUPADO') DEFAULT NULL,
  PRIMARY KEY (`codLote`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`codLote`, `cementerio`, `sector`, `categoria`, `fecRegistro`, `medidas`, `lindeNorte`, `lindeSur`, `lindeEste`, `lindeOeste`, `estadoLote`) VALUES
('CV8890', 'VIEJO', 'NORTE', 'A', '2024-05-06', '1.5x2.5m', 'Calle', 'Callejon', 'CV8891', 'CV8889', 'OCUPADO'),
('CV1020', 'VIEJO', 'NORTE', 'B', '2024-05-06', '1.5x2.0m', 'CV1005', 'CV2006', 'CV1019', 'CV1021', 'OCUPADO'),
('CV3055', 'VIEJO', 'SUR', 'C', '2024-05-06', '2.5x25m', 'Callejon', 'Rio', 'CV3054', 'CV3056', 'LIBRE'),
('CN0151', 'NUEVO', 'SUR-ESTE', 'A', '2024-05-06', '1.0 x2.0m', 'Cerro', 'Predio', 'Calle', 'CN0150', 'OCUPADO'),
('CV4081', 'VIEJO', 'OESTE', 'B', '2024-05-06', '1.5x2.0m', 'CV4208', 'CV41109', 'CV4080', 'CV4082', 'OCUPADO'),
('CN1020', 'NUEVO', 'NORTE', 'C', '2024-06-19', '2M X 3M', 'Callejon', 'Callejon', 'Terreno en espera', 'Terreno en espera', 'OCUPADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

DROP TABLE IF EXISTS `multas`;
CREATE TABLE IF NOT EXISTS `multas` (
  `idMulta` int(11) NOT NULL AUTO_INCREMENT,
  `idPago` int(11) DEFAULT NULL,
  `fecMulta` date DEFAULT NULL,
  `montoMulta` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idMulta`),
  KEY `id_pago` (`idPago`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `multas`
--

INSERT INTO `multas` (`idMulta`, `idPago`, `fecMulta`, `montoMulta`) VALUES
(1, 2, '2024-05-07', '50.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `idPago` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(30) NOT NULL,
  `idTributo` int(11) NOT NULL,
  `fecPago` date NOT NULL,
  `montoPago` decimal(10,2) NOT NULL,
  `anioPago` int(11) DEFAULT NULL,
  `mesPago` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPago`),
  KEY `cedula_contribuyente` (`identificacion`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPago`, `identificacion`, `idTributo`, `fecPago`, `montoPago`, `anioPago`, `mesPago`) VALUES
(1, '241-092888-0002F', 4, '2024-05-06', '1500.00', 2024, NULL),
(2, '401-071690-0002Q', 14, '2024-05-07', '200.00', 2024, NULL),
(3, '241-052782-0001C', 1, '2024-05-08', '1250.00', 2023, NULL),
(4, '241-061483-0001M', 5, '2024-05-09', '700.00', 2024, NULL),
(5, '242-073079-0009P', 12, '2024-05-10', '100.00', 2024, NULL),
(6, '241-052782-0001C', 2, '2024-05-07', '850.00', 2023, NULL),
(7, '001-111190-0004A', 15, '2024-05-08', '250.00', 2024, NULL),
(8, '241-052782-0001C', 3, '2024-05-06', '1500.00', 2023, NULL),
(9, '241-061483-0001M', 10, '2024-05-07', '450.00', 2024, 2),
(10, '241-040381-0001G', 11, '2024-05-06', '300.00', 2022, NULL),
(12, '241-061483-0001M', 9, '2024-05-02', '70.00', 2024, 2),
(13, '241-061483-0001M', 5, '2024-05-08', '900.00', 2023, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

DROP TABLE IF EXISTS `parametros`;
CREATE TABLE IF NOT EXISTS `parametros` (
  `parametro` varchar(30) NOT NULL,
  `fecha1` date NOT NULL,
  `fecha2` date DEFAULT NULL,
  `porcentaje` float(3,2) NOT NULL,
  PRIMARY KEY (`parametro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`parametro`, `fecha1`, `fecha2`, `porcentaje`) VALUES
('IBI', '2024-01-01', '2024-03-31', 0.10),
('TAD', '2024-01-15', '2024-03-01', 0.05),
('CEMENTERIO', '2024-01-01', '2024-03-31', 0.05),
('FIERRO', '2024-01-01', '2024-01-31', 0.05),
('PARAM_X', '2024-01-01', '2024-01-31', 0.08);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

DROP TABLE IF EXISTS `sectores`;
CREATE TABLE IF NOT EXISTS `sectores` (
  `idSector` int(11) NOT NULL AUTO_INCREMENT,
  `sector` varchar(20) NOT NULL,
  PRIMARY KEY (`idSector`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`idSector`, `sector`) VALUES
(1, 'NORTE'),
(2, 'SUR'),
(3, 'ESTE'),
(4, 'OESTE'),
(5, 'NOR-ESTE'),
(6, 'NOR-OESTE'),
(7, 'SUR-ESTE'),
(8, 'SUR-OESTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ta`
--

DROP TABLE IF EXISTS `ta`;
CREATE TABLE IF NOT EXISTS `ta` (
  `codTA` int(11) NOT NULL AUTO_INCREMENT,
  `codCatastral` varchar(30) DEFAULT NULL,
  `tipoTA` enum('URBANO','RURAL') DEFAULT NULL,
  `estadoTA` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`codTA`),
  KEY `codigo_catastral` (`codCatastral`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ta`
--

INSERT INTO `ta` (`codTA`, `codCatastral`, `tipoTA`, `estadoTA`) VALUES
(1, '0604U000012455', 'URBANO', 'ACTIVO'),
(2, '0604U003043014', 'URBANO', 'ACTIVO'),
(3, '0604R330006971', 'URBANO', 'ACTIVO'),
(4, '0604R410002950', 'RURAL', 'INACTIVO'),
(5, '0604U233007982', 'URBANO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tributos`
--

DROP TABLE IF EXISTS `tributos`;
CREATE TABLE IF NOT EXISTS `tributos` (
  `idTributo` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(20) DEFAULT NULL,
  `tipoEntidad` enum('IBI','TA','LOTE','FIERRO') DEFAULT NULL,
  `codEntidad` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTributo`),
  KEY `cedula_contribuyente` (`identificacion`),
  KEY `codigo_entidad` (`codEntidad`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tributos`
--

INSERT INTO `tributos` (`idTributo`, `identificacion`, `tipoEntidad`, `codEntidad`) VALUES
(1, '241-151090-0002C', 'IBI', '1'),
(2, '241-151090-0002C', 'IBI', '2'),
(3, '241-151090-0002C', 'IBI', '3'),
(4, '241-201076-0000P', 'IBI', '4'),
(5, '001-291275-0008Q', 'IBI', '5'),
(6, '241-151090-0002C', 'TA', '1'),
(7, '241-151090-0002C', 'TA', '2'),
(8, '241-151090-0002C', 'TA', '3'),
(9, '001-291275-0008Q', 'TA', '5'),
(10, '001-150855-0023S', 'LOTE', 'CV8890'),
(11, '241-151088-0000L', 'LOTE', 'CV1020'),
(12, '001-291275-0008Q', 'LOTE', 'CN0151'),
(13, '241-151155-0000G', 'FIERRO', '9874'),
(14, '123', 'FIERRO', '1152'),
(15, '001-150855-0023S', 'LOTE', 'CV4081'),
(16, '241-201076-0000P', 'FIERRO', '9156'),
(19, '241-151090-0002C', 'LOTE', 'CN1020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `nombre1` varchar(100) NOT NULL,
  `nombre2` varchar(30) DEFAULT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `celular` varchar(30) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estado` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `password`, `rol`, `identificacion`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `email`, `celular`, `direccion`, `estado`) VALUES
(23, 'THOMACHAMPA', '$2b$12$5i6xW5GCW9qopJHqtBahte.2K0ZMDER8FEA8YHg3epF.eYPeTtIIO', 'CONTRIBUYENTE', '001-150855-0023S', 'THOMAS', NULL, 'OCHAMPA', NULL, 'THOMASCHAMPA55@GMAIL.COM', '7589-2263', 'LEON', 'A'),
(2, 'AUXREGISTRO', '$2b$12$fCKcf1YckVaPp/78IsryAu6kSkS0S/1aUFVvPll.No1sr292zOdAS', 'REGISTRO', '241-050985-0001C', 'ANA', 'MARIA', 'ALTAMIRANO', NULL, 'ANAMALT92@YAHOO.ES', '8590-4427', 'JINOTEGA', 'A'),
(4, 'RESPFIERROS', '$2b$12$xCAZ13/Hzh3skoVlUv8rfOmrptsVctai6yR8MzyBqmyLWmIeP5r.i', 'FIERROS', '123-190585-0001R', 'ROBERTO', 'JOSE', 'CLEMENTE', 'GUIDO', 'GUIDOCROBERTJ1@GMAIL.COM', '5484-7166', 'JINOTEGA', 'A'),
(3, 'RESPCEMENTERIO', '$2b$12$Kfluari1c1Y.BX397Qv1TO/vMC5CIc3kUJebkksCKdZtvbjd2axbm', 'CEMENTERIO', '241-251000-0015W', 'MARIA', 'GUADALUPE', 'ROSALES', 'PARRALES', 'MARIAGROSALESPARR00@HOTMAIL.COM', '8590-8715', 'SAN RAFAEL DEL NORTE', 'A'),
(24, 'ROGERBLANDON', '$2b$12$4.N.FyaLmGMg5UexV28LKemLIy.V9qdhVjVjQPkRHZ8Vzx0hkikuy', 'CONTRIBUYENTE', '241-201076-0000P', 'ROGER', 'JOSE', 'BLANDON', '', 'ROGERBLANDON1076@GMAIL.COM', '7895-1020', 'JINOTEGA', 'A'),
(1, 'JAIRO', '$2b$12$Wfw3gHgI74.pB6RjOgA7s.uNKgkruraKA/Co0tQ6pU2G1S/hwWVq.', 'ADMINISTRADOR', '241-281172-0005N', 'JAIRO', 'ANTONIO', 'LAGUNA', 'CASTILLO', 'JAIROLAGUNA@GMAIL.COM', '8825-2163', 'JINOTEGA, JINOTEGA', 'A'),
(19, 'JUANPEREZ', '$2b$12$sBE/u1fNA4mNNDXadk7lNuNo9W43bo9o6owe3P8YJ67litvsn1UM.', 'CONTRIBUYENTE', '241-151090-0002C', 'JUAN', 'CARLOS', 'PEREZ', 'GARCIA', 'JAPGJINOTEGA90@HOTMAIL.COM', '8815-5591', 'JINOTEGA', 'A'),
(31, 'ADMIN', '$2y$10$Egyih7NgzY2pgFTue2SfOO9fwvSkc2KV7b4j/u8czZZzoDo8mBrZi', 'ADMINISTRADOR', '241-281172-0005M', 'JAIRO', 'ANTONIO', 'LAGUNA', 'CASTILLO', 'MASTERJINO72@GMAIL.COM', '8825 - 2163', 'JINOTEGA', 'A'),
(34, 'CARLOSHURTADO', '$2y$10$v.czZJSQbC9CmdlTN8JeAuR3YaujOoIMVqp7h0kvv/9SHAzmmnCD.', 'CONTRIBUYENTE', '001-291275-0008Q', 'CARLOS', 'ANDRES', 'HURTADO', 'ZELAYA', 'JUANJPEREZ@CORREO.COM', '8850-7439', 'LEON', 'A'),
(37, 'OSCARRUGAMA', '$2y$10$9MSiEwaapv5v5Kd4AFbD/.JCGi7hptXLv6Aij6zGvzPkERYjCPVoK', 'CONTRIBUYENTE', '241-151155-0000G', 'OSCAR', 'ANTONIO', 'RUGAMA', 'DIAZ', 'ORUGAAMAD55@GMAIL.COM', '8825-1570', 'JINOTEGA', 'B'),
(40, 'ALMAIRIS', '$2y$10$Hro3L36EwrIBP57xlEg03ut.5jFa8mtLPUMj2UQqu0SR8b/CAOaoO', 'CONTRIBUYENTE', '241-151088-0000L', 'ALMA', 'IRIS', 'RUGAMA', 'ROBLETO', 'ALMAIRISCAME@HOTMAIL.COM', '8815-6625', 'JINOTEGA', 'A'),
(41, 'DEMO', '$2y$10$m/xCzNiK05iq3HE1GGNNVuLSt2LClpBTU7jjx5KHA1TfmJSGrHi1G', 'CONTRIBUYENTE', '123', 'DEMO', '', 'PRUEBA', '', 'DEMO@CORREO.COM', '123123123', 'MANAGUA', 'A');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
