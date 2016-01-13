<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>PAPS - Admin</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
	    
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	
	<link href="css/font-awesome.css" rel="stylesheet">
	    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	    
	<link href="css/style.css" rel="stylesheet" type="text/css" />

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
					
					<li class="">						
						<a href="index.html" class="">
							<i class="icon-chevron-left"></i>
							Back to Dashboard
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="container">
	
	<div class="row">
		
		<div class="span6">
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
			<!-- 
			<div class="error-container">
				<h1>404</h1>
				
				<h2>Who! bad trip man. No more pixesl for you.</h2>
				
				<div class="error-details">
					Sorry, an error has occured! Why not try going back to the <a href="index.html">home page</a> or perhaps try following!
					
				</div> --> <!-- /error-details -->
				
				<!-- <div class="error-actions">
					<a href="index.html" class="btn btn-large btn-primary">
						<i class="icon-chevron-left"></i>
						&nbsp;
						Back to Dashboard						
					</a> -->
					
					
					
				<!-- </div> /error-actions -->
							
			<!-- </div> /error-container			 -->
			
		</div> <!-- /span12 -->
		
	</div> <!-- /row -->
	
</div> <!-- /container -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>
