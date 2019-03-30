<?php

namespace App\Models;

use MF\Model\Model;
use App\Controllers\MailController;

class DataBaseManager extends Model {

	private $dropMainTableQuery = '
	DROP TABLE students_table';

	private $mainTableCreationQuery = '
	CREATE TABLE 
		students_table(
			student_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
			student_email VARCHAR(60) NOT NULL, 
			student_password VARCHAR(32) NOT NULL, 
			student_is_active BOOLEAN NOT NULL DEFAULT FALSE, 
			student_name VARCHAR(100) NOT NULL,
			student_birthday DATE NOT NULL, 
			student_school_level_id INT NOT NULL, 
			student_is_experienced BOOLEAN NOT NULL, 
			student_preferred_area_id INT NOT NULL, 
			student_account_confirmation_hash VARCHAR(32) NOT NULL
		)';







	private $dropSchoolLevelsTableQuery = '
	DROP TABLE school_levels_table;';

	private $schoolLevelsTableCreationQuery = '
	CREATE TABLE 
		school_levels_table(
			school_level_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
			description VARCHAR(20) NOT NULL
		);';

	private $schoolLevelsTableEntryAdditionQuery = '
	INSERT INTO
	school_levels_table
	(description) VALUES ("Fundamental"), ("Médio"), ("Pré-vestibular");
	';







	private $dropPreferredAreasTableQuery = '
	DROP TABLE preferred_areas_table;';


	private $preferredAreasTableCreationQuery = '
	CREATE TABLE 
		preferred_areas_table(
			preferred_area_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
			description VARCHAR(20) NOT NULL
		);';


	private $preferredAreasTableEntryAdditionQuery = '
	INSERT INTO
	preferred_areas_table
	(description) VALUES ("Exatas"), ("Tecnológica"), ("Biológicas"), ("Humanas"), ("Saúde")
	';
	




	private $dropResetPasswordRequestsTableQuery = '
	DROP TABLE reset_password_requests_table;';

	private $resetPasswordRequestsTableCreationQuery = '
	CREATE TABLE
		reset_password_requests_table(
			password_request_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			requesting_user_id INT NOT NULL,
			request_hash_validation VARCHAR(32) NOT NULL
	);
	';




	

	public function initDataBase() {
		$queries = [
			$this->dropMainTableQuery,
			$this->mainTableCreationQuery,
			$this->dropSchoolLevelsTableQuery,
			$this->schoolLevelsTableCreationQuery,
			$this->schoolLevelsTableEntryAdditionQuery,
			$this->dropPreferredAreasTableQuery,
			$this->preferredAreasTableCreationQuery,
			$this->preferredAreasTableEntryAdditionQuery,
			$this->dropResetPasswordRequestsTableQuery,
			$this->resetPasswordRequestsTableCreationQuery
		];

		foreach ($queries as $key => $query) {
			echo "<large><strong>Running Query</strong></large>: <br><br><br> $query <br><br><br>";
			$statement = $this->connection->prepare($query);
			$result = $statement->execute();
			echo "Resultado: $result <br> <br> <hr>";
		}
	}

}