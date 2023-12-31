CREATE DATABASE IF NOT EXISTS mvc_insurance_20240101;
USE mvc_insurance_20240101;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    zip VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    payment_options_id INT,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE user_roles (
    role_id INT NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (role_id)
);

CREATE TABLE role_permissions (
    role VARCHAR(50) NOT NULL,
    permission_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (role, permission_name)
);

INSERT INTO role_permissions (role, permission_name) VALUES
    ('customer', 'view_dashboard'),
    ('customer', 'place_order'),
    ('manager', 'manage_inventory'),
    ('manager', 'view_dashboard'),
    ('agent', 'view_dashboard');

CREATE TABLE user_has_role (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (user_id, role_id)
);


CREATE TABLE payment_options (
    option_id INT PRIMARY KEY AUTO_INCREMENT,
    option_name VARCHAR(50) NOT NULL,
    UNIQUE KEY (option_name)
);

INSERT INTO payment_options (option_name) VALUES
    ('bill'),
    ('IBAN');


CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price_per_minute DECIMAL(10,2) NOT NULL,    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE orders (
    id INT NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    start_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    end_time DATETIME DEFAULT NULL,
    status_name ENUM('pending', 'approved', 'denied') DEFAULT 'pending',
    comment TEXT,
    boat_registration_number VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);


-- ADD FOREIGN KEY CONSTRAINS AFTER TABLE CREATION
ALTER TABLE users
ADD FOREIGN KEY (role_id) REFERENCES user_roles(role_id) ON DELETE CASCADE,
ADD FOREIGN KEY (payment_options_id) REFERENCES payment_options(option_id) ON DELETE CASCADE;

ALTER TABLE user_has_role
ADD FOREIGN KEY (user_id) REFERENCES users(id),
ADD FOREIGN KEY (role_id) REFERENCES user_roles(role_id);

ALTER TABLE orders
ADD FOREIGN KEY (customer_id) REFERENCES users(id),
ADD FOREIGN KEY (product_id) REFERENCES product(id);

-- ADD USER ROLES
INSERT INTO user_roles (role_name) VALUES
    ('manager'),
    ('agent'),
    ('customer');


