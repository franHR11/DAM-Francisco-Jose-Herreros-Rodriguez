CREATE TABLE `fruteria`.`Pedido` 
(
    `ID_Pedido` INT NOT NULL AUTO_INCREMENT ,
     `FechaPedido` DATE NOT NULL ,
      `Total` DECIMAL(10,2) NOT NULL ,
       `ID_Cliente` INT NOT NULL ,
        PRIMARY KEY (`ID_Pedido`)
        ) ENGINE = InnoDB;






INSERT INTO `fruteria`.`Pedido` (`FechaPedido`, `Total`, `ID_Cliente`) VALUES
('2024-10-01', 35.50, 1),
('2024-10-02', 42.00, 2),
('2024-10-03', 15.75, 3),
('2024-10-04', 55.90, 4),
('2024-10-05', 23.50, 5),
('2024-10-06', 60.25, 6),
('2024-10-07', 45.80, 7),
('2024-10-08', 28.30, 8),
('2024-10-09', 38.40, 9),
('2024-10-10', 50.00, 10);
