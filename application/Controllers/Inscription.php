<?php

namespace App\Controllers;


use App\Models\Mappers\User;
class Inscription extends \My\Controller
{
	public function action()
	{
		$this->view->errors = array();
		// Si la requète est en POST
		if ($this->request->isPost()) {
			// Récupère les données du formulaire
			$formData = $this->request->getParams();
			// puis valide les données du formulaire
			$errors = array();
			$filterOptions = array('maxLength' => 40);
			if (!array_key_exists('inputName', $formData) ||
				false === \My\DataFilter::isValidString($formData['inputName'], $filterOptions)) {
				$errors[] = 'Le champ "Nom" est invalide';
			}

			if (!array_key_exists('inputLogin', $formData) || 
				false === \My\DataFilter::isValidString($formData['inputLogin'], $filterOptions)) {
				$errors[] = 'Le champ "Identifiant" est invalide';
			}

			if (!array_key_exists('inputEmail', $formData) ||
				false === \My\DataFilter::isValidEmail($formData['inputEmail'])) {
				$errors[] = 'Le champ "E-mail" est invalide';
			}

			$this->view->errors = $errors;

			if (0 === count($errors)) {
				$user = new \App\Models\User;
				$user->setName($formData['inputName'])
					 ->setLogin($formData['inputLogin'])
					 ->setEmail($formData['inputEmail']);
				$bd = new \App\Models\Mappers\User('mysql:dbname=throne;host=127.0.0.1', 'root', '0000');
				$this->view->success = $bd->save($user);
				
				// redirection en cas de success vers l'index
				if ($this->view->success){
					// todo 
					header('location: index.phtml');
				}
			
			}

		}
	}
}