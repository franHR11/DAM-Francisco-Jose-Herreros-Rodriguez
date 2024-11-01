CREATE TABLE `fruteria`.`Producto` (
    `ID_Producto` INT NOT NULL AUTO_INCREMENT ,
     `Nombre` VARCHAR(255) NOT NULL ,
      `PrecioUnidad` DECIMAL(10,2) NOT NULL ,
       `Stock` INT NOT NULL ,
        `ID_Proveedor` INT NOT NULL ,
         PRIMARY KEY (`ID_Producto`)) ENGINE = InnoDB;
