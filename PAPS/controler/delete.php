<?php
require_once("../model/session.php"); 
require_once('../model/models.php');

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
			$model->remove("poste", $data);
			break;
		
		case 'Guard':
			# code...
			$model->remove("guard", $data);
			break;

		case 'Guard tours':
			# code...
			$model->remove("guardTours", $data);
			break;
		
		case 'Tours':
			# code...
			$model->remove("tours", $data);
			break;

		case 'Users':
			# code...
			$model->remove("admin", $data);
			break;

		default:
			# code...
			break;
	}
}
// fclose($h);

// include("../vue/delete.php");
 ?>