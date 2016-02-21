<?php
	require_once('../model/session.php');
	require_once('../model/models.php');
	$controllerCalled = 1;
	$user_logout = new User();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('home.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->doLogout();
		$user_logout->redirect('index.php');
	}
