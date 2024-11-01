CREATE TABLE `fruteria`.`Cliente` 
(
    `ID_Cliente` INT NOT NULL AUTO_INCREMENT ,
     `NombreCliente` VARCHAR(255) NOT NULL ,
      `Teléfono` VARCHAR(255) NOT NULL ,
       `Correo` VARCHAR(255) NOT NULL ,
        `Dirección` VARCHAR(255) NOT NULL ,
         PRIMARY KEY (`ID_Cliente`)
         ) ENGINE = InnoDB;