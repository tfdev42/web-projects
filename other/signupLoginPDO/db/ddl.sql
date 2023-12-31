CREATE DATABASE IF NOT EXISTS login_db_pdo_231220;
USE login_db_pdo_231220;

CREATE TABLE user(
    id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY(email)
);