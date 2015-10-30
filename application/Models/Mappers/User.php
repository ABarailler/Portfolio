<?php

namespace App\Models\Mappers;


class User extends \My\DB
{
	public function  __construct($dsn = null, $username = null, $password = null){
		$this->getInstance($dsn, $username, $password);
	}
	/*
	 * 	Trouve un utilisateur en fonction de son id et retourne un objet User
	 *	@param $id integer Id de l'utilisateur
	 *	@return $user \App\Models\User
	 */
	public function find($id) // R
	{
		// Fausse récupération en BDD (mock, simulation)
		$userData = array(
			'id' => 3, 
			'name' => 'Utilisateur1', 
			'email' => 'test@test.com',
			'login' => 'user1');
			
		$user = new \App\Models\User();
		$user->setId($userData['id'])
			 ->setName($userData['name'])
			 ->setEmail($userData['email'])
			 ->setLogin($userData['login']);

		return $user;
	}

	/*
	 * Modéle requéte : 
	 * 
	 * INSERT INTO  `throne`.`user` ( `id` , `login` , `name` ,	`email`)
		VALUES (NULL ,  'testLogin',  'testName',  'testEmail@test.fr');
	 * 
	 */
	
	public function save(\App\Models\User $user)
	{
		$query = 'INSERT INTO  `throne`.`user` (';
		$val = '';
		foreach($user->getAll() as $col => $value){
			$query .= '`' . $col . '`,';
			if ($value == null){
				$val .= 'NULL ,';
			}else{
				$val .= '"' . $value . '",';
			}	
		}
		$query = trim($query, ',');
		$val = trim($val, ',');
		$query .= ') VALUES (' . $val .');';
		
		
		return (bool) self::$link->query($query);
	}

	public function delete(\App\Models\User $user)
	{
		// ...
	}
	
	/*
	 * SELECT * FROM `nameTable` WHERE 1
	 */
	public function getContentTable($nameTable){
		$query = 'SELECT * FROM `'. $nameTable .'` WHERE 1';
		return self::$link->query($query);
	}
}