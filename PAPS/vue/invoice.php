<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
<body>

<?php include("menu_and_header.php"); ?>

<div class="content-wrap">
    <!-- main page content. the place to put widgets in. usually consists of .row > .col-md-* > .widget.  -->
    <main id="content" class="content" role="main">
        <div class="row">
            <div class="col-md-12">
                <section class="widget widget-invoice">
                    <header>
                        <div class="row">
                            <div class="col-sm-6 col-print-6">
                                <img src="demo/img/logo/invoice-logo.png" alt="Logo" class="invoice-logo"/>
                            </div>
                            <div class="col-sm-6 col-print-6">
                                <h3 class="text-align-right">
                                    #<span class="fw-semi-bold">9.45613</span> / <small>17 May 2014</small>
                                </h3>
                                <div class="text-muted fs-larger text-align-right">
                                    Some Invoice number description or whatever
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div class="row mb-lg">
                            <section class="col-sm-6 col-print-6">
                                <h4 class="text-muted no-margin">Company Information</h4>
                                <h3 class="company-name">
                                    Wrapbootstrap LLC
                                </h3>
                                <address>
                                    <strong>2 Infinite Loop</strong><br>
                                    Minsk, Belarus 220004<br>
                                    088.253.5345<br>
                                    <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">email@example.com</a><br>
                                    <abbr title="Work Phone">phone:</abbr> (012) 345-678-901<br>
                                    <abbr title="Work Fax">fax:</abbr> (012) 678-132-901
                                </address>
                            </section>
                            <section class="col-sm-6 col-print-6 text-align-right">
                                <h4 class="text-muted no-margin">Client Information</h4>
                                <h3 class="client-name">
                                    Veronica Niasvizhskaja
                                </h3>
                                <address>
                                    <strong>Consultant</strong> at
                                    <a href="#">Allspana</a><br>
                                    <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">maryna@allspana.by</a><br>
                                    <abbr title="Work Phone">phone:</abbr> (012) 345-678-901<br>
                                    <abbr title="Work Fax">fax:</abbr> (012) 678-132-901
                                    <p class="no-margin"><strong>Note:</strong></p>
                                    <p class="text-muted fs-mini">Some nights I stay up cashing in my bad luck.
                                        Some nights I call it a draw</p>
                                </address>
                            </section>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <?php
                                if(!empty($listReport))
                                foreach ($listReport[0] as $key => $value) {
                                    # code...
                                    // if($key != "tours_id")
                                        echo '<th class="key">'.$key."</th>";
                                    // else
                                    //     echo '<th class="key"><a href="post.php?page=tours" target="_blank">'.$key."</a></th>";
                                }
                              ?>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($listReport))
                                    for ($i=0; $i < sizeof($listReport); $i++) {
                                     {
                                      $compt = -1;
                                      echo '<tr>';
                                      // echo '<td><input type="checkbox" class="check-item"></td>'; 
                                       foreach ($listReport[$i] as $key => $value){ 
                                        # code...
                                        if(++$compt == 0)
                                            echo '<td class="item"><a href="#" class="edit">'.$value."</a></td>";
                                        else
                                            echo '<td class="item">'.$value."</td>";
                                      }

                                      echo "</tr>";

                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-8 col-print-6">
                                <p>
                                    <strong>Note:</strong>
                                    Thank you for your business. Keep in mind, sometimes bad things happen. But it's just sometimes.
                                </p>
                            </div>
                            <div class="col-sm-4 col-print-6">
                                <div class="row text-align-right">
                                    <div class="col-xs-6"></div> <!-- instead of offset -->
                                    <div class="col-xs-3">
                                        <p>Subtotal</p>
                                        <p>Tax(10%)</p>
                                        <p class="no-margin"><strong>Total</strong></p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p>1,598.88</p>
                                        <p>159.89</p>
                                        <p class="no-margin"><strong>1,758.77</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-align-right mt-lg mb-xs">
                            Marketing Consultant
                        </p>
                        <p class="text-align-right">
                            <span class="fw-semi-bold">Bob Smith</span>
                        </p>
                        <div class="btn-toolbar mt-lg text-align-right hidden-print">
                            <button id="print" class="btn btn-inverse">
                                <i class="fa fa-print"></i>
                                &nbsp;&nbsp;
                                Print
                            </button>
                            <!-- <button class="btn btn-danger">
                                Proceed with Payment
                                &nbsp;
                                <span class="circle bg-white">
                                    <i class="fa fa-arrow-right text-danger"></i>
                                </span>
                            </button> -->
                        </div>
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
<!-- page specific js -->
<script src="js/invoice.js"></script>
</body>
</html>