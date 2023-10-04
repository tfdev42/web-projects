-- Attributes
-- user(ID(PK), fname, lname, email(UK), password, street, country, city, zip, paymethod, IBAN, isAdmin)
-- product(ID(PK), name, description, pricePerMinute)
-- insurance(ID(PK), CustomerId(FK), productId(FK), status, start, end, comment, kennzeichen)

CREATE DATABASE IF NOT EXISTS 