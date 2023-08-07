-- DDL> Data Definition Language
-- User(-id, email[UK], password, name, birthdate, admin, newsletter)


CREATE TABLE user (
    id INT AUTO_INCREMENT,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(100) NOT NULL,
    name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    admin TINYINT(1) NOT NULL DEFAULT 0,
    newsletter TINYINT(1) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY(email)
);

-- Comment(-id, user_id[FK], title, content, published_date, approved)

CREATE TABLE comment (
    id INT AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    published_date TIMESTAMP NOT NULL,
    approved TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES user(id)
);