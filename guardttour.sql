-- MySQL Script generated by MySQL Workbench
-- Wed 13 Jan 2016 11:15:07 AM EST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema guardtour
-- -----------------------------------------------------
-- Table for guard tour in security company

-- -----------------------------------------------------
-- Schema guardtour
--
-- Table for guard tour in security company
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `guardtour` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `guardtour` ;

-- -----------------------------------------------------
-- Table `guardtour`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guardtour`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `name` VARCHAR(45) NULL,
  `lastname` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `guardtour`.`guard`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guardtour`.`guard` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NULL,
  `prenom` VARCHAR(255) NULL,
  `uid` VARCHAR(45) NULL,
  `photo` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `phone` VARCHAR(45) NULL,
  `NIF` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guardtour`.`poste`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guardtour`.`poste` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NULL,
  `adress` VARCHAR(255) NULL,
  `contact` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guardtour`.`guardtours`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guardtour`.`guardtours` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `heure` DATETIME NULL,
  `interval` INT NULL,
  `guard_id` INT NOT NULL,
  `poste_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_guardtours_guard_idx` (`guard_id` ASC),
  INDEX `fk_guardtours_poste1_idx` (`poste_id` ASC),
  CONSTRAINT `fk_guardtours_guard`
    FOREIGN KEY (`guard_id`)
    REFERENCES `guardtour`.`guard` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_guardtours_poste1`
    FOREIGN KEY (`poste_id`)
    REFERENCES `guardtour`.`poste` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guardtour`.`tours`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guardtour`.`tours` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_tour` DATETIME NULL,
  `qrcode` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `guard_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tours_guard1_idx` (`guard_id` ASC),
  CONSTRAINT `fk_tours_guard1`
    FOREIGN KEY (`guard_id`)
    REFERENCES `guardtour`.`guard` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guardtour`.`report`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guardtour`.`report` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mention` VARCHAR(255) NULL,
  `guard_id` INT NOT NULL,
  `tours_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_report_guard1_idx` (`guard_id` ASC),
  INDEX `fk_report_tours1_idx` (`tours_id` ASC),
  CONSTRAINT `fk_report_guard1`
    FOREIGN KEY (`guard_id`)
    REFERENCES `guardtour`.`guard` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_tours1`
    FOREIGN KEY (`tours_id`)
    REFERENCES `guardtour`.`tours` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
