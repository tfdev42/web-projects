CREATE DATABASE IF NOT EXISTS v3_mvc_insurance_20240113;
USE v3_mvc_insurance_20240113;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    zip VARCHAR(255) NOT NULL,
    user_role_id INT NOT NULL,
    payment_option_id INT DEFAULT NULL,
    iban VARCHAR(100) DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE IF NOT EXISTS user_role (
    id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id, name)
);

INSERT INTO user_role (id, name) VALUES
    ('1', 'manager'),
    ('2', 'agent'),
    ('3', 'customer');

CREATE TABLE IF NOT EXISTS user_has_role (
    user_id INT NOT NULL,
    user_role_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (user_role_id) REFERENCES user_role(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS payment_option (
    id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    UNIQUE KEY (name)
);

INSERT INTO payment_option (id, name) VALUES
    ('1', 'bill'),
    ('2', 'IBAN');


CREATE TABLE IF NOT EXISTS product (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price_per_minute DECIMAL(10,2) NOT NULL,    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE orders (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    order_time DATETIME DEFAULT NOW(),
    start_time DATETIME DEFAULT NULL,
    end_time DATETIME DEFAULT NULL,
    status_name ENUM('pending', 'approved', 'denied', 'done', 'cancelled') DEFAULT 'pending',
    comment TEXT,
    boat_registration_number VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);


-- ADD FOREIGN KEY CONSTRAINS AFTER TABLE CREATION
ALTER TABLE users
ADD FOREIGN KEY (user_role_id) REFERENCES user_role(id) ON DELETE CASCADE,
ADD FOREIGN KEY (payment_option_id) REFERENCES payment_option(id) ON DELETE CASCADE;

ALTER TABLE orders
ADD FOREIGN KEY (user_id) REFERENCES users(id),
ADD FOREIGN KEY (product_id) REFERENCES product(id);