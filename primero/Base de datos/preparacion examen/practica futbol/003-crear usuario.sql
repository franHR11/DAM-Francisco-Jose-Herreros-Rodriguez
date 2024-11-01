CREATE USER 'futbol'@'localhost' IDENTIFIED BY 'futbol';
GRANT ALL PRIVILEGES ON futbol.* TO 'futbol'@'localhost';
FLUSH PRIVILEGES;