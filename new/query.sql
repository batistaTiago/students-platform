<?php


$mainTableQueryBackUp = '
	CREATE TABLE 
		students_table 
	(student_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	student_email VARCHAR(60) NOT NULL, 
	student_password VARCHAR(32) NOT NULL, 
	student_is_active BOOLEAN NOT NULL DEFAULT FALSE, 
	student_birthday DATE NOT NULL, 
	student_school_level VARCHAR(20) NOT NULL, 
	student_is_experienced BOOLEAN NOT NULL, 
	student_preferred_area VARCHAR(20) NOT NULL, 
	student_account_confirmation_hash VARCHAR(32) NOT NULL)';

$mainTableCreationQuery = '
	CREATE TABLE 
		students_table 
	(student_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	student_email VARCHAR(60) NOT NULL, 
	student_password VARCHAR(32) NOT NULL, 
	student_is_active BOOLEAN NOT NULL DEFAULT FALSE, 
	student_birthday DATE NOT NULL, 
	student_school_level_id INT NOT NULL, 
	student_is_experienced BOOLEAN NOT NULL, 
	student_preferred_area_id INT NOT NULL, 
	student_account_confirmation_hash VARCHAR(32) NOT NULL)';

$schoolLevelTableCreationQuery = '
	CREATE TABLE 
		school_levels_table 
	(school_level_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	description VARCHAR(20) NOT NULL);

	INSERT INTO
		school_levels_table
	(description) VALUES ("Fundamental"), ("Médio"), ("Pré-vestibular")
';

$preferredAreaTableCreationQuery = '
	CREATE TABLE 
		preferred_area_table 
	(preferred_area_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	description VARCHAR(20) NOT NULL);

	INSERT INTO
		preferred_area_table
	(description) VALUES ("Exatas"), ("Tecnológica"), ("Biológicas"), ("Humanas"), ("Saúde")
'

?>