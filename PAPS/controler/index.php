<?php

session_start();

require_once("../model/models.php");
$controllerCalled = 1;
$login = new User();

if($login->is_loggedin()!="")
{
	$login->redirect('dashboard.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['username']);
	$umail = strip_tags($_POST['username']);
	$upass = strip_tags($_POST['password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('dashboard.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
	include("../vue/login.php");
?>