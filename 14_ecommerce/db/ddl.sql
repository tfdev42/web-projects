CREATE DATABASE IF NOT EXISTS 20230911_ecommerce;
USE 20230911_ecommerce;

CREATE TABLE brand 
(
    id INT AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY(id)
);

CREATE TABLE user
(
    id INT AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(100) NOT NULL,
    is_admin TINYINT(1) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);