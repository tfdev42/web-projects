-- INSERT

INSERT INTO users(username, pwd, email)
VALUES ('Tom', 'tom123', 'tom@example.com');

INSERT INTO users(username, pwd, email)
VALUES ('Bob', 'Bob123', 'bob@example.com');


-- UPDATE

UPDATE users SET username = 'Bobby', pwd = 'Bobby123'
WHERE id = 2 AND pwd = 'Bob123';


-- DELETE

DELETE FROM users
WHERE id = 1;
-- next INSERT is id=3


-- add comment
INSERT INTO comments(username, comment_text, users_id)
VALUES ('Tom', 'This is a comment on a website', '1');



-- SELECT

SELECT username, email
FROM users
WHERE id=1;


SELECT username, comment_text
FROM comments
WHERE users_id=1;


-- JOIN

SELECT *
FROM users
INNER JOIN comments ON users.id = comments.id;


SELECT *
FROM users
LEFT JOIN comments ON users.id = comments.id;