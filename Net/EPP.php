<?php

class Net_EPP {

	static function autoload($class) {
		$prefix = __CLASS__.'_';

		if ($prefix == substr($class, 0, strlen($prefix))) {
			debug_log($class);
			$file = dirname(__FILE__).'/'.str_replace('_', '/', $class).'.php';
			debug_log($file);
			return (file_exists($file) && @include_once($file));

		} else {
			return false;

		}
	}
}

spl_autoload_register(array('Net_EPP', 'autoload'));
