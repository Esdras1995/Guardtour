<?php
require_once("../model/session.php"); 
require_once("../model/base_model.php");
$controllerCalled = 1;
$model = new Model();

// $h = fopen("debug.txt", "a");

$page = $_SESSION['page'];

if(isset($_POST['id'])){

	$data = json_decode($_POST['id'], true);
	// var_dump(json_decode($data, true));
	// fprintf($h, $data[0]." ".$page);

	switch ($page) {
		case 'Post':
			# code...
			$model->remove("guardtours", $data, "poste_id");
			$model->remove("poste", $data, "id");
			break;
		
		case 'Guard':
			# code...
			$model->remove("guardtours", $data, "guard_id");
			$model->remove("guard", $data, "id");
			break;

		case 'Guard tours':
			# code...
			$model->remove("tours", $data, "guardtours_id");
			$model->remove("guardTours", $data, "id");
			break;
		
		case 'Tours':
			# code...
			$model->remove("tours", $data, "id");
			break;

		case 'Users':
			# code...
			$model->remove("admin", $data, "id");
			break;

		default:
			# code...
			break;
	}
}
// fclose($h);

// include("../vue/delete.php");
 ?>