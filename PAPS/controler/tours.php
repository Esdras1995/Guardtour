<?php 

require_once('../model/models.php');
require_once("form.php");

$form = new Form();
$model = new Model();
$tours = new Tours();


// if(isset($_POST['date_tours']) && isset($_POST['qrcode']) && isset($_POST['description']) && isset($_POST['uid']) && isset($_POST['heure']) && isset($_POST['photo']) && isset()){

// }

$date	 = $form->securite_bdd(strip_tags($_POST['date_tour']));
$heure	 = $form->securite_bdd(strip_tags($_POST['heure']));
$photo 	 = $_POST['photo'];
$qrcode	 = $form->securite_bdd(strip_tags($_POST['qrcode']));
$matricule	 = $form->securite_bdd(strip_tags($_POST['matricule']));
$description = $form->securite_bdd(strip_tags($_POST['description']));
$uid	 = $form->securite_bdd(strip_tags($_POST['uid']));

// echo htmlspecialchars("363663_3737373.jpeg");
// echo $form->securite_bdd(strip_tags("363663_3737373.jpeg"));
// $date = "2016-03-02";
// $heure = "08:15:00";
// $photo = base64_encode_image("img/hqdefault.jpg", "jpeg");
// $qrcode = "5364564538837830";
// $matricule = "1234";
// $description = "je sais pas";
// $uid = "mlkmlmlml";

$guard_id = $model->dynamicSelect("guard", "uid = ?", array($uid), "id")['id'];
$guard_tours_id = $model->dynamicSelect("guardtours", "guard_id = ?", array($guard_id), "id")['id'];
$mention = $tours->getMention($heure, $guard_tours_id);

if(!is_null($mention)){

	$date_temp = $date;
	$heure_temp = $heure;
	$chars = array(".", ":", "/", "-", " ");
	
	$date_temp = str_replace($chars, "", $date_temp);
	$heure_temp = str_replace($chars, "", $heure_temp);
	$path = 'uploads/'.$matricule.'_'.$date_temp.''.$heure_temp.'.jpeg';

	$new_POST = array('date_tour' => $date, 'qrcode' =>$qrcode, 'description' => $description, 'heure' => $heure, 'mention' => $mention, 'matricule' => $matricule, 'photo' => $path, 'guardtours_id' =>$guard_tours_id);

	echo $form->register("tours", $new_POST);
	$form->saveImage($photo, 'jpeg', $path);

}else
	echo "You are not registered!";


// function saveImage($base64img, $extension){
//     define('UPLOAD_DIR', 'uploads/');
//     $base64img = str_replace('data:image/'.$extension.';base64,', '', $base64img);
//     $data = base64_decode($base64img);
//     $file = UPLOAD_DIR . $date.'.'.$extension;
//     file_put_contents($file, $data);
// }

function base64_encode_image ($filename=string,$filetype=string) {
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
}

// saveImage(base64_encode_image("img/logo.png", "png"));

 ?>