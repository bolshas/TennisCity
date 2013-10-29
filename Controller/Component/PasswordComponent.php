<?php

App::uses('Component', 'Controller');

class PasswordComponent extends Component {

	public function random($length = 40) {
		$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";
		$password = array();
		$len = strlen($alphabet) - 1;

		for ($i = 0; $i < $length; $i++) {
			$char = rand(0, $len);
			$password[] = $alphabet[$char];
		}
		return implode($password);
	}
}