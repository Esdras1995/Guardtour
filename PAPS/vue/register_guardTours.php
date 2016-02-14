<?php 
    if(!$controllerCalled)
        header("Location: ../controler/index.php");
 ?>
<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
<body>
<?php include("menu_and_header.php"); ?>

<div class="content-wrap">
    <!-- main page content. the place to put widgets in. usually consists of .row > .col-md-* > .widget.  -->
    <main id="content" class="content" role="main">
        <!-- <ol class="breadcrumb">
            <li>YOU ARE HERE</li>
            <li class="active">Form Validation</li>
        </ol> -->
        <h1 class="page-title">Form - <span class="fw-semi-bold">register</span></h1>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <section class="widget">
                    <header>
                        <!-- <h4>
                            
                        </h4> -->
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <form role="form" method="post">
                            <fieldset>
                                <legend>
                                    Register Guard tours
                                </legend>
                                <div class="row" style="margin-bottom: 10px;">
                                	<div class="col-lg-12">
		                                <p>
		                                    <?php if($message) echo $message; ?>
                                		</p>
                                	</div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label><a href="post.php?page=post" target="_blank">Post:</a></label>
	                                </div>
	                               
	                                <div class="col-lg-7">
	                                	<select class="form-control" name="post" required="required">
	                                		<option></option>
	                                		<?php 
	                                			for ($i=0; $i < sizeof($postAdress); $i++) { 
	                                				# code...

	                                				foreach ($postAdress[$i] as $value) {
	                                					# code...
	                                					echo "<option>".$value."</option>";
	                                				}
	                                			}
	                                		 ?>
	                                	</select>
	                                </div>

	                                <div class="col-lg-3">
	                                	<div style="margin-top: 2px;">
		                                	<a href="post.php?page=post" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
		                                	<a href="forms.php?page=Post" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
	                                	</div>
	                                </div>
								</div>

								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas><a href="post.php?page=guard" target="_blank">Guard 1:</a> </label>
	                                </div>
	                               
	                                <div class="col-lg-7">
	                                	<select class="form-control" name="guard1" required="required">
	                                		<option></option>
	                                		<?php 
	                                			for ($i=0; $i < sizeof($guardId); $i++) { 
	                                				# code...

	                                				foreach ($guardId[$i] as $value) {
	                                					# code...
	                                					echo "<option>".$value."</option>";
	                                				}
	                                			}
	                                		 ?>
	                                	</select>
	                                </div>

	                                <div class="col-lg-3">
	                                	<div style="margin-top: 2px;">
		                                	<a href="post.php?page=guard" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
		                                	<a href="forms.php?page=Guard" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
	                                	</div>
	                                </div>
								</div>

								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas><a href="post.php?page=guard" target="_blank">Guard 2:</a> </label>
	                                </div>
	                               
	                                <div class="col-lg-7">
	                                	<select class="form-control" name="guard2" required="required">
	                                		<option></option>
	                                		<?php 
	                                			for ($i=0; $i < sizeof($guardId); $i++) { 
	                                				# code...

	                                				foreach ($guardId[$i] as $value) {
	                                					# code...
	                                					echo "<option>".$value."</option>";
	                                				}
	                                			}
	                                		 ?>
	                                	</select>
	                                </div>

	                                <div class="col-lg-3">
	                                	<div style="margin-top: 2px;">
		                                	<a href="post.php?page=guard" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
		                                	<a href="forms.php?page=Guard" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
	                                	</div>
	                                </div>
								</div>

								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label>Begin at: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input  name="begin" class="form-control" size="16" value="18:00:00" type="time" placeholder="intervale">
                                        </div>
	                                </div>
								</div>
								
								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Ends at: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input  name="end" class="form-control" size="16" type="time"  required="required" placeholder="intervale">
                                        </div>
	                                </div>
								</div>

								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Interval tower: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input  name="intervale" class="form-control" size="16" type="time" required="required" placeholder="intervale">
                                        </div>
	                                </div>
								</div>


                                <div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Limit: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input  name="limit" class="form-control" size="16" type="time" required="required" placeholder="intervale">
                                        </div>
	                                </div>
								</div>
                                <button type="submit" class="btn btn-success pull-right" name="register" >Register</button>
                            </fieldset>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>
<!-- The Loader. Is shown when pjax happens -->
<div class="loader-wrap hiding hide">
    <i class="fa fa-circle-o-notch fa-spin-fast"></i>
</div>

<!-- common libraries. required for every page-->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/jquery-pjax/jquery.pjax.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/dropdown.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js"></script>
<script src="vendor/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/widgster/widgster.js"></script>
<script src="vendor/pace.js/pace.min.js"></script>
<script src="vendor/jquery-touchswipe/jquery.touchSwipe.js"></script>

<!-- common app js -->
<script src="js/settings.js"></script>
<script src="js/app.js"></script>

<!-- page specific libs -->
<script src="vendor/parsleyjs/dist/parsley.min.js"></script>
<!-- page specific js -->
<script src="js/form-validation.js"></script>
</body>
</html>