<?php
  
  require_once("PostService.php");
  require_once("session.php");
  require_once("class.user.php");

  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM admin WHERE id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $service = new PostService();
  $listguard = $service->listGuard();
  $listpost = $service->listPost();

  if(isset($_POST["validate"])){
  	
  	$interval = $_POST["hour"];
  	$heure = $_POST["date"];
  	$guard = $_POST["guard"];
  	$post = $_POST["post"];
  	$debut = $_POST["debut"];
  	$fin = $_POST["fin"];


  		try
		{
			$guard_id = $service->getGuardId($guard);
			$poste_id = $service->getPostId($post);

			$stmt = $service->runQuery("SELECT poste_id, guard_id FROM guardtours WHERE poste_id=:poste_id OR guard_id=:guard_id");
			$stmt->execute(array(':poste_id'=>$poste_id, ":guard_id"=>$guard_id));
			
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['poste_id']==$poste_id) {
				$error[] = "sorry this post already taken !";
			
			}else if($row['guard_id']==$guard_id){
				$error[] = "sorry this guard already taken !";
			}
			else
			{
				$service->registerTools($heure,$interval,$debut,$fin,$guard_id,$poste_id);
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
  }

?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Tools</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    
    
    <link href="css/pages/plans.css" rel="stylesheet"> 

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

<body>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="home.php">PAPS -Admin</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="signup.php">New</a></li>
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php print($userRow['username']); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Profile</a></li>
              <li><a href="logout.php?logout=true">Logout</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
    



    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="index.php"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="reports.php"><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
        <li><a href="register.php"><i class="icon-plus"></i><span>Add post</span> </a></li>
        <li><a href="tools.php"><i class="icon-cog"></i><span>tools</span></a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
    
    
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	<div class="span6 offset3">
	      		
	      		<!--<div class="widget">
						
					<!--<div class="widget-header">
						<i class="icon-th-large"></i>
						<h3>Choose Your Plan</h3>
					</div> <!-- /widget-header -->
					
					<!-- <div class="widget-content"> -->
						
						<div>					    
					    <div class="plan-container span5">
					        <div class="plan">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Post supervisor tools        		
					        		</div> <!-- /plan-title -->
					                
						            <div class="plan-price">
					                	<i class=" icon-wrench"></i><span class="term">Customize</span>
									</div> <!-- /plan-price -->
									
						        </div> <!-- /plan-header -->	       
						        <form method="post">
							        <div class="plan-features">
										<ul>
											<li><strong>Customize</strong> verification time for each post</li>
											
											<li>Round hour: <input required=required type="time" name="hour" for="round" min="1" max="24" class="type-number"></li>
											
											<li>Date: <input required=required type="datetime" name="date" for="date" min="1" max="24" class="type-number"></li>
											<li>Debut: <input name="debut" type="time" ></li>
											<li>Fin: <input name="fin" type="time" ></li>
											<li><a href="list.php?guard" target="_blank">Guard uid:</a>
												<select name="guard" required=required>
													<option></option>
													<?php

														for($i=0; $i < sizeof($listguard); $i++) {
															
															$list = $listguard[$i]; 
															
															foreach ($list as $key => $value)
																if($key == "uid") echo "<option>".$value."</option>";
														}
														
													?>

												</select>
											</li>
											<li><a href="list.php?post" target="_blank">Post:</a>
												<select name="post" required=required>
													<option></option>
													<?php
														for($i=0; $i < sizeof($listpost); $i++) {
															
															$list = $listpost[$i]; 
															
															foreach ($list as $key => $value)
																if($key == "adress") echo "<option>".$value."</option>";
														}
														
													?>
												</select>
											</li>
										</ul>
									</div> <!-- /plan-features -->
									
									<div class="plan-actions">				
										<button type="submit" class="btn btn-success" name="validate">Validate</button>				
									</div> <!-- /plan-actions -->
								</form>
							</div> <!-- /plan -->
							
					    </div> <!-- /plan-container -->
				
				
					</div> <!-- /pricing-plans -->
						
					<!-- </div> /widget-content -->
						
				<!-- </div> /widget					 -->
				
		    </div> <!-- /span12 -->     	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
       
    
<div class="footer">
	
	<div class="footer-inner">
		
		<div class="container">
			
			<div class="row">
				
    			<div class="span12">
    				&copy; 2013.
    			</div> <!-- /span12 -->
    			
    		</div> <!-- /row -->
    		
		</div> <!-- /container -->
		
	</div> <!-- /footer-inner -->
	
</div> <!-- /footer -->
    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>

  </body>

</html>
