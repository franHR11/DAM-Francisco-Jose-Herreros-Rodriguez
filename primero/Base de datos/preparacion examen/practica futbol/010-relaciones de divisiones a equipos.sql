ALTER TABLE `equipos` ADD CONSTRAINT `divisionesaequipos` FOREIGN KEY (`divisiones_nombre`) REFERENCES `divisiones`(`identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;