ALTER TABLE `DetallePedido` 
ADD CONSTRAINT `detallepedidoapedido` 
FOREIGN KEY (`ID_Pedido`) 
REFERENCES `Pedido`(`ID_Pedido`) 
ON DELETE RESTRICT
 ON UPDATE RESTRICT;