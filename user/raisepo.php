<?php include("header.php"); ?>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <?php include("leftside.php"); ?>
        <!-- end: Main Menu -->



        <!-- start: Content -->
        <div id="content" class="span10">

            <div class="row-fluid sortable">
                <div class="box-content">
                        <?php
                        $rw = $obj->dealer_data_id($_SESSION['dealerid']);
                        ?>
                        <form method="post" class="form-horizontal" action="">
                            <fieldset>
                                <div id="email1" class="control-group">
                                    <label for="typeahead"><?php echo $rw['dist_id']."->".$rw['sub_dist_id']."->".$rw['dealer_id']; ?></label>
                                </div>  
                               
                            </fieldset>
                        </form>   

                    </div>
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="icon-bar-chart"></i><span class="break"></span>Raise PO</h2>

                    </div>
                    <div class="box-content">
                        <?php
                        $rw = $obj->dealer_data_id($_SESSION['dealerid']);
                        $role = $obj->role_data_id($rw['role_id']);
                        $dist_id = $rw['dist_id'];
                        if ($role['raisepo'] == "1") {
                            ?>
                        <div align="center" class="myalert">Developing...</div>
                        <?php if (@$_SESSION['msg'] != "") { ?><div align="center" class="myalert"><?php
                        echo "Developing...";
                        //echo $_SESSION['msg'];
                        $_SESSION['msg'] = "";
                            ?></div> <?php } ?>
                        <form method="post" enctype="multipart/form-data" class="form-horizontal" action="">
                            <fieldset>
                            </fieldset>    
                        </form>   
                        <?php } else { ?>
                            <div align="center" class="myalert">You don't have this permission. Please contact with Telco</div>
<?php } ?>


                    </div>
                </div><!--/span-->

            </div>	

            <!--/row-->



        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->
<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
