<?php

require_once("session.php");
// session_start();
require_once('class.user.php');
$post = new Post();

// if($user->is_loggedin()!="")
// {
// 	$user->redirect('home.php');
// }

if(isset($_POST['register']))
{
	$name = strip_tags($_POST['name']);
	$address = strip_tags($_POST['address']);
	$contact = strip_tags($_POST['contact']);

	$uid = strip_tags($_POST['guarduid']);
	$firstname = strip_tags($_POST['guardfirstname']);
	$lastname = strip_tags($_POST['guardlastname']);
	$nif = strip_tags($_POST['guardnif']);
	$email = strip_tags($_POST['guardemail']);
	$phone = strip_tags($_POST['guardphone']);
	
	if($name=="")	{
		$error[] = "provide name !";	
	}
	else if($address=="")	{
		$error[] = "provide address !";	
	}
	else if($contact=="")	{
		$error[] = "provide contact !";	
	}

	else if($uid=="")	{
		$error[] = "provide uid !";	
	}
	else if($firstname=="")	{
		$error[] = "provide first name !";	
	}
	else if($lastname=="")	{
		$error[] = "provide last name !";	
	}
	else if($email=="")	{
		$error[] = "provide email !";	
	}
	else if($phone=="")	{
		$error[] = "provide phone number !";	
	}
	else if($nif=="")	{
		$error[] = "provide nif guard !";	
	}
	else
	{
		try
		{
			$stmt = $post->runQuery("SELECT adress FROM poste WHERE adress=:address");
			$stmt->execute(array(':address'=>$address));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			
			$stmt1 = $post->runQuery("SELECT NIF, phone, email, uid FROM guard WHERE NIF=:nif OR phone=:phone OR email=:email OR uid=:uid");
			$stmt1->execute(array(':nif'=>$nif, ':phone'=>$phone, ':email'=>$email, ':uid'=>$uid));
			$row1=$stmt1->fetch(PDO::FETCH_ASSOC);

			if($row['address']==$address) {
				$error[] = "sorry post already taken !";
			}
			else if($row1['nif']==$nif) {
				$error[] = "sorry nif already taken !";
			}
			else if($row1['uid']==$uid) {
				$error[] = "sorry uid already taken !";
			}
			else if($row1['phone']==$phone) {
				$error[] = "sorry phone already taken !";
			}
			else if($row1['email']==$email) {
				$error[] = "sorry email already taken !";
			}
			else
			{
				if($post->registerPost($name,$address,$contact) && $post->registerGuard($uid, $firstname, $lastname, $email, $phone, $nif)){	
					$post->redirect('register.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>
<!DOCTYPE html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
    <title>Register - PAPS</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				PAPS - Admin				
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<!-- <li class="">						
						<a href="login.html" class="">
							Already have an account? Login now
						</a>
						
					</li> -->
					<li class="">						
						<a href="home.php" class="">
							<i class="icon-chevron-left"></i>
							Back to Homepage
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container register" style="width: 60%;">
	
	<div class="content clearfix">
		
		<form method="post">
		
			<h1>Add new post</h1>
			<hr/>		
			
			<?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			
			?>
			<div class="login-fields">
				
				<h6> Post </h6>
				<hr/>

				<div class="field">
					<label for="postname">Name:</label>
					<input type="text" id="postname" name="name" value="" placeholder="Post Name" class="login" />
				</div> <!-- /field -->

				<div class="field">
					<label for="postaddress"> Address:</label>
					<input type="text" id="postaddress" name="address" value="" placeholder="Post Address" class="login" />
				</div> <!-- /field -->

				<div class="field">
					<label for="contact">Contact :</label>
					<input type="text" id="contact" name="contact" value="" placeholder="Contact" class="login" />
				</div> <!-- /field -->

				<h6> Post Guard</h6>
				<hr/>
				<div class="field">
					<label for="guarduid"> UID:</label>
					<input type="text" id="guarduid" name="guarduid" value="" placeholder="UID" class="login" />
				</div> <!-- /field -->	

				<div class="field">
					<label for="guardfirstname">First Name:</label>
					<input type="text" id="firstname" name="guardfirstname" value="" placeholder="First Name" class="login" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="guardlastname">Last Name:</label>	
					<input type="text" id="lastname" name="guardlastname" value="" placeholder="Last Name" class="login" />
				</div> <!-- /field -->
				
				
				<div class="field">
					<label for="guardemail">Email Address:</label>
					<input type="text" id="email" name="guardemail" value="" placeholder="Email" class="login"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="guardphone"> Phone:</label>
					<input type="text" id="guardphone" name="guardphone" value="" placeholder="Phone" class="login" />
				</div> <!-- /field -->

				<div class="field">
					<label for="guardnif"> NIF/CIN:</label>
					<input type="text" id="guardnif" name="guardnif" value="" placeholder="NIF/CIN" class="login" />
				</div> <!-- /field -->					
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<!-- <span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Agree with the Terms & Conditions.</label>
				</span> -->
									
				<button type="submit" class="button btn btn-primary btn-large" name="register" >Register</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
	Post already exist? <a href="list.php?post" target="_blank">Show all posts</a>
</div> <!-- /login-extra -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

 </html>
