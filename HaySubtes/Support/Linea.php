<?php namespace HaySubtes\Support;

class Linea {

	public $name;
	public $status;
	public $statusText;
	public $statusCSS;
	public $statusMessage;

	public function __construct($name = 'A', $status = 'NORMAL') {
		$this->name = $name;
		$this->status = $status;
	}

}
