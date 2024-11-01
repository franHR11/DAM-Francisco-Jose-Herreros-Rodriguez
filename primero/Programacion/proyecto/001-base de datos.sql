


CREATE DATABASE programacion;

CREATE USER 'programacion'@'localhost' IDENTIFIED BY 'programacion';

GRANT ALL PRIVILEGES ON programacion.* TO 'programacion'@'localhost';

FLUSH PRIVILEGES;