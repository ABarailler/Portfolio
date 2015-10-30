<?php
namespace My;

class Config{

	protected $config = array();

	public function __construct($path, $environment){
		
		$array = parse_ini_file($path, true);

		if(isset($array[$environment])){
			$array = $this->process_key($array[$environment]);
			if(isset($array['config']) && !empty($array['config'])){
				foreach ($array['config'] as $subPath) {
					$self = new self($subPath, $environment);
					$this->config = $self->toArray();
				}
			}
			$this->config = array_merge($this->config, $array);
		} else {
			// Gestion erreur 
		}

	}
	
	/**
	 * @TODO Passer en récursif la méthode
	 */
	public function process_key(array $array){
		$newarray = array();
		foreach ($array as $key => $value) {
			if($pos = strpos($key, ".")){
				$newarray[substr($key, 0, $pos)][substr($key, $pos+1)] = $value;
			} else {
				$newarray[$key] = $value;
			}
		}
		return $newarray;
	}

	public function toArray($key = null){
		if($key === null){
			return $this->config;
		} elseif(isset($this->config[$key])) {
			return $this->config[$key];
		}
	}
}