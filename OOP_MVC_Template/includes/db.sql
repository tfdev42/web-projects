CREATE DATABASE IF NOT EXISTS templateDb_20240124;
USE templateDb_20240124;

CREATE TABLE users (
    users_id INT PRIMARY KEY AUTO_INCREMENT,
    users_firstname VARCHAR(255) NOT NULL,
    users_lastname VARCHAR(255) NOT NULL,
    user_dateofbirth DATE NOT NULL
);


-- some Test Data


INSERT INTO users (users_firstname, users_lastname, user_dateofbirth)
VALUES ("Tim", "Testarosa", )