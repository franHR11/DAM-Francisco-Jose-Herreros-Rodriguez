ALTER TABLE `pedido` 
ADD CONSTRAINT `pedidosaclientes` 
FOREIGN KEY (`ID_Cliente`)
 REFERENCES `cliente`(`ID_Cliente`) 
 ON DELETE RESTRICT 
 ON UPDATE RESTRICT;