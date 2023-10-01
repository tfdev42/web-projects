-- DDL: Data Definition Language

CREATE TABLE person (
    id INT AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    height_cm DECIMAL(4,1) NOT NULL,
    weight_kg DECIMAL(5,2) NOT NULL,
    PRIMARY KEY(id)
);