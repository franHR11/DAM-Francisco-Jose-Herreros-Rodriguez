CREATE TABLE `programacion`.`clientes` (
    `identificador` INT(255) NOT NULL AUTO_INCREMENT ,
     `nombre` VARCHAR(255) NOT NULL ,
      `apellidos` VARCHAR(255) NOT NULL ,
      `email` VARCHAR(255) NOT NULL ,
       PRIMARY KEY (`identificador`)) ENGINE = InnoDB;


CREATE TABLE `programacion`.`productos` (
    `identificador` INT(255) NOT NULL AUTO_INCREMENT ,
     `nombre` VARCHAR(255) NOT NULL ,
      `descripcion` TEXT NOT NULL ,
       `precio` DECIMAL(20,2) NOT NULL ,
        PRIMARY KEY (`identificador`)) ENGINE = InnoDB;

CREATE TABLE `programacion`.`categorias` (
    `Identificador` INT NOT NULL AUTO_INCREMENT ,
     `nombre` VARCHAR(255) NOT NULL ,
      PRIMARY KEY (`Identificador`)) ENGINE = InnoDB;        