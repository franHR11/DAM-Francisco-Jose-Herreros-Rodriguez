CREATE DATABASE fruteria;

CREATE USER 'fruteria'@'localhost' IDENTIFIED BY 'fruteria';

GRANT ALL PRIVILEGES ON fruteria.* TO 'fruteria'@'localhost';

FLUSH PRIVILEGES;