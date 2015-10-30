<?php

namespace App\Controllers;

use My\Controller;
class Index extends \My\Controller{
	private $bd;
	
	public function action() {
		$config = new \My\Config(ROOT_PATH . '/application/Configs/application.ini', ENV);
		$this->bd = new \App\Models\Mappers\User($config->toArray('pdo')['dsn'], $config->toArray('pdo')['username'], $config->toArray('pdo')['password']);
		$this->view->resultPerso  = $this->aboutMe();
		$this->view->languages = $this->language();
		$this->view->hobbies = $this->Hobbies();
		$this->view->skills = $this->skill();
		$this->view->schooling = $this->schooling();
		$this->view->career = $this->career();
		$this->view->achievement = $this->achievements();
	}
	
	public function aboutMe(){
		$resultPerso = $this->bd->getContentTable("info_perso");
		return $resultPerso->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function language(){
		$resultLanguages = $this->bd->getContentTable("languages");
		$languages = $resultLanguages->fetchAll(\PDO::FETCH_ASSOC);
		$language = '<p><strong>Langues : </strong>';
		$flag = 0;
		foreach ($languages as $value){
			if($flag === 0){
				$language .= $value['name'] . ', ';
			}else{
				$language .= strtolower($value['name']) . ', '; 
			}
			$flag++;
		}
		$language = trim($language, ', ');
		$language .= '</p>';
		return $language;
	}
	
	public function Hobbies(){
		$resultHobbies = $this->bd->getContentTable("hobbies");
		$hobbies = $resultHobbies->fetchAll(\PDO::FETCH_ASSOC);
		$hobbie = '<p><strong>Loisirs : </strong>';
		$flag = 0;
		foreach ($hobbies as $value){
			if($flag === 0){
				$hobbie .= $value['name'] . ', ';
			}else{
				$hobbie .= strtolower($value['name']) . ', ';
			}
			$flag++;
		}
		$hobbie = trim($hobbie, ', ');
		$hobbie .= '</p>';
		return $hobbie;
	}
	
	
	public function skill(){
		$resultSkills = $this->bd->getContentTable("skills");
		$skills = $resultSkills->fetchAll(\PDO::FETCH_ASSOC);
		$skill = '<div class="row">';
		$flag = 0;
		foreach ($skills as $value){
			if ( $flag === 4){
				$flag = 0;
				$skill .= '</div>';
				$skill .= '<div class="row">';
			}
			
			if ($flag === 0){
				$skill .= '<div class="col-xs-6 col-sm-2 col-sm-offset-2 competence-icone">';
			}else{
				$skill .= '<div class="col-xs-6 col-sm-2 competence-icone">';
			}
			$skill .= '<a href="' . $value["link"] . '" class="competences-link" target="_blank">';
			$skill .= '<img src="' . $value["link_image"] . '" class="img-responsive" alt="logo '. $value["name"] .'"/>';
			$skill .= '<p class="name-competences">' . $value["name"] . '</p>';
			$skill .= '</a>';
			$skill .= '</div>';
			$flag++;
		}
		$skill .= '</div>';
		return $skill;
	}
	
	public function achievements(){
		$resultAchievements = $this->bd->getContentTable("achievements");
		$achievements = $resultAchievements->fetchAll(\PDO::FETCH_ASSOC);
		$content = '<div class="row">';
		foreach ($achievements as $value){
			$content .= '<div class="col-xs-12 col-sm-6 mg-image" >';
			$content .= '<div class="content-img">';
			$content .= '<a href="' . $value['link'] . '"><img src="' . $value['link_image'] . '" alt="miniature ' . $value['name'] . '" class="img-responsive"></a>';
			$content .= '</div>';
			$content .= '</div>';
		}
		$content .= '</div>';
		return $content;
	}
	
	public function schooling(){
		$resultSchooling = $this->bd->getContentTable("schooling");
		$schooling = $resultSchooling->fetchAll(\PDO::FETCH_ASSOC);
		$content = '<ul>';
		foreach ($schooling as $value){
			$content .= '<li>';
			$content .= '<p class="date">' . $value['date'] . '</p>';
			$content .= '<p class="name-form">' . $value['name_training'];
			if (!$value['name_school'] == null){
				$content .= ' - ' . $value['name_school'];
			}
			$content .= '</p>';
			$content .= '<p class="place">' . $value['city'] . '</p>';
			$content .= '<p class="description">' . $value['description'] . '</p>';
			$content .= '</li>';
		}
		$content .= '</ul>';
		return $content;
	}
	
	public function career(){
		$resultCareer = $this->bd->getContentTable("career");
		$career = $resultCareer->fetchAll(\PDO::FETCH_ASSOC);
		$content = '<ul>';
		foreach ($career as $value){
			$content .= '<li>';
			$content .= '<p class="date">' . $value['date'] . '</p>';
			$content .= '<p class="name-form">' . $value['post'];
			if (!$value['entreprise'] == null){
				$content .= ' - ' . $value['entreprise'];
			}
			$content .= '</p>';
			$content .= '<p class="place">' . $value['city'] . '</p>';
			$content .= '<p class="description">' . $value['description'] . '</p>';
			$content .= '</li>';
		}
		$content .= '</ul>';
		return $content;
	}

}