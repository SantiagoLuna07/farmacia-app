-- MySQL Script generated by MySQL Workbench
-- Fri Feb 14 20:49:08 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pharmacydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pharmacydb` DEFAULT CHARACTER SET utf8 ;
USE `pharmacydb` ;

-- -----------------------------------------------------
-- Table `pharmacydb`.`clients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pharmacydb`.`clients` (
  `idClient` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `idCard` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(45) NOT NULL,
  `birthDate` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `idCliente_UNIQUE` (`idClient` ASC),
  UNIQUE INDEX `idCard_UNIQUE` (`idCard` ASC),
  PRIMARY KEY (`idClient`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `pharmacydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pharmacydb`.`users` (
  `idUser` INT AUTO_INCREMENT NOT NULL,
  `idCard` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `idCard_UNIQUE` (`idCard` ASC),
  UNIQUE INDEX `correo_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

-- Default user
INSERT INTO users(idCard, name, lastname, email, username, password)
  values('1234', 'user name', 'user lastname', 'user@mail.com', 'username', '912ec803b2ce49e4a541068d495ab570');

-- -----------------------------------------------------
-- Table `pharmacydb`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pharmacydb`.`sales` (
  `idSale` INT AUTO_INCREMENT NOT NULL,
  `saleDate` VARCHAR(45) NULL,
  `totalValue` DOUBLE NULL,
  `client_idClient` INT NOT NULL,
  `user_idUser` INT NOT NULL,
  UNIQUE INDEX `idventa_UNIQUE` (`idSale` ASC),
  PRIMARY KEY (`idSale`),
  INDEX `fk_sale_client1_idx` (`client_idClient` ASC),
  INDEX `fk_sale_user1_idx` (`user_iduser` ASC),
  CONSTRAINT `fk_sale_client1`
    FOREIGN KEY (`client_idClient`)
    REFERENCES `pharmacydb`.`clients` (`idClient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_user1`
    FOREIGN KEY (`user_idUser`)
    REFERENCES `pharmacydb`.`users` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pharmacydb`.`laboratory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pharmacydb`.`laboratories` (
  `idlaboratory` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idlaboratory`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;

-- Default values for laboratories table..

  INSERT INTO laboratories(name, description) VALUES('lab1', 'laboratoirio 1');
  INSERT INTO laboratories(name, description) VALUES('lab2', 'laboratoirio 1');
  INSERT INTO laboratories(name, description) VALUES('lab3', 'laboratoirio 1');
  INSERT INTO laboratories(name, description) VALUES('lab4', 'laboratoirio 1');

-- -----------------------------------------------------
-- Table `pharmacydb`.`medicine`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pharmacydb`.`medicines` (
  `idMedicine` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  `expirationDate` DATE NOT NULL,
  `quantity` INT NOT NULL,
  `fabricationDate` VARCHAR(45) NOT NULL,
  `price` DOUBLE NOT NULL,
  `laboratory_idlaboratory` INT NOT NULL,
  `user_idUser` INT NOT NULL,
  PRIMARY KEY (`idMedicine`),
  UNIQUE INDEX `nombre_UNIQUE` (`name` ASC),
  CONSTRAINT `fk_medicine_laboratories`
    FOREIGN KEY (`laboratory_idlaboratory`)
    REFERENCES `pharmacydb`.`laboratories` (`idlaboratory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_medicine_user1`
    FOREIGN KEY (`user_idUser`)
    REFERENCES `pharmacydb`.`users` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pharmacydb`.`sale detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pharmacydb`.`sale_details` (
  `idSaleDetail` INT AUTO_INCREMENT NOT NULL,
  `cuantity` INT NOT NULL,
  `medicine_idMedicine` INT NOT NULL,
  `sale_idSale` INT NOT NULL,
  PRIMARY KEY (`idSaleDetail`, `sale_idSale`),
  UNIQUE INDEX `iddetalleVenta_UNIQUE` (`idSaleDetail` ASC),
  INDEX `saleidsale_UNIQUE` (`sale_idSale` ASC),
  CONSTRAINT `fk_sale detail_medicine1`
    FOREIGN KEY (`medicine_idMedicine`)
    REFERENCES `pharmacydb`.`medicines` (`idMedicine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale detail_sale1`
    FOREIGN KEY (`sale_idSale`)
    REFERENCES `pharmacydb`.`sales` (`idSale`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
