<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');
  

  $report = new Model();
  $listReport = "";
  if(isset($_POST['id'])){
                                            // echo "----> ".$_POST['id'];
    $_SESSION["report-list"] = json_decode($_POST['id'], true);
    $listReport = $report->_list("tours", "*");
    // fprintf($h, $_POST['id']);
  }
  
  $listReport = $report->_list("tours", "*");
  
  include("../vue/invoice.php");
 ?>