<?php

namespace My;

class DataFilter 
{
	
	public static function isValidString($string, $options = null) 
	{
		if (array_key_exists('minLength', $options)) {
			$minLength = $options['minLength'];
		} else {
			$minLength = 1;
		}

		if (array_key_exists('maxLength', $options)) {
			$maxLength = $options['maxLength'];
		} else {
			$maxLength = 50;
		}

		if (array_key_exists('caseSensitive', $options)) {
			$caseSensitive = $options['caseSensitive'];
		} else {
			$caseSensitive = true;
		}

		$regExp = '/^[a-z0-9]{' . $minLength . ',' . $maxLength . '}$/' . ($caseSensitive ? 'i' : '');
		
		return (bool) filter_var(
				$string, 
				FILTER_VALIDATE_REGEXP, 
				array ('options' => array('regexp' => $regExp))
			);	
	}

	public static function isValidEmail($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}