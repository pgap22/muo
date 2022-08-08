-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema muo-db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema muo-db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `muo-db` DEFAULT CHARACTER SET utf8 ;
USE `muo-db` ;

-- -----------------------------------------------------
-- Table `muo-db`.`museos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`museos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`exposiciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`exposiciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `id_museos` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_museosId_idx` (`id_museos` ASC),
  CONSTRAINT `fk_museosId`
    FOREIGN KEY (`id_museos`)
    REFERENCES `muo-db`.`museos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NULL DEFAULT NULL,
  `password` VARCHAR(60) NULL DEFAULT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `last_name` VARCHAR(45) NULL DEFAULT NULL,
  `verifyToken` VARCHAR(45) NULL DEFAULT NULL,
  `disponible_resend` DATETIME NULL DEFAULT NULL,
  `emailToken` VARCHAR(16) NULL DEFAULT NULL,
  `id_rol` INT(11) NOT NULL,
  `verified` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rol_idx` (`id_rol` ASC),
  CONSTRAINT `fk_rol`
    FOREIGN KEY (`id_rol`)
    REFERENCES `muo-db`.`roles` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 39
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`comentarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `contenido` VARCHAR(255) NULL DEFAULT NULL,
  `id_exposicion` INT(11) NULL DEFAULT NULL,
  `id_usuarios` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exposicion_idx` (`id_exposicion` ASC),
  INDEX `fk_usuario_idx` (`id_usuarios` ASC),
  CONSTRAINT `fk_exposicion`
    FOREIGN KEY (`id_exposicion`)
    REFERENCES `muo-db`.`exposiciones` (`id`),
  CONSTRAINT `fk_usuario`
    FOREIGN KEY (`id_usuarios`)
    REFERENCES `muo-db`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`favoritosusuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`favoritosusuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NULL DEFAULT NULL,
  `id_exposicion` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_idx` (`id_usuario` ASC),
  INDEX `fk_exposicion_idx` (`id_exposicion` ASC),
  CONSTRAINT `fk_exposicion_id`
    FOREIGN KEY (`id_exposicion`)
    REFERENCES `muo-db`.`exposiciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `muo-db`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`passwordcode`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`passwordcode` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` INT(6) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `limit_time` DATETIME NULL DEFAULT NULL,
  `resend_code` DATETIME NULL DEFAULT NULL,
  `passToken` VARCHAR(16) NULL DEFAULT NULL,
  `verified` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_password_code` (`user_id` ASC),
  CONSTRAINT `fk_password_code`
    FOREIGN KEY (`user_id`)
    REFERENCES `muo-db`.`usuarios` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
