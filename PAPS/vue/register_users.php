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
        <h1 class="page-title">Form - <span class="fw-semi-bold"><?php echo $update==1?"Update":"Register"; ?></span></h1>
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
                                    <strong><?php echo $update==1?"Update":"Register"; ?> User</strong>
                                </legend>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-lg-12">
                                        <p>
                                            <?php if($message) echo $message; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <div class="col-sm-7"> -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input  name="prenom" class="form-control input-lg" value="<?php echo $dataUpdate!=''?$dataUpdate['prenom']:''; ?>" size="16" type="text" placeholder="firstname" required="required">
                                        </div>
                                    <!-- </div> -->
                                </div>

                                <div class="form-group">
                                    <!-- <div class="col-sm-7"> -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input name="nom" class="form-control input-lg" value="<?php echo $dataUpdate!=''?$dataUpdate['nom']:''; ?>" size="16" type="text" placeholder="lastname" required="required">
                                        </div>
                                    <!-- </div> -->
                                </div>

                                <div class="form-group">
                                    <!-- <div class="col-sm-7"> -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input name="username" class="form-control input-lg" value="<?php echo $dataUpdate!=''?$dataUpdate['username']:''; ?>" size="16" type="text" placeholder="username" required="required">
                                        </div>
                                    <!-- </div> -->
                                </div>

                                <div class="form-group">
                                    <!-- <div class="col-sm-7"> -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input name="email" class="form-control input-lg" value="<?php echo $dataUpdate!=''?$dataUpdate['email']:''; ?>" size="16" type="email" placeholder="email" required="required">
                                        </div>
                                    <!-- </div> -->
                                </div>

                                <div class="form-group">
                                    <!-- <div class="col-sm-7"> -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input name="password" class="form-control input-lg" value="<?php echo $dataUpdate!=''?$dataUpdate['password']:''; ?>" size="16" type="password" placeholder="password" required="required">
                                        </div>
                                    <!-- </div> -->
                                </div>

                                <!-- <div class="form-group"> -->
                                    <!-- <div class="col-sm-7"> -->
                                        <!-- <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input name="password-confirmation" class="form-control input-lg" size="16" type="password" placeholder="Confirm password" required="required">
                                        </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <button type="submit" class="btn btn-success pull-right" name="register" ><?php echo $update==1?"Update":"Register"; ?></button>
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