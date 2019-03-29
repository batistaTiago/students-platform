<?php


namespace MF\Model;

abstract class Model {

	protected $connection;

	public function __construct(\PDO $db) {
		$this->connection = $db;
	}
}


?>