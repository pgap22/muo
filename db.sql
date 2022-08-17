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
-- Table `muo-db`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 42
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`categoriaeng`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`categoriaeng` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `id_categoria` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categoriaEn_idx` (`id_categoria` ASC),
  CONSTRAINT `fk_categoriaEn`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `muo-db`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`museos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`museos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(155) NULL DEFAULT NULL,
  `descripcion` VARCHAR(500) NULL DEFAULT NULL,
  `imagen` VARCHAR(120) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 52
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`exposiciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`exposiciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(120) NULL DEFAULT NULL,
  `informacion` VARCHAR(255) NULL DEFAULT NULL,
  `id_museos` INT(11) NULL DEFAULT NULL,
  `id_categorias` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_museosId_idx` (`id_museos` ASC),
  INDEX `fk_categoriaId_idx` (`id_categorias` ASC),
  CONSTRAINT `fk_categoriaId`
    FOREIGN KEY (`id_categorias`)
    REFERENCES `muo-db`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_museosId`
    FOREIGN KEY (`id_museos`)
    REFERENCES `muo-db`.`museos` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 35
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
  `isAdmin` TINYINT(1) NOT NULL,
  `verified` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 45
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
-- Table `muo-db`.`exposeng`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`exposeng` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `informacion` VARCHAR(255) NULL DEFAULT NULL,
  `nombre` VARCHAR(120) NULL DEFAULT NULL,
  `id_expo` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_expoID_idx` (`id_expo` ASC),
  CONSTRAINT `fk_expoID`
    FOREIGN KEY (`id_expo`)
    REFERENCES `muo-db`.`exposiciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 33
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
-- Table `muo-db`.`imagenesexpo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`imagenesexpo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rutaImagen` VARCHAR(120) NULL DEFAULT NULL,
  `id_exposicion` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_expoImg_id_idx` (`id_exposicion` ASC),
  CONSTRAINT `fk_expoImg_id`
    FOREIGN KEY (`id_exposicion`)
    REFERENCES `muo-db`.`exposiciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`museoseng`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`museoseng` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(500) NULL DEFAULT NULL,
  `id_museo` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_museo_ID_idx` (`id_museo` ASC),
  CONSTRAINT `fk_museo_ID`
    FOREIGN KEY (`id_museo`)
    REFERENCES `muo-db`.`museos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 37
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `muo-db`.`passwordcode`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muo-db`.`passwordcode` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` INT(5) NULL DEFAULT NULL,
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
