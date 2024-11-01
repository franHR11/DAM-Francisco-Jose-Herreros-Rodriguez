CREATE TABLE `fruteria`.`DetallePedido` 
(
    `ID_DetallePedido` INT NOT NULL AUTO_INCREMENT ,
     `ID_Pedido` INT NOT NULL ,
      `ID_Producto` INT NOT NULL ,
       `Cantidad` INT NOT NULL ,
        `PrecioUnidad` DECIMAL(10,2) NOT NULL ,
         PRIMARY KEY (`ID_DetallePedido`)
         ) ENGINE = InnoDB;