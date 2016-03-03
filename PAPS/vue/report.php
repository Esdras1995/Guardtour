<?php 
    if(!$controllerCalled)
        header("Location: ../controler/index.php");
 ?>
<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
    <!-- <meta http-equiv="refresh" content="10" /> -->
<body>

<?php include("menu_and_header.php"); ?>

<div class="content-wrap">
    <!-- main page content. the place to put widgets in. usually consists of .row > .col-md-* > .widget.  -->
    <main id="content" class="content" role="main">
        <!-- <ol class="breadcrumb">
            <li>YOU ARE HERE</li>
            <li class="active">Tables Basic</li>
        </ol> -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">List - <span class="fw-semi-bold"><?php echo $_SESSION['page']; ?></span></h1>
                <!-- <a href="forms.php?page=<?php echo $_SESSION['page']; ?>" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span></a> -->
            </div>
        </div>
        
        

        <section class="widget">
            <header>
                <!-- <h4>Table <span class="fw-semi-bold">Styles</span></h4> -->
                <div class="widget-controls">
                    <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                    <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </header>
            <hr>
            <p>
            <strong>Show/Hide: &nbsp;&nbsp;&nbsp;</strong>
            <strong><a href="javascript:;" class="hide-show" data-column="0">Checkbox</a></strong>
            &nbsp;&nbsp;&nbsp;
            <?php
                $compt = 1;
                if(!empty($list))
                    foreach ($list[0] as $key => $value) {
                        # code...
                        if($key != "id")
                            echo '<strong><a href="javascript:;" class="hide-show" data-column="'.$compt.'">'.$key.'</a></strong>';
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "\n";
                            $compt++;
                    }
              ?>
              </p>
              <hr>
            <div class="widget-body">
                <div class="mt"  style="overflow-x: scroll; overflow: auto;">
                    <table id="datatable-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="no-sort" style="padding: 10px;"><input name="select_all" value="1" id="select-all" type="checkbox" /></th>
                            <?php
                                if(!empty($list))
                                foreach ($list[0] as $key => $value) {
                                    # code...
                                    // if($key != "tours_id")
                                        echo '<th class="key">'.$key."</th>";
                                        echo "\n";
                                    // else
                                    //     echo '<th class="key"><a href="post.php?page=tours" target="_blank">'.$key."</a></th>";
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
                                    echo '<td class="item"><a href="#" class="edit">'.$value."</a></td>";

                                elseif($key == "mention")
                                    echo '<td class="item">'.$value.'<div style="background: '.$value.'; width: 100%; height: 10px; border-radius: 3px;"></div></td>';
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
        <div class="row">
            
            <div class="col-lg-4" style="margin-bottom: 10px;">
                <button type="button" class="btn btn-inverse export" data-toggle="modal" data-target="#myModal">Export selected</button>
                <span class="selected-item"></span>
            </div>
            <div class="col-lg-offset-6 col-sm-2">
                <a href="filter.php" class="btn btn-danger" style="margin-left: 10px; margin-bottom: 10px;">More filter</a>
            </div>
        </div>
        
        <!-- Modal -->
        <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                Are you sure you wan't to delete selected <?php print($_SESSION['page']); ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-default no" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger delete">Yes</button>
              </div>
            </div>
          </div>
        </div> -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form role="form" method="get" action="invoice.php" class="form-register">
              <div class="modal-body">
                
                    <fieldset>
                        <legend>
                            Company info
                        </legend>
                        <!-- <p>
                            Different colors & sizes for any elements including input groups. Elements may be
                            easily styled with classes like <code>.bg-primary</code> or <code>.bg-transparent</code>
                        </p> -->
                        <br/>
                        <div class="form-group">
                            <input class="form-control input-sm" name="company" placeholder="Company name" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="name" placeholder="Your name" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="poste" placeholder="Your post" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="adress" placeholder="Company adress" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="co-mail" placeholder="Company mail" type="mail">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="contact" placeholder="Contact" type="text">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control input-sm" name="note" placeholder="Note...." type="text"></textarea>
                        </div>

                        <legend>
                            Client info
                        </legend>
                        <!-- <p>
                            Different colors & sizes for any elements including input groups. Elements may be
                            easily styled with classes like <code>.bg-primary</code> or <code>.bg-transparent</code>
                        </p> -->
                        <br/>
                        <div class="form-group">
                            <input class="form-control input-sm" name="client" placeholder="Client company" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="cl-name" placeholder="Client name" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="cl-poste" placeholder="Client post" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="cl-adress" placeholder="Client adress" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="cl-mail" placeholder="Client mail" type="mail">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" name="cl-contact" placeholder="Contact" type="text">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control input-sm" name="cl-note" placeholder="Note...." type="text"></textarea>
                        </div>
                    </fieldset>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success pull-right save" name="save" >Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </main>
</div>

<script type="text/javascript">
    // setTimeout(function() {
    //     Location.reload();
    // }, 1000);
</script>
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
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/modal.js"></script>
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js"></script>
<script src="vendor/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/widgster/widgster.js"></script>
<script src="vendor/pace.js/pace.min.js"></script>
<script src="vendor/jquery-touchswipe/jquery.touchSwipe.js"></script>
<script type="text/javascript" src="Bootstrap-Confirmation/bootstrap-confirmation.js"></script>

<!-- common app js -->
<script src="js/settings.js"></script>
<script src="js/app.js"></script>
<!-- page specific libs -->
<script src="vendor/underscore/underscore-min.js"></script>
<script src="vendor/backbone/backbone.js"></script>
<script src="vendor/backbone.paginator/lib/backbone.paginator.min.js"></script>
<script src="vendor/backgrid/lib/backgrid.js"></script>
<script src="vendor/backgrid-paginator/backgrid-paginator.js"></script>
<script src="vendor/datatables/media/js/jquery.dataTables.js"></script>
<script src="vendor/bootstrap-select/bootstrap-select.min.js"></script>

<!-- page specific js -->
<script src="js/tables-dynamic.js"></script>
</body>
</html>