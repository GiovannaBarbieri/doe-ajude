-- MySQL Workbench Forward Engineering
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_csc_doacao
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_csc_doacao
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_csc_doacao` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema der_csc_doacao
-- -----------------------------------------------------
USE `db_csc_doacao` ;

-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `email_usuario` VARCHAR(100) NOT NULL,
  `senha_usuario` VARCHAR(100) NOT NULL,
  `tipo_usuario` TINYINT(1) NOT NULL COMMENT '1-Admistrador\n2-',
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_funcionario` (
  `id_funcionario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` VARCHAR(45) NOT NULL,
  `telefone_funcionario` VARCHAR(20) NOT NULL,
  `sobrenome_funcionario` VARCHAR(60) NOT NULL,
  `id_user_func` INT(11) NOT NULL,
  `id_user_adm` INT(11) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  INDEX `fk_tb_funcionario_tb_usuario1_idx` (`id_user_func` ASC) VISIBLE,
  INDEX `fk_tb_funcionario_tb_usuario2_idx` (`id_user_adm` ASC) VISIBLE,
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


-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_parceiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_parceiro` (
  `id_parceiro` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_parceiro` VARCHAR(45) NOT NULL,
  `telefone_parceiro` VARCHAR(11) NOT NULL,
  `email_parceiro` VARCHAR(100) NOT NULL,
  `documento_parceiro` VARCHAR(20) NOT NULL,
  `endereco_parceiro` VARCHAR(120) NOT NULL,
  `numero_parceiro` VARCHAR(5) NOT NULL,
  `responsavel_parceiro` VARCHAR(45) NOT NULL,
  `data_parceiro` DATETIME NOT NULL,
  `id_user_adm` INT(11) NOT NULL,
  PRIMARY KEY (`id_parceiro`),
  INDEX `fk_tb_parceiro_tb_funcionario1_idx` (`id_user_adm`),
  CONSTRAINT `fk_tb_parceiro_tb_funcionario1`
    FOREIGN KEY (`id_user_adm`)
    REFERENCES `db_csc_doacao`.`tb_funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARSET = utf8;



-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_doador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_doador` (
  `id_doador` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(45) NOT NULL,
  `sobrenome_usuario` VARCHAR(45) NOT NULL,
  `telefone_usuario` VARCHAR(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  `tipo_doador` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_doador`),
  INDEX `fk_tb_doador_tb_usuario1_idx` (`id_usuario`),
  CONSTRAINT `fk_tb_doador_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_voluntario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_voluntario` (
  `id_voluntario` INT(11) NOT NULL AUTO_INCREMENT,
  `disponibilidade_voluntario` TINYINT(1) NOT NULL COMMENT '1 - Manhã.\\n2 - Tarde.\\n3 - Noite.\\n4 - Outro.',
  `outro_voluntario` VARCHAR(45) NULL DEFAULT NULL,
  `setor_voluntario` TINYINT(1) NOT NULL COMMENT '1 - Educação\\n2 - Abrigo.\\n3 - Equipe de Apoio.',
  `outra_funcao` VARCHAR(60) NULL DEFAULT NULL,
  `outra_instituicao` TINYINT(1) NOT NULL COMMENT '1 - Sim.\\n2 - Não.',
  `qual_instituicao` VARCHAR(200) NULL DEFAULT NULL,
  `sobre_voluntario` VARCHAR(300) NOT NULL,
  `id_doador` INT(11) NOT NULL,
  `id_status` INT(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_voluntario`),
  INDEX `fk_tb_voluntario_tb_doador1_idx` (`id_doador`) ,
  INDEX `fk_tb_voluntario_tb_status1_idx` (`id_status`) ,
  INDEX `fk_tb_voluntario_tb_usuario1_idx` (`id_usuario`) ,
  CONSTRAINT `fk_tb_voluntario_tb_doador1`
    FOREIGN KEY (`id_doador`)
    REFERENCES `db_csc_doacao`.`tb_doador` (`id_doador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_voluntario_tb_status1`
    FOREIGN KEY (`id_status`)
    REFERENCES `db_csc_doacao`.`tb_status` (`id_status`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_voluntario_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_csc_doacao`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_status` (
  `id_status` INT(11) NOT NULL AUTO_INCREMENT,
  `data_status` DATE NOT NULL,
  `hora_status` TIME NOT NULL,
  `situacao_status` TINYINT(1) NOT NULL COMMENT '1 - Aceito.\\n2 - Rejeitado.',
  `id_funcionario` INT(11) NULL DEFAULT NULL,
  `id_doacao` INT(11) NULL DEFAULT NULL,
  `id_voluntario` INT(11) NULL,
  PRIMARY KEY (`id_status`),
  INDEX `fk_tb_status_tb_funcionario1_idx` (`id_funcionario`),
  INDEX `fk_tb_status_tb_doacao1_idx` (`id_doacao`),
  INDEX `fk_tb_status_tb_voluntario1_idx` (`id_voluntario`),
  CONSTRAINT `fk_tb_status_tb_doacao1`
    FOREIGN KEY (`id_doacao`)
    REFERENCES `db_csc_doacao`.`tb_doacao` (`id_doacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_status_tb_funcionario1`
    FOREIGN KEY (`id_funcionario`)
    REFERENCES `db_csc_doacao`.`tb_funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_status_tb_voluntario1`
    FOREIGN KEY (`id_voluntario`)
    REFERENCES `db_csc_doacao`.`tb_voluntario` (`id_voluntario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_csc_doacao`.`tb_doacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_csc_doacao`.`tb_doacao` (
  `id_doacao` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_objeto` VARCHAR(45) NOT NULL,
  `imagem_objeto` VARCHAR(60) NOT NULL,
  `estado_objeto` TINYINT(1) NOT NULL COMMENT '1 - ótimo\\n2 - bom\\n3 - ruim',
  `descricao_objeto` VARCHAR(300) NOT NULL,
  `cep_objeto` VARCHAR(8) NOT NULL,
  `endereco_objeto` VARCHAR(120) NOT NULL,
  `bairro_objeto` VARCHAR(30) NOT NULL,
  `numero_objeto` VARCHAR(5) NOT NULL,
  `telefone_objeto` VARCHAR(11) NOT NULL,
  `data_objeto` DATE NOT NULL,
  `id_doador` INT(11) NOT NULL,
  `id_parceiro` INT(11) NOT NULL,
  `id_status` INT(11) NOT NULL,
  PRIMARY KEY (`id_doacao`),
  INDEX `fk_tb_querodoar_tb_doador1_idx` (`id_doador`),
  INDEX `fk_tb_doacao_tb_parceiro1_idx` (`id_parceiro`),
  INDEX `fk_tb_doacao_tb_status1_idx` (`id_status`),
  CONSTRAINT `fk_tb_doacao_tb_parceiro1`
    FOREIGN KEY (`id_parceiro`)
    REFERENCES `db_csc_doacao`.`tb_parceiro` (`id_parceiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_querodoar_tb_doador1`
    FOREIGN KEY (`id_doador`)
    REFERENCES `db_csc_doacao`.`tb_doador` (`id_doador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_doacao_tb_status1`
    FOREIGN KEY (`id_status`)
    REFERENCES `db_csc_doacao`.`tb_status` (`id_status`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
