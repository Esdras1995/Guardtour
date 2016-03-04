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
                                    <strong><?php echo $update==1?"Update":"Register"; ?> Tours</strong>
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
	                                	<label><a href="post.php?page=guardtours" target="_blank">Guard tours:</a></label>
	                                </div>
	                               
	                                <div class="col-lg-7">
	                                	<select class="form-control" name="guardtours_id" required="required">
	                                		<option></option>
	                                		<?php 
	                                			for ($i=0; $i < sizeof($guardTours); $i++) { 
	                                				# code...

	                                				foreach ($guardTours[$i] as $value) {
	                                					# code...
	                                					echo "<option>".$value."</option>";
	                                				}
	                                			}
	                                		 ?>
	                                	</select>
	                                </div>

	                                <div class="col-lg-3">
	                                	<div style="margin-top: 2px;">
		                                	<a href="post.php?page=guardtours" class="btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
		                                	<a href="forms.php?page=Guard tours" class="btn-sm btn-primary"><i class="fa fa-plus"></i> Add</a>
	                                	</div>
	                                </div>
								</div>

								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label>Date: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input  name="date_tours" class="form-control" size="16" type="date">
                                        </div>
	                                </div>
								</div>
								
								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Heure: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input  name="heure" class="form-control" size="16" type="time"  required="required">
                                        </div>
	                                </div>
								</div>
								
								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Qrcode: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                            <input  name="qrcode" class="form-control" size="16" type="text" required="required" placeholder="qrcode">
                                        </div>
	                                </div>
								</div>


                                <div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Mention: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <select class="form-control" name="mention" required="required">
	                                			<option></option>
	                                			<option style="background: #555">#555</option>
	                                			<option style="background: #f0b518">#f0b518</option>
	                                			<option style="background: #dd5826">#dd5826</option>
	                                		</select>
                                        </div>
	                                </div>
								</div>

								<div class="row" style="margin-bottom: 10px;">
	                                <div class="col-lg-2">
	                                	<label clas>Description: </label>
	                                </div>
	                               
	                                <div class="col-lg-10">
	                                	<div class="input-group">
                                            <textarea  name="description" class="form-control" rows="4" cols="50"></textarea>
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
<script type="text/javascript">
	$('.refresh').on('click', function(){
        window.location.reload();
    });
</script>
</body>
</html>