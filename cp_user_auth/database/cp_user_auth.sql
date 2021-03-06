DROP DATABASE IF EXISTS cp_user_auth;
CREATE DATABASE IF NOT EXISTS cp_user_auth DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE cp_user_auth;

CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(128),
	password VARCHAR(128),
	email VARCHAR(128),
	role VARCHAR(64),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL,
	status tinyint(1) NOT NULL DEFAULT '1'
);
