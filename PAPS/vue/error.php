<?php 
    if(!$controllerCalled)
        header("Location: ../controler/index.php");
 ?>
<!DOCTYPE html>
<html>

<?php include("head.php"); ?>

<body class="error-page">

<div class="container">
    <main id="content" class="error-container" role="main">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-10 col-lg-offset-4 col-sm-offset-3 col-xs-offset-1">
                <div class="error-container">
                    <h1 class="error-code">404</h1>
                    <p class="error-info">
                        Opps, it seems that this page does not exist.
                    </p>
                    <p class="error-help mb">
                        If you are sure it should, search for it.
                    </p>
                    <div class="form-group">
                        <input class="form-control input-no-border" type="text" placeholder="Search Pages">
                    </div>
                    <a href="search.html" class="btn btn-inverse">
                        Search <i class="fa fa-search text-warning ml-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="page-footer">
        2014 &copy; Sing. Admin Dashboard Template.
    </footer>
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

<!-- common app js -->
<script src="js/settings.js"></script>
<script src="js/app.js"></script>

<!-- page specific libs -->
<!-- page specific js -->
<script type="text/javascript">
    $('.refresh').on('click', function(){
        window.location.reload();
    });
</script>
</body>
</html>