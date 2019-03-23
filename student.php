<?php

class Student implements \JsonSerializable {
	private $id = null;
	private $email = null;
	private $age = null;
	private $schoolLevel = null;
	private $isExperienced = null;
	private $preferredArea = null;


	public function __construct($email, $age, $schoolLevel, $isExperienced, $preferredArea, $id = -1) {
		$this->email = $email;
		$this->age = $age;
		$this->schoolLevel = $schoolLevel;
		$this->isExperienced = $isExperienced;
		$this->preferredArea = $preferredArea;
		$this->id = $id;
	}

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		return $this->$attribute = $value;
	}

	public function jsonSerialize() {
		return get_object_vars($this);
	}
}

?>