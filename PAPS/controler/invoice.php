<?php 
  require_once("../model/session.php");
  require_once('../model/models.php');
  

  $report = new Report();
  $listReport = "";
  if(isset($_POST['id'])){
                                            // echo "----> ".$_POST['id'];
    $_SESSION["report-list"] = json_decode($_POST['id'], true);
    $listReport = $report->_list("report", "*");
    // fprintf($h, $_POST['id']);
  }
  $listReport = $report->_list("report", "*");
include("../vue/invoice.php");
 ?>