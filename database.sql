CREATE DATABASE resume_builder;
USE resume_builder;
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100),
password VARCHAR(50)
);
CREATE TABLE resume (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100),
phone VARCHAR(15),
education TEXT,
skills TEXT,
projects TEXT
);