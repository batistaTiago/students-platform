<?php

namespace App\Models;

use MF\Model\Model;
use App\Controllers\MailController;

class PasswordResetRequest extends Model {

	private $id;
	private $userId;
	private $securityCode;


	public function registrarNovaRequisicao($userId) {
		$hash = md5(rand(0,10000));

		echo '<br> requesting_user_id = ' . $userId . '<hr>';
		echo '<br> hashed_requesting_user_id = ' . md5($userId) . '<hr>';

		$query = '
			INSERT INTO
				reset_password_requests_table
			(requesting_user_id, request_hash_validation) VALUES
			(?, ?)
		';
		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, md5($userId));
		$statement->bindValue(2, $hash);
		echo $statement->execute();
	}

}