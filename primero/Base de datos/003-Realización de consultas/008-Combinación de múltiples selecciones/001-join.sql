-- Create the user
CREATE USER 'empresa'@'localhost' IDENTIFIED BY 'empresa';

-- Grant all privileges on the database 'miempresa' to the user
GRANT ALL PRIVILEGES ON miempresa.* TO 'empresa'@'localhost';

-- Apply the changes
FLUSH PRIVILEGES;