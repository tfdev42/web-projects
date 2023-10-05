-- Attributes
-- user(ID(PK), fname, lname, email(UK), password, street, country, city, zip, paymethod, IBAN, isAdmin)
-- product(ID(PK), name, description, pricePerMinute)
-- insurance(ID(PK), CustomerId(FK), productId(FK), status, start, end, comment, kennzeichen)

CREATE DATABASE IF NOT EXISTS 2023105_boot;
USE 2023105_boot;

CREATE TABLE user(
    id INT AUTO_INCREMENT,
    fname VARCHAR(200) NOT NULL,
    lname VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    street VARCHAR(200) NOT NULL,
    city VARCHAR(200) NOT NULL,
    country VARCHAR(200) NOT NULL,
    zip VARCHAR(200) NOT NULL,
    paymentMethod VARCHAR(200),
    password VARCHAR(100) NOT NULL,
    is_admin TINYINT(1),
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE product(
    id INT AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    description VARCHAR(500),
    pricePerMinute DECIMAL(4,2),
    PRIMARY KEY (id)
);

CREATE TABLE insurance(
    id INT AUTO_INCREMENT,
    status VARCHAR(100),
    startTime DATETIME,
    endTime DATETIME,
    comment VARCHAR(500),
    licensePlate VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (customerId) REFERENCES user(id),
    FOREIGN KEY (productId) REFERENCES product(id),
);