SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `rmb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `rmb` ;

-- -----------------------------------------------------
-- Table `rmb`.`usu_cpf`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`usu_cpf` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`usu_cpf` (
  `id_usu_cpf` INT NOT NULL AUTO_INCREMENT ,
  `nome_usu_cpf` VARCHAR(45) NOT NULL ,
  `email_usu_cpf` VARCHAR(45) NOT NULL ,
  `senha_usu_cpf` CHAR(32) NOT NULL ,
  PRIMARY KEY (`id_usu_cpf`) ,
  UNIQUE INDEX `email_usu_cpf_UNIQUE` (`email_usu_cpf` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rmb`.`usu_cnpj`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`usu_cnpj` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`usu_cnpj` (
  `id_usu_cnpj` INT NOT NULL AUTO_INCREMENT ,
  `nome_usu_cnpj` VARCHAR(45) NOT NULL ,
  `email_usu_cnpj` VARCHAR(45) NOT NULL ,
  `senha_usu_cnpj` CHAR(32) NOT NULL ,
  `status_conta_usu_cnpj` INT NOT NULL DEFAULT 1 COMMENT '1 = ativo\\n2 = banido' ,
  `cnpj_usu_cnpj` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_usu_cnpj`) ,
  UNIQUE INDEX `email_usu_cpf_UNIQUE` (`email_usu_cnpj` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rmb`.`prod`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`prod` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`prod` (
  `id_prod` INT NOT NULL AUTO_INCREMENT ,
  `nome_prod` VARCHAR(45) NULL ,
  `valor_prod` DOUBLE NULL DEFAULT 0 COMMENT 'Valor por quilo que o usu_cnpj está disposto a pagar pelo prutudo' ,
  `id_usu_cnpj` INT NOT NULL ,
  PRIMARY KEY (`id_prod`) ,
  INDEX `fk_prod_usu_cnpj1_idx` (`id_usu_cnpj` ASC) ,
  CONSTRAINT `fk_prod_usu_cnpj1`
    FOREIGN KEY (`id_usu_cnpj` )
    REFERENCES `rmb`.`usu_cnpj` (`id_usu_cnpj` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rmb`.`pag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`pag` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`pag` (
  `id_pag` INT NOT NULL AUTO_INCREMENT ,
  `valor_pag` DOUBLE NOT NULL DEFAULT 0 COMMENT 'valor total em reais do pagamento feito usu_cnpj para ter acesso a plataforma.' ,
  `status_pag` INT NOT NULL DEFAULT 2 COMMENT '1 = ativo\\n2 = pendente\\n3 = expirado' ,
  `vencimento_pag` DATE NOT NULL COMMENT 'data em que o pagamento irá expirar e o usu_cnpj ficará privado dos beneficios da plataforma enquanto não renovar o pagamento' ,
  `id_usu_cnpj` INT NOT NULL ,
  PRIMARY KEY (`id_pag`) ,
  INDEX `fk_pag_usu_cnpj1_idx` (`id_usu_cnpj` ASC) ,
  CONSTRAINT `fk_pag_usu_cnpj1`
    FOREIGN KEY (`id_usu_cnpj` )
    REFERENCES `rmb`.`usu_cnpj` (`id_usu_cnpj` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rmb`.`end_usu_cpf`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`end_usu_cpf` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`end_usu_cpf` (
  `id_end_usu_cpf` INT NOT NULL AUTO_INCREMENT ,
  `pais_end_usu_cpf` VARCHAR(45) NOT NULL DEFAULT 'Brazil' ,
  `uf_end_usu_cpf` VARCHAR(45) NOT NULL ,
  `cidade_end_usu_cpf` VARCHAR(45) NOT NULL ,
  `bairro_end_usu_cpf` VARCHAR(45) NOT NULL ,
  `logradouro_end_usu_cpf` VARCHAR(45) NOT NULL ,
  `complemento_end_usu_cpf` VARCHAR(45) NOT NULL ,
  `cep_end_usu_cpf` VARCHAR(45) NOT NULL ,
  `id_usu_cpf` INT NOT NULL ,
  PRIMARY KEY (`id_end_usu_cpf`) ,
  INDEX `fk_end_usu_cpf_usu_cpf_idx` (`id_usu_cpf` ASC) ,
  CONSTRAINT `fk_end_usu_cpf_usu_cpf`
    FOREIGN KEY (`id_usu_cpf` )
    REFERENCES `rmb`.`usu_cpf` (`id_usu_cpf` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rmb`.`end_usu_cnjp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`end_usu_cnjp` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`end_usu_cnjp` (
  `id_end_usu_cnpj` INT NOT NULL AUTO_INCREMENT ,
  `pais_end_usu_cnpj` VARCHAR(45) NOT NULL DEFAULT 'Brazil' ,
  `uf_end_usu_cnpj` VARCHAR(45) NOT NULL ,
  `cidade_end_usu_cnpj` VARCHAR(45) NOT NULL ,
  `bairro_end_usu_cnpj` VARCHAR(45) NOT NULL ,
  `logradouro_end_usu_cnpj` VARCHAR(45) NOT NULL ,
  `complemento_end_usu_cnpj` VARCHAR(45) NOT NULL ,
  `cep_end_usu_cnpj` VARCHAR(45) NOT NULL ,
  `id_usu_cnpj` INT NOT NULL ,
  PRIMARY KEY (`id_end_usu_cnpj`),
  INDEX `fk_end_usu_cnpj1_idx` (`id_usu_cnpj` ASC),
  CONSTRAINT `fk_end_usu_cnpj1`
    FOREIGN KEY (`id_usu_cnpj` )
    REFERENCES `rmb`.`usu_cnpj` (`id_usu_cnpj` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rmb`.`adm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rmb`.`adm` ;

CREATE  TABLE IF NOT EXISTS `rmb`.`adm` (
  `id_adm` INT NOT NULL AUTO_INCREMENT ,
  `nome_adm` VARCHAR(45) NOT NULL ,
  `email_adm` VARCHAR(45) NOT NULL ,
  `senha_adm` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_adm`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
