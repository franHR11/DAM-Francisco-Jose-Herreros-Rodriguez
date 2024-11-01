ALTER TABLE `DetallePedido`
 ADD CONSTRAINT `detallepedidoaproducto`
  FOREIGN KEY (`ID_Producto`)
   REFERENCES `Producto`(`ID_Producto`) 
   ON DELETE RESTRICT
    ON UPDATE RESTRICT;