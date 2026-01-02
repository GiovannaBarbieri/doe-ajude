-- MySQL Workbench Synchronization
-- Generated: 2024-05-14 17:43
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: pc

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_doador` (
  `id_doador` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_objeto` VARCHAR(45) NOT NULL,
  `imagem_objeto` VARCHAR(60) NOT NULL COMMENT 'mediumblob = guardar imagem no banco',
  `estado_objeto` TINYINT(1) NOT NULL COMMENT '1 - Ótimo\n2 - Bom\n3 - Ruim',
  `descricao_objeto` VARCHAR(300) NOT NULL,
  `id_pessoa` INT(11) NULL DEFAULT NULL COMMENT 'id_doador mudado para id_pessoa',
  `id_parceiro` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_doador`),
  INDEX `fk_tb_querodoar_tb_doador1_idx` (`id_pessoa`),
  INDEX `fk_tb_doador_tb_parceiro1_idx` (`id_parceiro`),
  CONSTRAINT `fk_tb_querodoar_tb_doador1`
    FOREIGN KEY (`id_pessoa`)
    REFERENCES `db_csc_doacao`.`tb_pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_doador_tb_parceiro1`
    FOREIGN KEY (`id_parceiro`)
    REFERENCES `db_csc_doacao`.`tb_parceiro` (`id_parceiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_pessoa` (
  `id_pessoa` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'tb_doador mudado para tb_pessoa\n',
  `nome_pessoa` VARCHAR(45) NOT NULL,
  `telefone_pessoa` VARCHAR(16) NOT NULL,
  `id_user_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  INDEX `fk_tb_doador_tb_usuario1_idx` (`id_user_pessoa`),
  CONSTRAINT `fk_tb_doador_tb_usuario1`
    FOREIGN KEY (`id_user_pessoa`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_funcionario` (
  `id_funcionario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` VARCHAR(45) NOT NULL,
  `telefone_funcionario` VARCHAR(16) NOT NULL,
  `id_user_func` INT(11) NOT NULL,
  `id_user_adm` INT(11) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  INDEX `fk_tb_funcionario_tb_usuario1_idx` (`id_user_func`),
  INDEX `fk_tb_funcionario_tb_usuario2_idx` (`id_user_adm`),
  CONSTRAINT `fk_tb_funcionario_tb_usuario1`
    FOREIGN KEY (`id_user_func`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_funcionario_tb_usuario2`
    FOREIGN KEY (`id_user_adm`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_parceiro` (
  `id_parceiro` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_parceiro` VARCHAR(45) NOT NULL,
  `telefone_parceiro` VARCHAR(16) NOT NULL,
  `documento_parceiro` VARCHAR(20) NULL DEFAULT NULL COMMENT 'documento_parceiro = CPF ou CNPJ',
  `responsavel_parceiro` VARCHAR(45) NOT NULL,
  `id_user_func` INT(11) NULL DEFAULT NULL,
  `id_user_parceiro` INT(11) NOT NULL,
  PRIMARY KEY (`id_parceiro`),
  INDEX `fk_tb_parceiro_tb_funcionario1_idx` (`id_user_func`),
  INDEX `fk_tb_parceiro_tb_usuario1_idx` (`id_user_parceiro`),
  CONSTRAINT `fk_tb_parceiro_tb_funcionario1`
    FOREIGN KEY (`id_user_func`)
    REFERENCES `db_csc_doacao`.`tb_funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_parceiro_tb_usuario1`
    FOREIGN KEY (`id_user_parceiro`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_status` (
  `id_status` INT(11) NOT NULL AUTO_INCREMENT,
  `data_status` DATE NOT NULL,
  `hora_status` TIME NOT NULL,
  `situacao_status` TINYINT(1) NOT NULL COMMENT '0 - Pendente\n1 - Aprovado\n2 - Rejeitado',
  `id_funcionario` INT(11) NULL DEFAULT NULL,
  `id_doador` INT(11) NULL DEFAULT NULL,
  `id_voluntario` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`),
  INDEX `fk_tb_status_tb_funcionario1_idx` (`id_funcionario`),
  INDEX `fk_tb_status_tb_doador1_idx` (`id_doador`),
  INDEX `fk_tb_status_tb_voluntario1_idx` (`id_voluntario`),
  CONSTRAINT `fk_tb_status_tb_funcionario1`
    FOREIGN KEY (`id_funcionario`)
    REFERENCES `db_csc_doacao`.`tb_funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_status_tb_doador1`
    FOREIGN KEY (`id_doador`)
    REFERENCES `db_csc_doacao`.`tb_doador` (`id_doador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_status_tb_voluntario1`
    FOREIGN KEY (`id_voluntario`)
    REFERENCES `db_csc_doacao`.`tb_voluntario` (`id_voluntario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `email_usuario` VARCHAR(100) NOT NULL,
  `senha_usuario` VARCHAR(100) NOT NULL,
  `tipo_usuario` TINYINT(1) NOT NULL COMMENT '1 - Admistrador\n2 - Funcionario\n3 - Pessoa \n4 - Parceiro',
  `data_cadastro` DATE NOT NULL,
  `status_usuario` TINYINT(1) NOT NULL COMMENT '1 - Ativo\n2 - Desativado',
  `imagem_usuario` VARCHAR(60) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_voluntario` (
  `id_voluntario` INT(11) NOT NULL AUTO_INCREMENT,
  `disponibilidade_voluntario` TINYINT(1) NOT NULL COMMENT '1 - Manhã.\n2 - Tarde\n3 - Noite\n4 - Manha e tarde\n5 - Manha e noite\n6 - Tarde e noite\n',
  `setor_voluntario` TINYINT(1) NOT NULL COMMENT '1 - Educação\n2 - Abrigo\n3 - Equipe de Apoio.',
  `sobre_voluntario` VARCHAR(300) NOT NULL,
  `id_pessoa` INT(11) NOT NULL COMMENT 'id_doador mudado para id_pessoa',
  PRIMARY KEY (`id_voluntario`),
  INDEX `fk_tb_voluntario_tb_doador1_idx` (`id_pessoa`),
  CONSTRAINT `fk_tb_voluntario_tb_doador1`
    FOREIGN KEY (`id_pessoa`)
    REFERENCES `db_csc_doacao`.`tb_pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_endereco` (
  `id_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `rua` VARCHAR(30) NOT NULL,
  `bairro` VARCHAR(30) NOT NULL,
  `numero` VARCHAR(10) NOT NULL,
  `cep` VARCHAR(12) NULL DEFAULT NULL,
  `id_cidade` INT(11) NOT NULL,
  `id_usuario` INT(11) NULL DEFAULT NULL,
  `id_doador` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  INDEX `fk_tb_endereco_tb_cidade1_idx` (`id_cidade`),
  INDEX `fk_tb_endereco_tb_usuario1_idx` (`id_usuario`),
  INDEX `fk_tb_endereco_tb_doador1_idx` (`id_doador`),
  CONSTRAINT `fk_tb_endereco_tb_cidade1`
    FOREIGN KEY (`id_cidade`)
    REFERENCES `db_csc_doacao`.`tb_cidade` (`id_cidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_endereco_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_endereco_tb_doador1`
    FOREIGN KEY (`id_doador`)
    REFERENCES `db_csc_doacao`.`tb_doador` (`id_doador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_cidade` (
  `id_cidade` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_cidade` VARCHAR(45) NOT NULL,
  `id_estado` INT(11) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  INDEX `fk_tb_cidade_tb_estado1_idx` (`id_estado`),
  CONSTRAINT `fk_tb_cidade_tb_estado1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `db_csc_doacao`.`tb_estado` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_estado` (
  `id_estado` INT(11) NOT NULL,
  `nome_estado` VARCHAR(45) NOT NULL,
  `sigla_estado` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
