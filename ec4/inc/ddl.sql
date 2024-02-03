CREATE DATABASE IF NOT EXISTS ecommerce_template;
USE ecommerce_template;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(15) NOT NULL,
    user_email VARCHAR(255) NOT NULL UNIQUE KEY,
    user_pwd_hash VARCHAR(255) NOT NULL,    
    user_role ENUM ('customer', 'admin') DEFAULT 'customer',
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_user_id INT,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cart_status ENUM ('open', 'closed') DEFAULT 'open',
    FOREIGN KEY (fk_user_id) REFERENCES users(user_id)
);

CREATE TABLE product (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_article_number VARCHAR(100) NOT NULL UNIQUE KEY,
    product_name VARCHAR(255) NOT NULL UNIQUE KEY,
    product_desc TEXT NOT NULL,
    product_available TINYINT(1) DEFAULT 1,
    product_price DECIMAL(10, 2) NOT NULL,
    product_img_path VARCHAR(255),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart_item (
    cart_item_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_cart_id INT,
    fk_product_id INT,
    quantity SMALLINT NOT NULL,
    FOREIGN KEY (fk_cart_id) REFERENCES cart(cart_id),
    FOREIGN KEY (fk_product_id) REFERENCES product(product_id)
);

CREATE TABLE addresses (
    address_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_user_id INT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    street VARCHAR(255) NOT NULL,
    zip VARCHAR(50) NOT NULL,
    address_type ENUM ('billing', 'delivery') NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fk_user_id) REFERENCES users(user_id)
);


CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_user_id INT,
    fk_cart_id INT,
    fk_billing_address INT,
    fk_delivery_address INT,
    order_price DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_payment_type ENUM ('bill', 'visa') NOT NULL,
    FOREIGN KEY (fk_user_id) REFERENCES users(user_id),
    FOREIGN KEY (fk_cart_id) REFERENCES cart(cart_id),
    FOREIGN KEY (fk_billing_address) REFERENCES addresses(address_id),
    FOREIGN KEY (fk_delivery_address) REFERENCES addresses(address_id)
);
