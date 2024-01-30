CREATE DATABASE IF NOT EXISTS _20240129_ec3;
USE _20240129_ec3;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMET,
    user_pwd_hash VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL UNIQUE KEY,
    created_on DATE DEFAULT NOW()
);

CREATE TABLE cart (
    cart_id INT PRIMARY KEY AUTO_INCREMET,
    fk_user_id (INT),
    created_on DATE DEFAULT NOW(),
    cart_status ENUM ("open", "closed") DEFAULT "open",
    FOREIGN KEY (fk_user_id) REFERENCES (users.user_id)
);

CREATE TABLE product (
    product_id INT PRIMARY KEY AUTO_INCREMET,
    article_nr VARCHAR(100) NOT NULL UNIQUE KEY,
    product_name VARCHAR(255) NOT NULL UNIQUE KEY,
    product_desc TEXT NOT NULL,
    product_available TINYINT(1) DEFAULT 1,
    product_price DECIMAL(10, 2),
    product_img_path VARCHAR(255)
);

CREATE TABLE cart_item (
    cart_item_id INT PRIMARY KEY AUTO_INCREMET,
    fk_cart_id INT,
    fk_product_id INT,
    quantity SMALLINT,
    FOREIGN KEY (fk_cart_id) REFERENCES (cart.cart_id),
    FOREIGN KEY (fk_product_id) REFERENCES (product.product_id)
);

CREATE TABLE addresses (
    address_id INT PRIMARY KEY AUTO_INCREMET,
    fk_user_id INT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    street VARCHAR(255) NOT NULL,
    zip VARCHAR(50) NOT NULL,
    address_type ENUM ("billing", "delivery") NOT NULL,
    FOREIGN KEY (fk_user_id) REFERENCES (users.user_id)
);


CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMET,
    fk_user_id INT,
    fk_cart_id INT,
    fk_billing_addr INT,
    fk_delivery_addr INT,
    order_price DECIMAL(10,2),
    order_date DATE DEFAULT NOW,
    order_payment_type DEFAULT "bill",
    FOREIGN KEY (fk_user_id) REFERENCES (users.user_id),
    FOREIGN KEY (fk_cart_id) REFERENCES (cart.cart_id),
    FOREIGN KEY (fk_billing_addr) REFERENCES (addresses.address_id),
    FOREIGN KEY (fk_delivery_addr) REFERENCES (addresses.address_id)
);

INSERT INTO users (user_email, user_pwd_hash) VALUES ("admin@admin.com", "123");