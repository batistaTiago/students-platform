<?php

class Student implements \JsonSerializable {
	private $id = null;
	private $email = null;
	private $birthday = null;
	private $schoolLevel = null;
	private $isExperienced = null;
	private $preferredArea = null;


	public function __construct($email, $birthday, $schoolLevel, $isExperienced, $preferredArea, $id = -1) {
		$this->email = $email;
		$this->birthday = $birthday;
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