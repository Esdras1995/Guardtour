<?php

  require_once("PostService.php");
  
  $test = new PostService();
  
  // $test->getMention("2016-01-14 13:51:04", "3");

  if(isset($_POST['uid']) && isset($_POST['qrcode']) && isset($_POST['description']) && isset($_POST['date_tour'])){
  	
    $uid = $_POST['uid'];
    $qrcode = $_POST['qrcode'];
  	$description = $_POST['description'];
    $datetime = $_POST['date_tour']; 

  	if($test->insertTours($datetime, $qrcode, $description, $uid)){
  		echo "Yes";
  		return true;    
  	}
  	else{

  		echo "No";
  		return false;
  	}
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div id="server-name"><?php $test->getMention("2016-01-14 13:51:04", "3"); ?></div>
</body>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function () {
    var interval = 500;   //number of mili seconds between each call
    var refresh = function() {
        $.ajax({
            url: "http://localhost/xampp/PAPS/code/tours.php",
            cache: false,
            success: function(html) {
                $('#server-name').html(html);
                setTimeout(function() {
                    refresh();
                }, interval);
            }
        });
    };
    refresh();
});


</script>


</html>
