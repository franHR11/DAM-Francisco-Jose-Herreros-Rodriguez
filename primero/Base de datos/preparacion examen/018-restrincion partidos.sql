ALTER TABLE `partidos` ADD CONSTRAINT `visitanteapartido` FOREIGN KEY (`visitante`) REFERENCES `equipos`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `partidos` ADD CONSTRAINT `localapartijdo` FOREIGN KEY (`local`) REFERENCES `equipos`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `partidos` ADD CONSTRAINT `jornadaapartido` FOREIGN KEY (`jornada`) REFERENCES `jornadas`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;