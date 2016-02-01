<?php

require_once("../model/models.php");

/**
* 
*/

class Post extends Model
{
	private $formModel;

	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function setForm($formModel){

		$this->formModel = $formModel;
	}

	public function getForm(){
		
		return $this->formModel;
	}

}


class Guard extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
}


class Tours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

}


class GuardTours extends Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
}






















?>