<?php

namespace App\Models;

use MF\Model\Model;
use App\Controllers\MailController;

class PasswordResetRequest extends Model {

	private $id;
	private $userId;
	private $userEmail;
	private $securityCode;

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		$this->$attribute = $value;
	}


	public function registrarNovaRequisicao() {

		echo '<h4>registrarNovaRequisicao()</h4> registrando <hr>';

		$this->__set('securityCode', md5(rand(0,10000)));

		$query = '
		INSERT INTO
		reset_password_requests_table
		(requesting_user_id, requesting_user_email, request_hash_validation) 
		VALUES
		(?, ?, ?)
		';
		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->__get('userId'));
		$statement->bindValue(2, md5($this->__get('userEmail')));
		$statement->bindValue(3, $this->__get('securityCode'));
		$success = $statement->execute();

		if ($success) {
			echo '<h4>registrarNovaRequisicao()</h4> sucesso executando query de registro de requisicao no banco <hr>';

			echo 'id: ' . $this->__get('userId') . '<br>';
			echo 'em: ' . $this->__get('userEmail') . '<br>';
			echo 'cd: ' . $this->__get('securityCode') . '<br>';

			MailController::enviarRedefinicaoDeSenha(
				$this->__get('userEmail'), 
				$this->__get('userId'), 
				$this->__get('securityCode')
			);
		} else {
			echo '<h4>registrarNovaRequisicao()</h4> erro executando query de registro de requisicao no banco <hr>';
			
			echo 'id: ' . $this->__get('userId') . '<br>';
			echo 'em: ' . $this->__get('userEmail') . '<br>';
			echo 'cd: ' . $this->__get('securityCode') . '<br>';

		}

		// return $success;
	}

	public function removerDoBanco() {
		if ($this->requisicaoExiste()) {
			$query = '
			DELETE FROM
			reset_password_requests_table
			WHERE
			requesting_user_id = ?
			AND
			requesting_user_email = ?
			AND
			request_hash_validation = ?
			';

			$statement = $this->connection->prepare($query);
			$statement->bindValue(1, $this->__get('userId'));
			$statement->bindValue(2, $this->__get('userEmail'));
			$statement->bindValue(3, $this->__get('securityCode'));
			$sucesso = $statement->execute();

			echo $sucesso;
		} else {
			echo 'não pude remover o request do banco pois requisicaoExiste() retornou <strong>false</strong>. <br>';
		}
	}

	public function requisicaoExiste() {
		$query = '
		SELECT 
		requesting_user_id,
		requesting_user_email,
		request_hash_validation
		FROM
		reset_password_requests_table
		WHERE
		request_hash_validation = ?
		AND
		requesting_user_email = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->__get('securityCode'));
		$statement->bindValue(2, $this->__get('userEmail'));
		$statement->execute();

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		return ($result != null);
	}

	private function requisicaoValida() {
		$query = '
		SELECT 
		requesting_user_id,
		requesting_user_email,
		request_hash_validation
		FROM
		reset_password_requests_table
		WHERE
		requesting_user_id = ?
		AND
		requesting_user_email = ?
		AND
		request_hash_validation = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->__get('userId'));
		$statement->bindValue(2, $this->__get('userEmail'));
		$statement->bindValue(3, $this->__get('securityCode'));
		$statement->execute();

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		return ($result != null);
	}

	public function fetchUserId() {
		$query = '
		SELECT 
			requesting_user_id
		FROM
		reset_password_requests_table
		WHERE
		request_hash_validation = ?
		';

		$statement = $this->connection->prepare($query);
		$statement->bindValue(1, $this->__get('securityCode'));
		$statement->execute();

		$result = $statement->fetch(\PDO::FETCH_ASSOC);

		$this->__set('userId', $result['requesting_user_id']);

	}

}