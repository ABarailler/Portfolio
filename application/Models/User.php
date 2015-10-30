<?php

namespace App\Models;

class User{
	private $id;
	private $name;
	private $email;
	private $login;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}
	
	public function getAll(){
		$array = array();
		foreach ($this as $key => $value){
			$array[$key] = $value;
		}
		return $array;
	}
}