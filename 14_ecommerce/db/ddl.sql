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