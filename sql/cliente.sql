--ddl
CREATE TABLE `clientes` (
  `idclientes` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `logo` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idclientes`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8