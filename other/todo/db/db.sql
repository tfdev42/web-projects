CREATE DATABASE IF NOT EXISTS 20231008_todo;
USE 20231008_todo;

CREATE TABLE IF NOT EXISTS todo (
    id INT AUTO_INCREMENT NOT NULL,
    description VARCHAR(255) NOT NULL,
    state TINYINT(1) NOT NULL,
    PRIMARY KEY (id)
);