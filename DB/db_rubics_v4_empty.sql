-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema rubics
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rubics` DEFAULT CHARACTER SET utf8 ;
USE `rubics` ;

-- -----------------------------------------------------
-- Table `rubics`.`identifier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`identifier` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `mail` VARCHAR(50) NOT NULL,
  `pwd` VARCHAR(50) NOT NULL,
  `secret_question` VARCHAR(250) NOT NULL,
  `secret_answer` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `rubics`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `birthdate` DATE NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `last_connection` DATETIME NOT NULL,
  `actif` TINYINT NOT NULL,
  `identifier_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_identifier_idx` (`identifier_id` ASC),
  CONSTRAINT `fk_identifier`
  FOREIGN KEY (`identifier_id`)
  REFERENCES `rubics`.`identifier` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL,
  `actif` TINYINT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`request` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL,
  `budget` FLOAT NOT NULL,
  `category_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`, `client_id`),
  INDEX `request_category0_FK` (`category_id` ASC),
  INDEX `fk_request_client` (`client_id` ASC),
  CONSTRAINT `request_category0_FK`
    FOREIGN KEY (`category_id`)
    REFERENCES `rubics`.`category` (`id`),
  CONSTRAINT `fk_request_client`
    FOREIGN KEY (`client_id`)
    REFERENCES `rubics`.`client` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`team`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`team` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `actif` TINYINT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`company` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL,
  `vat` VARCHAR(25) NOT NULL,
  `country` VARCHAR(25) NOT NULL,
  `locality` VARCHAR(25) NOT NULL,
  `zip_code` VARCHAR(25) NOT NULL,
  `street` VARCHAR(25) NOT NULL,
  `number` VARCHAR(25) NOT NULL,
  `comment` VARCHAR(250) NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`, `client_id`),
  INDEX `fk_company_client1_idx` (`client_id` ASC),
  CONSTRAINT `fk_company_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `rubics`.`client` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`skill`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`skill` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `actif` TINYINT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`project` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `finished_at` TIMESTAMP NULL,
  `finalized` TINYINT NOT NULL,
  `request_id` INT NOT NULL,
  PRIMARY KEY (`id`, `request_id`),
  INDEX `fk_project_request1_idx` (`request_id` ASC),
  CONSTRAINT `fk_project_request1`
    FOREIGN KEY (`request_id`)
    REFERENCES `rubics`.`request` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`media` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `extension` VARCHAR(50) NOT NULL,
  `path` VARCHAR(250) NOT NULL,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_media_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_media_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `rubics`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `priority` INT NOT NULL,
  `pwd` VARCHAR(250) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `actif` TINYINT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`employee` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `birthdate` DATE NOT NULL,
  `biography` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `actif` TINYINT NOT NULL,
  `team_id` INT NOT NULL,
  `role_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `employee_team_FK` (`team_id` ASC),
  INDEX `employee_role0_FK` (`role_id` ASC),
  CONSTRAINT `employee_team_FK`
    FOREIGN KEY (`team_id`)
    REFERENCES `rubics`.`team` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `employee_role0_FK`
    FOREIGN KEY (`role_id`)
    REFERENCES `rubics`.`role` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`realize`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`realize` (
  `project_id` INT NOT NULL,
  `employee_id` INT NOT NULL,
  INDEX `fk_realize_project1_idx` (`project_id`),
  INDEX `fk_realize_employee1_idx` (`employee_id`),
  CONSTRAINT `fk_realize_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `rubics`.`project` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_realize_employee1`
    FOREIGN KEY (`employee_id`)
    REFERENCES `rubics`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rubics`.`characterize`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rubics`.`characterize` (
  `skill_id` INT NOT NULL,
  `employee_id` INT NOT NULL,
  INDEX `fk_characterize_skill1_idx` (`skill_id` ASC),
  INDEX `fk_characterize_employee1_idx` (`employee_id` ASC),
  CONSTRAINT `fk_characterize_skill1`
    FOREIGN KEY (`skill_id`)
    REFERENCES `rubics`.`skill` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_characterize_employee1`
    FOREIGN KEY (`employee_id`)
    REFERENCES `rubics`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;