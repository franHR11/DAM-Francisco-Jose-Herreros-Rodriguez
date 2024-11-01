CREATE TABLE `futbol`.`jugadores` (
`Identificador` INT NOT NULL AUTO_INCREMENT , 
`nombre` VARCHAR(255) NOT NULL , 
`apellidos` VARCHAR(255) NOT NULL , 
`fechadenacimiento` DATE NOT NULL , 
`paises_nombre` INT NOT NULL , 
PRIMARY KEY (`Identificador`)) ENGINE = InnoDB;