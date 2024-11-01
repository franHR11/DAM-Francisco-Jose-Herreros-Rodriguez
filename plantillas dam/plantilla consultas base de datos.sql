


CREATE DATABASE programacion;

CREATE USER 'programacion'@'localhost' IDENTIFIED BY 'programacion';

GRANT ALL PRIVILEGES ON programacion.* TO 'programacion'@'localhost';

FLUSH PRIVILEGES;


CREATE TABLE `programacion`.`clientes` (
    `identificador` INT(255) NOT NULL AUTO_INCREMENT ,
     `nombre` VARCHAR(255) NOT NULL ,
      `apellidos` VARCHAR(255) NOT NULL ,
       `email` VARCHAR(255) NOT NULL ,
        PRIMARY KEY (`identificador`)) ENGINE = InnoDB;