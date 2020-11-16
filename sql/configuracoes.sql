-- ddl
CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lives_idlives` int(11) NOT NULL,
  `perguntas` int(11) DEFAULT NULL,
  `frame_chat` varchar(999) DEFAULT NULL,
  `player1` varchar(999) NOT NULL,
  `player2` varchar(999) DEFAULT NULL,
  `player_traducao` varchar(999) DEFAULT NULL,
  `campos_cadastro` varchar(999) DEFAULT NULL,
  -- `valida_crm` int(11) DEFAULT NULL,
  -- `valida_email` int(11) DEFAULT NULL,
  -- `tipo_senha` int(11) DEFAULT NULL,
  -- `senha_padrao` varchar(20) DEFAULT NULL,
  `campos_login` varchar(100) DEFAULT NULL,
  `mensagem_cadastro` varchar(300) DEFAULT NULL,
  `mensagem_reset_mail` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_configuracoes_lives_idx` (`lives_idlives`)
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8