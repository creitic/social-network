<?php 
session_start();
require('includes/functions.php');
set_flash('Tout va bien!');

var_dump($_SESSION);


https://www.pakainfo.com/paypal-payment-gateway-integration-in-php-codeigniter-example/


$requete="ALTER TABLE users add COLUMN city VARCHAR(255),
add COLUMN country VARCHAR(255),
add COLUMN sexe ENUM('H','F'),
add COLUMN twitter VARCHAR(255),
add COLUMN github VARCHAR(255),
add COLUMN available_for_hiring ENUM('0','1') DEFAULT '0',
add COLUMN bio TEXT";

ALTER TABLE produits ADD COLUMN isext TINYINT NULL DEFAULT 0;

ALTER TABLE ventes ADD COLUMN islastecredit TINYINT NULL DEFAULT 0;

CREATE TABLE codes(id INT(11) AUTO_INCREMENT PRIMARY KEY, code TEXT);

truncate codes;
CREATE TABLE microposts(id INT PRIMARY KEY AUTO_INCREMENT,content TEXT,user_id INT,created_at DATETIME DEFAULT NOW(),FOREIGN KEY (user_id) REFERENCES users(id));

DESCRIBE microposts;
ALTER TABLE users DROP COLUMN avatar; 
ALTER TABLE users ADD COLUMN avatar VARCHAR(255);

CREATE TABLE auth_tokens(id INT PRIMARY KEY AUTO_INCREMENT,selector VARCHAR(20),expires DATETIME,user_id INT UNSIGNED NOT NULL ,token VARCHAR(64), UNIQUE(selector),FOREIGN KEY (user_id) REFERENCES users(id));

ALTER TABLE auth_tokens ADD COLUMN id INT PRIMARY KEY AUTO_INCREMEN FIRST;

CREATE TABLE friends_relationships(user_id1 INT,user_id2 INT,status ENUM('0','1','2') DEFAULT '0',created_at DATETIME DEFAULT NOW(),PRIMARY KEY (user_id1,user_id2),FOREIGN KEY (user_id1) REFERENCES users(id),FOREIGN KEY (user_id2) REFERENCES users(id));

CREATE TABLE micropost_like(id INT PRIMARY KEY AUTO_INCREMENT,user_id INT,micropost_id INT ,
	created_at DATETIME DEFAULT NOW(),FOREIGN KEY (user_id) REFERENCES users(id),FOREIGN KEY (micropost_id) REFERENCES microposts(id));

ALTER TABLE microposts ADD COLUMN like_count INT DEFAULT 0;

ALTER TABLE micropost_like ADD CONSTRAINT FOREIGN KEY(micropost_id) REFERENCES microposts(id) ON DELETE CASCADE;

//ON UPDATE CASCADE;
CREATE TABLE notifications( id INT PRIMARY KEY AUTO_INCREMENT, subject_id INT(11), name VARCHAR(255), user_id INT(11), created_at DATETIME DEFAULT NOW(), seen ENUM('0', '1') DEFAULT '0', FOREIGN KEY (user_id) REFERENCES users(id) );


ALTER TABLE nom_table ADD FULLTEXT [nom_index] (colonne_index [, colonne2_index ...]); -Ajout d'un index fulltext
INT(4) ZEROFILL
