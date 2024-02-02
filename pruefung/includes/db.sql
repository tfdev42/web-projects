CREATE DATABASE IF NOT EXISTS pruefung_20240131;
USE pruefung_20240131;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL UNIQUE KEY,
    user_pwd_hash VARCHAR(255) NOT NULL,
    user_role ENUM ('agent', 'customer') NOT NULL DEFAULT 'customer'
);

CREATE TABLE product (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    is_new TINYINT(1) DEFAULT 1,
    product_name VARCHAR(255)
);


CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    fk_user_id INT,
    fk_product_id INT,
    order_status ENUM ('pending', 'approved', 'denied', 'canceled', 'done') DEFAULT 'pending',
    order_comment VARCHAR(255),
    FOREIGN KEY (fk_user_id) REFERENCES users(user_id),
    FOREIGN KEY (fk_product_id) REFERENCES product(product_id)
);




INSERT INTO product (is_new, product_name) VALUES
(1, 'Product A'),
(1, 'Product B'),
(1, 'Product C'),
(1, 'Product D'),
(1, 'Product E'),
(0, 'Product F'),
(0, 'Product G'),
(0, 'Product H'),
(0, 'Product I'),
(0, 'Product J'),
(1, 'Product K'),
(1, 'Product L'),
(1, 'Product M'),
(1, 'Product N'),
(1, 'Product O');


-- For products with is_new = 1
INSERT INTO orders (fk_user_id, fk_product_id, order_status, order_comment) VALUES
(3, 1, 'approved', 'Great product!'),
(3, 2, 'pending', ''),
(3, 4, 'denied', 'Out of stock'),
(4, 3, 'pending', ''),
(4, 5, 'approved', 'Fast delivery'),
(4, 6, 'approved', ''),
(5, 7, 'canceled', 'Changed my mind'),
(5, 9, 'pending', ''),
(5, 11, 'done', 'Received with thanks'),
(3, 8, 'approved', 'Awesome!'),
(3, 10, 'denied', 'Not what I expected'),
(4, 12, 'pending', ''),
(4, 13, 'approved', 'Good quality'),
(4, 14, 'done', ''),
(5, 15, 'pending', '');

-- For products with is_new = 0
INSERT INTO orders (fk_user_id, fk_product_id, order_status, order_comment) VALUES
(5, 1, 'approved', 'Repeat purchase'),
(3, 2, 'pending', ''),
(3, 4, 'approved', 'Satisfied'),
(4, 3, 'denied', 'Not available'),
(4, 5, 'done', 'Received as expected'),
(4, 6, 'approved', 'Happy with the product'),
(5, 7, 'canceled', 'Found a better deal'),
(5, 9, 'approved', ''),
(5, 11, 'approved', ''),
(3, 8, 'denied', 'Product not as described'),
(3, 10, 'done', ''),
(4, 12, 'approved', 'Excellent'),
(4, 13, 'pending', ''),
(4, 14, 'approved', 'Recommended'),
(5, 15, 'pending', '');