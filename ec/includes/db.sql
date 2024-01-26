CREATE DATABASE IF NOT EXISTS ec_20240126;
USE ec_20240126;

CREATE TABLE users (
    users_id INT(50) PRIMARY KEY AUTO_INCREMENT,
    users_email VARCHAR(255) UNIQUE KEY NOT NULL,
    users_pwd VARCHAR(255) NOT NULL,
    users_role VARCHAR(255) DEFAULT 'customer'
);


CREATE TABLE carts (
    carts_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_users_id INT,
    FOREIGN KEY (fk_users_id) REFERENCES users(users_id)
);

CREATE TABLE products (
    products_id INT PRIMARY KEY AUTO_INCREMENT,
    products_article_nr VARCHAR(255) UNIQUE KEY NOT NULL,
    products_description VARCHAR(255) NOT NULL,
    products_stock TINYINT(1) DEFAULT 1,
    products_price DECIMAL(10, 2)
);

CREATE TABLE carts_items (
    carts_items_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_products_id INT,
    fk_carts_id INT,
    carts_items_quantity INT,
    FOREIGN KEY (fk_products_id) REFERENCES products(products_id),
    FOREIGN KEY (fk_carts_id) REFERENCES carts(carts_id)
);

CREATE TABLE addresses_infos (
    addr_info_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    zip VARCHAR(255) NOT NULL,
);

CREATE TABLE credit_cards_infos (
    credit_cards_infos_id INT PRIMARY KEY AUTO_INCREMENT,
    cc_first_name VARCHAR(255) NOT NULL,
    cc_last_name VARCHAR(255) NOT NULL,
    cc_number INT NOT NULL,
    cc_exp_date DATE NOT NULL,
    cc_cvc INT NOT NULL
);

CREATE TABLE addresses (
    addresses_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_addr_info_id INT,
    addresses_type ENUM ('delivery', 'billing', 'both'),
    fk_credit_cards_infos_id INT DEFAULT NULL,
    FOREIGN KEY (fk_addr_info_id) REFERENCES addresses_infos(addr_info_id),
    FOREIGN KEY (fk_credit_cards_infos_id) REFERENCES credit_cards_infos(credit_cards_infos_id)
);



CREATE TABLE orders (
    orders_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_users_id INT,
    fk_carts_items_id INT,
    fk_cc_info_id INT,
    fk_addresses_id INT,
    orders_price DECIMAL (10,2),
    FOREIGN KEY (fk_users_id) REFERENCES users(users_id),
    FOREIGN KEY (fk_carts_items_id) REFERENCES carts_items(carts_items_id),
    FOREIGN KEY (fk_cc_info_id) REFERENCES credit_cards_infos(credit_cards_infos_id),
    FOREIGN KEY (fk_addresses_id) REFERENCES addresses(addresses_id)
);

INSERT INTO users (users_email, users_pwd, users_role)
VALUES ('admin@admin.com', '123', 'admin');