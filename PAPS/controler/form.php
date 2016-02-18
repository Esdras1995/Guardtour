<?php 
	
	require_once("../model/session.php");
	require_once('../model/models.php');

  	// $post = new Post();
  	// $guard = new Guard();
  	// $guardTours = new GuardTours();
  	

	/**
	* 
	*/
	class Form
	{
		private $tours;
		private $user;
		private $model;

		function __construct()
		{
			# code...
			$this->tours = new Tours();
		    $this->user = new User();
		    $this->model = new Model();
		}

		/* On post set all data for specified model and return the list data to add */

		public function listToAdd($column, $post){
			$listToAdd = array();

			foreach ($post as $key => $value) {
				# code...
				if(in_array($key, $column)){
					$listToAdd[$key] = $this->securite_bdd(strip_tags($value));
				}
			}

			return $listToAdd;
		}


		/* Register all data. */
		public function register($table, $value){
			# code...
			
			$message = "";

			$listkey = Constants::getListKey()[$table];

			if(!empty($this->listToAdd($listkey, $value)))
				$listToAdd = $this->listToAdd($listkey, $value);
			else
				return '<span class="alert alert-danger"> Something is bad </span>';

			$message = ($this->model->add($table, $listToAdd)) ? '<span class="alert alert-success">Successfully added!</span>' : '<span class="alert alert-danger">Something is bad cannot add that.</span>';

			return $message;
		}

		/* Update specified data. */

		public function update($table, $value, $id){
			
			$listkey = Constants::getListKey()[$table];
			
			if(!empty($this->listToAdd($listkey, $value)))
				$listToAdd = $this->listToAdd($listkey, $value);
			
			else
				return '<span class="alert alert-danger">Something is bad</span>';

			if($this->model->update($table, $listToAdd, "id=".$id)){
				return 1;
			}
		}

		private function securite_bdd($string){

			// On regarde si le type de string est un nombre entier (int)
			if(ctype_digit($string)){
				$string = intval($string);
			}
			
			// Pour tous les autres types
			else{
				$string = htmlspecialchars($string);
				$string = addcslashes($string, '%_');
			}

			return $string;
		}


	}
 ?>