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
        <h1 class="page-title">Dashboard <small><small>Pap securite</small></small></h1>

        <div class="row ng-scope">
            <div class="col-md-4">
                <section class="widget">
                    <header>
                        <h5>Sent success</h5>
                        <div class="widget-controls">
                            <a href="#"><i class="glyphicon glyphicon-cog"></i></a> 
                            <a href="#" data-widgster="close"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div class="stats-row">
                            <div class="stat-item">
                                <h6 class="name">Guard</h6>
                                <p class="value">
                                <?php echo $guardSuccess; ?>
                                </p>
                            </div>
                            <div class="stat-item">
                                <h6 class="name">Montly</h6><p class="value">1%</p>
                            </div>
                            <div class="stat-item">
                                <h6 class="name">24h</h6><p class="value">3.38%</p>
                            </div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                
                            </div>
                        </div>
                        <p>
                            <small>
                                <span class="circle bg-warning">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                            </small> 
                            <span class="fw-semi-bold"><?php echo $pSuccess."%"; ?> Guard</span>
                            is good
                        </p>
                    </div>
                    </section>
                    </div>
                    <div class="col-md-4">
                        <section class="widget">
                            <header>
                                <h5>Sent warning</h5>
                                <div class="widget-controls">
                                    <a href="#"><i class="glyphicon glyphicon-cog"></i>
                                    </a> 
                                    <a href="#" data-widgster="close"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </header>
                            <div class="widget-body">
                                <div class="stats-row">
                                    <div class="stat-item">
                                        <h6 class="name">Guard</h6>
                                        <p class="value">
                                            <?php echo $guardWarning; ?>
                                        </p>
                                    </div>
                                    <div class="stat-item">
                                        <h6 class="name">Montly</h6>
                                        <p class="value">55 120</p>
                                    </div>
                                    <div class="stat-item">
                                        <h6 class="name">24h</h6>
                                        <p class="value">9 695</p>
                                    </div>
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                </div>
                                <p>
                                    <small>
                                        <span class="circle bg-warning"><i class="fa fa-chevron-down"></i></span>
                                    </small>
                                    <span class="fw-semi-bold"><?php echo $pWarning."%"; ?> Guard</span>
                                    warning
                                </p>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="widget">
                            <header>
                                <h5>Sent danger</h5>
                                    <div class="widget-controls">
                                        <a href="#"><i class="glyphicon glyphicon-cog"></i></a>
                                        <a href="#" data-widgster="close">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </div>
                            </header>
                                <div class="widget-body">
                                    <div class="stats-row">
                                        <div class="stat-item">
                                            <h6 class="name">Guard</h6>
                                            <p class="value">
                                            <?php echo $guardBad; ?>
                                            </p>
                                        </div>
                                        <div class="stat-item">
                                            <h6 class="name">Takeoff Angle</h6>
                                            <p class="value">14.29°</p>
                                        </div>
                                        <div class="stat-item">
                                            <h6 class="name">World Pop.</h6>
                                            <p class="value">7,211M</p>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                    </div>
                                        <p>
                                            <small>
                                                <span class="circle bg-warning"><i class="fa fa-plus"></i></span>
                                            </small>
                                            <span class="fw-semi-bold"><?php echo $pDanger."%"; ?> Guard</span>
                                            is danger
                                        </p>
                                </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="widget">
            <header>
                <!-- <h4>Table <span class="fw-semi-bold">Styles</span></h4> -->
                <div class="widget-controls">
                    <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                    <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </header>
            <div class="widget-body" id="refresh">
                <div class="mt" style="overflow-x: scroll; overflow: auto;">
                    <table id="datatable-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="no-sort" style="padding: 10px;"><input name="select_all" value="1" id="select-all" type="checkbox" /></th>
                            <?php
                                if(!empty($list))
                                foreach ($list[0] as $key => $value) {
                                    # code...
                                    // if($key != "id")
                                        echo '<th class="key">'.$key."</th>";
                                }
                              ?>
                            <!-- <th class="hidden-xs">Date</th> -->
                            <!-- <th class="no-sort">Status</th> -->

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($list))
                            for ($i=0; $i < sizeof($list); $i++) {
                             {
                              $compt = -1;
                              echo '<tr>';
                              echo '<td><input type="checkbox" class="check-item"></td>'; 
                               foreach ($list[$i] as $key => $value){ 
                                # code...
                                if(++$compt == 0)
                                    echo '<td class="item"><a href="javascript:;" class="edit">'.$value."</a></td>";
                                elseif($key == "photo")
                                    echo '<td class="item"><a href="'.$value.'"><img class="img-rounded" src="'.$value.'" alt="" height="50" width="70"></a></td>';
                                elseif ($key == "mention") {
                                    # code...
                                    echo '<td class="item"><div class="progress progress-xs mt-xs mb-0">
                                            <div class="progress-bar progress-bar-gray-light" style="width: 100%; background: '.$value.'"></div>
                                        </div>'.$value."</td>";;
                                }
                                else
                                    echo '<td class="item">'.$value."</td>";
                              }

                              echo "</tr>";

                            }
                        }
                        ?>
                        </tbody>
                    </table>
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
<script src="vendor/jquery-touchswipe/jquery.touchSwipe.js"></script>

<!-- common app js -->
<script src="js/settings.js"></script>
<script src="js/app.js"></script>

<!-- page specific libs -->
<script id="test" src="vendor/underscore/underscore.js"></script>
<script src="vendor/jquery.sparkline/dist/jquery.sparkline.js"></script>
<script src="vendor/d3/d3.min.js"></script>
<script src="vendor/rickshaw/rickshaw.min.js"></script>
<script src="vendor/raphael/raphael-min.js"></script>
<script src="vendor/jQuery-Mapael/js/jquery.mapael.js"></script>
<script src="vendor/jQuery-Mapael/js/maps/usa_states.js"></script>
<script src="vendor/jQuery-Mapael/js/maps/world_countries.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/popover.js"></script>
<script src="vendor/bootstrap-calendar/bootstrap_calendar/js/bootstrap_calendar.min.js"></script>
<script src="vendor/jquery-animateNumber/jquery.animateNumber.min.js"></script>

<!-- page specific js -->
<script src="js/index.js"></script>

<script type="text/javascript">
	$('.refresh').on('click', function(){
        window.location.reload();
    });
    setInterval("my_function();",1000); 
    function my_function(){
      $('#refresh').load(location.href + ' #datatable-table');
    }
</script>
</body>
</html>