<?php 
	
	require_once('../model/models.php');
  	
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
					$listToAdd[$key] = $value;
				}
			}

			return $listToAdd;
		}


		/* Register all data. */
		public function register($table, $value){
			# code...
			$value = $this->securite_mthod($value);
			//print_r($value);
			$message = $this->validationForm($table, $value);

			if($message['error'] === 1){
				$message['error'] = '<span class="alert alert-danger"> Something is wrong!</span>';
				return $message;
			}

			$listkey = Constants::getListKey()[$table];

			if(!empty($this->listToAdd($listkey, $value)))
				$listToAdd = $this->listToAdd($listkey, $value);
			else
				$message['error'] = '<span class="alert alert-danger"> Something is wrong </span>';

			$message['error'] = ($this->model->add($table, $listToAdd)) ? '<span class="alert alert-success">Successfully added!</span>' : '<span class="alert alert-danger">Something is bad cannot add that.</span>';

			return $message;
		}


		public function validationForm($table, $value){
			$message = "";
			switch ($table) {
				
				case 'poste':
					# code...
					$message = PostForm::validation($value);
					break;
				case 'guard':
					# code...
					$message = GuardForm::validation($value);
					break;
				case 'guardtours':
					# code...
					$message = GuardToursForm::validation($value);
					break;
				case 'admin':
					# code...
					$message = UserForm::validation($value);
					break;
				case 'tours':
					# code...
					$message = array('error' => 0);
					break;
				default:
					# code...
					break;
			}

			return $message;
		}




		/* Update specified data. */

		public function update($table, $value, $id){
			
			$message = $this->validationForm($table, $value);

			if($message['error'] === 1){
				$message['error'] = '<span class="alert alert-danger">Something is wrong!</span>';
				return $message;
			}

			$listkey = Constants::getListKey()[$table];
			
			if(!empty($this->listToAdd($listkey, $value)))
				$listToAdd = $this->listToAdd($listkey, $value);
			
			else
				return '<span class="alert alert-danger">Something is wrong</span>';

			if($this->model->update($table, $listToAdd, "id=".$id)){
				if(isset($_SESSION['data'])) unset($_SESSION['data']);
				return 1;
			}

		}

		public function securite_mthod($post){
			$new = array();

			foreach ($post as $key => $value) {
				# code...
				$new[$key] = $this->securite_bdd(strip_tags($value));
			}

			return $new;
		}

		public function securite_bdd($string){

			// On regarde si le type de string est un nombre entier (int)
			if(ctype_digit($string)){
				$string = intval($string);
			}
			// Pour tous les autres types
			else{
				$string = htmlentities(htmlspecialchars($string));
				$string = addcslashes($string, "'");
			}

			return $string;
		}

		public function saveImage($base64img, $extension, $path){
			if(!is_null($base64img)){
			    $base64img = str_replace('data:image/'.$extension.';base64,', '', $base64img);
			    $data = base64_decode($base64img);
			    file_put_contents($path, $data);
			}
		}

		public function base64_encode_image ($filename=string,$filetype=string) {
		    if ($filename) {
		        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
		        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
		    }
		}
	}

	/**
	* 
	*/
	class PostForm
	{
		private $fldData;
		
		function __construct()
		{
			# code...
		}

		public static function validation($post){
		  $message = array('adress'=> '', 'error'=>0);

		  $model = new Model();
		  $adress = $model->dynamicSelect("poste", "adress = ?", array($post['adress']), "id");		  
		  if(!empty($adress)){
		    $message['adress'] = 'A post with this adress already exist!';
		    $message['error'] = 1;
		  }

		  return $message;
		}
		
	}



	class GuardForm
	{
		
		function __construct()
		{
			# code...
		}

		public static function validation($post){
		  $message = array('uid' =>'' , 'nif' =>'', 'phone' =>'', 'error'=>0);

		  $model = new Model();
		  $uid = $model->dynamicSelect("guard", "uid = ?", array($post['uid']), "id");
		  $nif = $model->dynamicSelect("guard", "nif = ?", array($post['nif']), "id");
		  $phone = $model->dynamicSelect("guard", "phone = ?", array($post['phone']), "id");
		  
		  if(!empty($uid)){
		    $message['uid'] = 'A guard with this uid already exist!';
		    $message['error'] = 1;
		  }
		  
		  elseif(!empty($phone)){
		    $message['phone'] = 'A guard with this phone number already exist!';
		    $message['error'] = 1;
		  }
		  
		  elseif(!empty($nif)){
		    $message['nif'] = 'A guard with this nif already exist!';
		    $message['error'] = 1;
		  }

		  return $message;
		}
	}



	class GuardToursForm
	{
		
		function __construct()
		{
			# code...
		}
		
		public static function validation($new_POST){
      
		  $message = array('intervale_limit' =>'', 'intervale'=>'', 'commence_a'=>'', 'termine_a'=>'', 'error'=>0);
		  
		  if(!strtotime($new_POST['intervale_limit'])){
		  	$message['intervale_limit'] = 'Time format error. The correct format is hh:mm:ss';
		  	$message['error'] = 1;
		  }
		  
		  elseif(!strtotime($new_POST['intervale'])){
		  	$message['intervale'] = 'Time format error!';
		  	$message['error'] = 1;
		  }
		  
		  elseif(!strtotime($new_POST['commence_a'])){
		  	$message['commence_a'] = 'Time format error!';
		  	$message['error'] = 1;
		  }
		  
		  elseif(!strtotime($new_POST['termine_a'])){
		  	$message['termine_a'] = 'Time format error!';
		  	$message['error'] = 1;
		  }

		  elseif (strtotime($new_POST['intervale'])<strtotime($new_POST['intervale_limit'])){
		  	$message['intervale_limit'] = 'Intervale limit most than the specified intervale!';
		  }

		  elseif(strtotime($new_POST['intervale'])==strtotime("00:00:00")){
		    $message['intervale'] = 'Intervale cannot 00:00:00';
		    $message['error'] = 1;
		  }

		  return $message;
		}

		public static function listDataFK(){
			$model = new Model();
			$stmt = $model->query("SELECT poste_id FROM `guardtours` GROUP BY poste_id HAVING COUNT(poste_id)>1");
        	$guardpost = $stmt->fetchAll(PDO::FETCH_ASSOC);

        	$guard_ = $model->_list("guardtours", "guard_id");

	        $array = array("poste_id"=>array(), "guard_id"=>array());
	        
	        for ($i=0; $i < sizeof($guardpost); $i++)
	          foreach ($guardpost[$i] as $key => $value)
	              $array[$key][] = $value;

	        for ($i=0; $i < sizeof($guard_); $i++)
	          foreach ($guard_[$i] as $key => $value)
	              $array[$key][] = $value;
	        
	        $postAdress = $model->dynamicSelectAll("poste", "id NOT IN(".implode(',', $array['poste_id']).")", "adress, nom");
	        $guardId = $model->dynamicSelectAll("guard", "id NOT IN(".implode(',', $array['guard_id']).")", "uid, nom, prenom");

	        $array['poste_id'] = $postAdress;
	        $array['guard_id'] = $guardId;

	        return $array;
		}
	}

	class UserForm
	{
		function __construct(){

			# code...
		}

		public static function validation($new_POST){
		  	
		  	$message = array('username' =>'' , 'email'=>'', 'error'=>0);
		  	
		  	$user = new User();
			
			if($user->exist($new_POST['username'], $new_POST['email'])){
				$message['username'] = 'User already exist!';
				$message['email'] = 'User already exist!';
				$message['error'] = 1;
			}

			return $message;
		}
	}
 ?>