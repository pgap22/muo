-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema prueba2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema prueba2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prueba2` DEFAULT CHARACTER SET latin1 ;
USE `prueba2` ;

-- -----------------------------------------------------
-- Table `prueba2`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prueba2`.`admin` (
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `pass` VARCHAR(25) NOT NULL,
  `user` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `prueba2`.`museos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prueba2`.`museos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `museo` VARCHAR(11) NOT NULL,
  `museo_descripcion` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `prueba2`.`exposiciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prueba2`.`exposiciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(55) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `imagen` VARCHAR(55) NOT NULL,
  `museo_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `museo_id` (`museo_id` ASC),
  CONSTRAINT `museo_fk`
    FOREIGN KEY (`museo_id`)
    REFERENCES `prueba2`.`museos` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `prueba2`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prueba2`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(55) NOT NULL,
  `contraseña` VARCHAR(55) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC),
  UNIQUE INDEX `contraseña` (`contraseña` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `prueba2`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prueba2`.`comentarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `comentario` VARCHAR(255) NOT NULL,
  `exposicion_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `usuario_id` (`usuario_id` ASC),
  INDEX `exposicion_id` (`exposicion_id` ASC),
  CONSTRAINT `exposicion_fk1`
    FOREIGN KEY (`exposicion_id`)
    REFERENCES `prueba2`.`exposiciones` (`id`),
  CONSTRAINT `usuario_fk1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `prueba2`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `prueba2`.`favoritos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prueba2`.`favoritos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `exposicion_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `exposicion_id` (`exposicion_id` ASC),
  INDEX `usuario_id` (`usuario_id` ASC),
  CONSTRAINT `exposicion_fk`
    FOREIGN KEY (`exposicion_id`)
    REFERENCES `prueba2`.`exposiciones` (`id`),
  CONSTRAINT `usuario_fk`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `prueba2`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
