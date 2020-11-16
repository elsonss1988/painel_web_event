-- ddl
CREATE TABLE `lives` (
  `idlives` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_idclientes` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` varchar(20) DEFAULT NULL,
  `hora` varchar(10) DEFAULT NULL,
  `bg` varchar(300) DEFAULT NULL,
  `logo` varchar(300) DEFAULT NULL,
  `cor1` varchar(15) DEFAULT NULL,
  `cor2` varchar(15) DEFAULT NULL,
  `flag_convidados` int(1) DEFAULT NULL,
  PRIMARY KEY (`idlives`),
  KEY `fk_lives_clientes1_idx` (`clientes_idclientes`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8