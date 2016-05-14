<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');
  $controllerCalled = 1;

  $report = new Model();
  $listReport = "";
  
  if(isset($_POST['id'])){
    $_SESSION["report-list"] = array("id"=>'', "key"=>'');
    $_SESSION["report-list"]['id'] = json_decode($_POST['id'], true);
    $_SESSION["report-list"]['key'] = json_decode($_POST['key'], true);
  }

  if(!empty($_SESSION["report-list"]['id']) && !empty($_SESSION["report-list"]['key']))
    $listReport = $report->dynamicSelectAll("tours", "id IN(".implode(',', $_SESSION["report-list"]['id']).")", implode(',', $_SESSION["report-list"]['key']));
  
  $company = $report->_list("company", "*")[0];
  
  for ($i=0; $i < sizeof($listReport); $i++)
    foreach ($listReport[$i] as $key => $value){
      if($key == "guardtours_id"){
        $guardtours_id = $listReport[$i][$key];
        $guard_id = $report->getBy("guardtours", "guard_id", "id", $guardtours_id);
        $nom = $report->getBy("guard", "nom", "id", $guard_id);
        $prenom = $report->getBy("guard", "prenom", "id", $guard_id);
        $listReport[$i][$key] = $nom." ".$prenom;
      }
      if($key == "mention"){
        if($listReport[$i][$key] == "#dd5826") $listReport[$i][$key] = "Bad";
        if($listReport[$i][$key] == "#f0b518") $listReport[$i][$key] = "Warning";
        if($listReport[$i][$key] == "#555") $listReport[$i][$key] = "Good";
      }
    }
  include("../vue/invoice.php");
 ?>