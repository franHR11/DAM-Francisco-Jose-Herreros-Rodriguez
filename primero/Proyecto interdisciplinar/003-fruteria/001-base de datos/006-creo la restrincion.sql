ALTER TABLE `producto`
 ADD CONSTRAINT `productoaproveedor` 
 FOREIGN KEY (`ID_Proveedor`) 
 REFERENCES `proveedor`(`ID_Proveedor`) 
 ON DELETE RESTRICT ON UPDATE RESTRICT;