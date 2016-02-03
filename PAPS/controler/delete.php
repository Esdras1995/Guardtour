<?php 
require_once('post_model.php');

$h = fopen("debug.txt", "a");


$data = '[{"id":"8","nom":"post2","adress":"2, address","contact":"2 contact"},{"id":"9","nom":"post3","adress":"3, address","contact":"3 contact"}]';

$obj = json_decode($data, true);
// var_dump($obj);

// print_r($obj);

// echo "\n--------------------> ".$obj[0]['id'];
// print $obj->{'foo-bar'}; // 12345
// $post = new Post();

// if(isset($_POST['id'])){
// 	$data = $_POST['id'];
// 	// var_dump(json_decode($data, true));
	fprintf($h, $obj[0]['id']);
// 	// print_r($data);

//     // $arrayPost = array('nom'=>$data[0], 'adress'=>"adress", 'contact'=>"contact");
//     // $post->add("poste", $arrayPost);
// }
fclose($h);

include("../vue/delete.php");
 ?>