<?php
require_once("../model/session.php"); 
require_once('post_model.php');

$post = new Post();
$guard = new Guard();
$guardTours = new GuardTours();
$tours = new Tours();

$h = fopen("debug.txt", "a");

$page = $_SESSION['page'];

if(isset($_POST['id'])){

	$data = json_decode($_POST['id'], true);
	// var_dump(json_decode($data, true));
	fprintf($h, $data[0]." ".$page);

	switch ($page) {
		case 'post':
			# code...
			$post->remove("poste", $data);
			break;
		
		case 'guard':
			# code...
			$guard->remove("guard", $data);
			break;

		case 'guardTours':
			# code...
			$guard->remove("guardTours", $data);
			break;
		
		case 'tours':
			# code...
			$post->remove("tours", $data);
			break;

		default:
			# code...
			break;
	}
}
fclose($h);

include("../vue/delete.php");
 ?>