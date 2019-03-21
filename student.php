<?php


class Student {
	private $id = null;
	private $email = null;
	private $age = null;
	private $schoolLevel = null;
	private $isExperienced = null;
	private $preferredArea = null;


	public function __construct($id, $email, $age, $schoolLevel, $isExperienced, $perefferedArea) {
		$this->id = $id;
		$this->email = $email;
		$this->age = $age;
		$this->schoolLevel = $schoolLevel;
		$this->isExperienced = $isExperienced;
		$this->perefferedArea = $perefferedArea;
	}
}