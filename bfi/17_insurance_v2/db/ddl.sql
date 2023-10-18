CREATE DATABASE IF NOT EXISTS boatinsurance;
USE boatinsurance;

CREATE TABLE user
(
    id INT AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(100) NOT NULL,
    street VARCHAR(100) NOT NULL,
    zip VARCHAR(20) NOT NULL,
    city VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    payment_type CHAR(1) DEFAULT NULL,
    iban VARCHAR(100) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE product 
(
    id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price_per_minute DECIMAL(10,2) NOT NULL,
    PRIMARY KEY(id)
);



CREATE TABLE contract 
(
    id INT AUTO_INCREMENT,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    status CHAR(1) NOT NULL,
    start DATETIME NOT NULL,
    end DATETIME DEFAULT NULL,
    comment TEXT NOT NULL,
    boat_registration_number VARCHAR(20) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(customer_id) REFERENCES user(id),
    FOREIGN KEY(product_id) REFERENCES product(id)
);

-- M Manager, C Customer, A Agent
CREATE TABLE role (
    id CHAR(1),
    name VARCHAR(20) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE user_has_role(
    user_id INT,
    role_id CHAR(1),
    PRIMARY KEY (user_id ,role_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);



INSERT INTO role
(id, name)
VALUES
('M', 'MANAGER'),
('C', 'CUSTOMER'),
('A', 'AGENT');

