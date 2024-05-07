-- Create database
CREATE DATABASE IF NOT EXISTS blogg;
USE blogg;

-- Create tables
CREATE TABLE IF NOT EXISTS users (
    userId int NOT NULL AUTO_INCREMENT,
    userFullName varchar(255) NOT NULL,
    loginName varchar(32) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    PRIMARY KEY (userId)
);

CREATE TABLE IF NOT EXISTS bloggtext (
    userId int NOT NULL,
    bloggtext varchar(1000),
    datetime datetime,
    FOREIGN KEY (userId) REFERENCES users(userId)
);


-- Create user entries
INSERT IGNORE INTO users (userFullName, loginName, password) VALUES(
    "Oliver Lindell",
    "oli",
    "abc123!"
);

INSERT IGNORE INTO users (userFullName, loginName, password) VALUES(
    "Salar Asker Zada",
    "salar",
    "sakertlosen456!"
);

INSERT INTO bloggtext (userId, bloggtext, datetime, author) VALUES(
    1,
    "# Välkommen till bloggen!\nTest ny rad",
    "2024-05-04 21:11:00"
);
