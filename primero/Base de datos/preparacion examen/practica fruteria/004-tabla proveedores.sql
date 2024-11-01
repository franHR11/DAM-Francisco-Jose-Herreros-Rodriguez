CREATE TABLE `fruteria`.`Proveedor` 
(
	`ID_Proveedor` INT NOT NULL AUTO_INCREMENT , 
	`NombreProveedor` VARCHAR(255) NOT NULL , 
	`Teléfono` VARCHAR(255) NOT NULL , 
	`Correo` VARCHAR(255) NOT NULL , 
	`Dirección` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`ID_Proveedor`)
) ENGINE = InnoDB;
