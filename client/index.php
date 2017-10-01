<?php
session_start();
?><!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Client</title>
        <meta name="description" content="Bootstrap Metro Dashboard">
        <meta name="author" content="Dennis Ji">
        <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <![endif]-->

        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->

        <style type="text/css">
            body { background: url(img/bg-login.jpg) !important; }
        </style>



    </head>
    <script language ="javascript">
        function gotopage(num){
            if( num == 1 ){
                window.location = "../distributor/index.php"
            }else if( num == 2 ){
                window.location = "../sub_distributor/index.php"
            }else if( num == 3 ){
                window.location = "../dealer/index.php"
            }else if( num == 4 ){
                window.location = "../agent/index.php"
            }
        }
    </script>
    <body>
        <div class="container-fluid-full">
            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="login-box">
                        <div align="center">

                            <br><?php if (@$_SESSION['msg'] != "") { ?><div align="center" class="myalert"><?php echo $_SESSION['msg'];
    $_SESSION['msg'] = ""; ?></div> <?php } ?>
                            <br>
                            <br>


                        </div>
                        <h2><center>Select the Type</center></h2>
                        <form class="form-horizontal" action="" method="post">
                            <fieldset>
                                <div class="input-prepend"  title="Username">
                                    <button type="button" style = "width: 80%" onclick = "gotopage(1);" class="btn btn-primary">Distributor</button>
                                </div>
                                <div class="clearfix"></div>
                                
                                <div class="input-prepend" title="Username">
                                    <button type="button" style = "width: 80%" onclick = "gotopage(2);"  class="btn btn-primary">Sub Distributor</button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="input-prepend" title="Username">
                                    <button type="button" style = "width: 80%" onclick = "gotopage(3);"  class="btn btn-primary">Dealer</button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="input-prepend" title="Username">
                                    <button type="button" style = "width: 80%" onclick = "gotopage(4);"  class="btn btn-primary">Agent</button>
                                </div>
                                <div class="clearfix"></div>
                        </form>
                        

                    </div><!--/span-->
                </div><!--/row-->


            </div><!--/.fluid-container-->

        </div><!--/fluid-row-->

        <!-- start: JavaScript-->

        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-migrate-1.0.0.min.js"></script>

        <script src="js/jquery-ui-1.10.0.custom.min.js"></script>

        <script src="js/jquery.ui.touch-punch.js"></script>

        <script src="js/modernizr.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/jquery.cookie.js"></script>

        <script src='js/fullcalendar.min.js'></script>

        <script src='js/jquery.dataTables.min.js'></script>

        <script src="js/excanvas.js"></script>
        <script src="js/jquery.flot.js"></script>
        <script src="js/jquery.flot.pie.js"></script>
        <script src="js/jquery.flot.stack.js"></script>
        <script src="js/jquery.flot.resize.min.js"></script>

        <script src="js/jquery.chosen.min.js"></script>

        <script src="js/jquery.uniform.min.js"></script>

        <script src="js/jquery.cleditor.min.js"></script>

        <script src="js/jquery.noty.js"></script>

        <script src="js/jquery.elfinder.min.js"></script>

        <script src="js/jquery.raty.min.js"></script>

        <script src="js/jquery.iphone.toggle.js"></script>

        <script src="js/jquery.uploadify-3.1.min.js"></script>

        <script src="js/jquery.gritter.min.js"></script>

        <script src="js/jquery.imagesloaded.js"></script>

        <script src="js/jquery.masonry.min.js"></script>

        <script src="js/jquery.knob.modified.js"></script>

        <script src="js/jquery.sparkline.min.js"></script>

        <script src="js/counter.js"></script>

        <script src="js/retina.js"></script>

        <script src="js/custom.js"></script>
        <!-- end: JavaScript-->

    </body>
</html>
