<?php
	// Assign Variables
	$email = $username = $messageTemp = $subjectTemp = null;
	$errors = array();

	// Check Entries
	if (isset($_POST['send']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'))){
		if(!(isset($_POST['username']) && !empty($_POST['username']))){
			$errors['username'] =  "Nom requis...";
		}else{
			$username = $_POST['username'];
			if(strpos($username , '@') !== false){
				$errors['username'] = ' "@" non autorisé dans le nom de l\'utilisateur';
			} elseif(strlen($username) < 3 ) {
				$errors['username'] = "Le nom de l'utilisateur doit contenir au moin 3 caractéres";
			}
		}
		if(!(isset($_POST['subject']) && !empty($_POST['subject']))){
			$errors['subject'] =  "Sujet requis...";
		}else{
			$subjectTemp = $_POST['subject'];
			if(strpos($subjectTemp , '@') !== false){
				$errors['subject'] = ' "@" non autorisé dans l\'objet';
			} elseif(strlen($subjectTemp) < 3) {
				$errors['subject'] = "L'objet doit contenir au moin 3 caractéres";
			}
		}
		if(!(isset($_POST['message']) && !empty($_POST['message']))){
			$errors['message'] = "Message requis...";
		}else{
			$messageTemp = $_POST['message'];
		}
		if(!(isset($_POST['email']) && !empty($_POST['email']))){
				$errors['email'] = 'Email requis';
			} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email invalide';
			} else {
				$email = $_POST['email'];
			}

	// If no errors, send mail
		if (count($errors) === 0){
			$to      = 'alix.barailler@gmail.com';
	   		$subject = $subjectTemp;
	    	$message = $messageTemp;
	    	$headers = "From: \"".$username."\" <".$email.">" . "\r\n";
			$test = mail($to, $subject, $message, $headers);
		}
	}
?>