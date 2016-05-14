<?php 
  
  require_once("../model/session.php");
  require_once('../model/models.php');
  
  define('LIMIT', 500);

  $controllerCalled = 1;
  $_SESSION['page'] = "report";
  
  $report = new Model();
  $tours = new Tours();
  
  $list = $report->_list("tours", "*");
  $listTours = $tours->_list("tours", "*");

  // La liste des titres des colonnes de la table tours.
  $toursKeys = Constants::getListKey()['tours'];

  //la taille du tableau tours dans la base
  $size = sizeof($list);

  //On divise la table par 500 pour ne pas afficher tout les donnees.
  $div = ($size>LIMIT)?$size/LIMIT:1;

  for ($i=0; $i < sizeof($list); $i++)
    foreach ($list[$i] as $key => $value)
      if($key == "guardtours_id"){
        $guardtours_id = $list[$i][$key];
        $guard_id = $report->getBy("guardtours", "guard_id", "id", $guardtours_id);
        $nom = $report->getBy("guard", "nom", "id", $guard_id);
        $prenom = $report->getBy("guard", "prenom", "id", $guard_id);
        $list[$i][$key] = $nom." ".$prenom;
      }

  // $mention = $tours->getMention("09:00:00", 1);
  
  include("../vue/report.php");

 ?>