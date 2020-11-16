CREATE TABLE `convidados` (
  `idconvidados` int(11) NOT NULL AUTO_INCREMENT,
  `lives_idlives` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `link_curriculo` varchar(500) DEFAULT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `minibio` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idconvidados`),
  KEY `fk_convidados_lives1_idx` (`lives_idlives`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8