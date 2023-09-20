-- Attributschreibweise
-- User(id, fname, lname, emailUK, password, is_admin)
-- Order(id, user_idFK, order_date, zip, country, address, total)
-- Order_position(id, product_idFK, order_idFK, stock, unit_price)
-- Brand(id, name)
-- Category(id, name)
-- Product(id, skuUK, brand_idFK, category_idFK, name, description, picture, price, stock, is_removed)


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

CREATE TABLE category
(
    id INT AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY(id)
);

CREATE TABLE product 
(
    id INT AUTO_INCREMENT,
    sku VARCHAR(100) NOT NULL,
    brand_id INT NOT NULL,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    picture VARCHAR(2000) NOT NULL,
    price DECIMAL(16,2) NOT NULL,
    stock INT NOT NULL,
    is_removed TINYINT(1) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(brand_id) REFERENCES brand(id),
    FOREIGN KEY(category_id) REFERENCES category(id),
    UNIQUE KEY (sku)
);