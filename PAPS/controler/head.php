<?php 
  
  require_once("../model/models.php");
  $controllerCalled = 1;
  $auth_user = new User();
  
  
  $user_id = $_SESSION['user_session'];
  
  $userRow=$auth_user->getUserRow($user_id);
 ?>
<head>
    <title><?php echo "PAP Secutity"; ?></title>
    <link href="css/application.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- <meta http-equiv="refresh" content="1" /> -->
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
         chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
         https://code.google.com/p/chromium/issues/detail?id=332189
         */
    </script>
</head>