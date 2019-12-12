<?php

class Net_EPP {

	/**
	 * load a class by giving it's short name
	 * @return boolean
	 */
	static function autoload($class) {
		$prefix = __CLASS__.'_';

		if ($prefix == substr($class, 0, strlen($prefix))) {
			$basedir=dirname(dirname(__FILE__));
			debug_log("class name is {$class} from dir {$basedir}");
			
			$file = $basedir.'/'.str_replace('_', '/', $class).'.php';
			if(!file_exists($file)){
				debug_log("the file {$file} does not exist");
				return false;
			}
			
			return include_once($file);

		} else {
			return false;

		}
	}
}

spl_autoload_register(array('Net_EPP', 'autoload'));
