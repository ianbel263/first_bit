DROP DATABASE IF EXISTS first_bit;
CREATE DATABASE first_bit
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE first_bit;

CREATE TABLE user (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    pwd      VARCHAR(255) NOT NULL,
    first_name VARCHAR(64),
    middle_name VARCHAR(64),
    last_name VARCHAR(64),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

