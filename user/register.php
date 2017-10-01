<?php
session_start();
?><!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Dealer</title>
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
<script type="text/javascript" src="js/jquery.js"></script>
    
<script type="text/javascript">
       
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        function isBalanceKey(txt){
            
            if(event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46)
            {
               var txtbx=document.getElementById(txt);
               var amount = document.getElementById(txt).value;
               var present=0;
               var count=0;

               if(amount.indexOf(".",present)||amount.indexOf(".",present+1));
               {
              // alert('0');
               }

              /*if(amount.length==2)
              {
                if(event.keyCode != 46)
                return false;
              }*/
               do
               {
               present=amount.indexOf(".",present);
               if(present!=-1)
                {
                 count++;
                 present++;
                 }
               }
               while(present!=-1);
               if(present==-1 && amount.length==0 && event.keyCode == 46)
               {
                    event.keyCode=0;
                    //alert("Wrong position of decimal point not  allowed !!");
                    return false;
               }

               if(count>=1 && event.keyCode == 46)
               {

                    event.keyCode=0;
                    //alert("Only one decimal point is allowed !!");
                    return false;
               }
               if(count==1)
               {
                var lastdigits=amount.substring(amount.indexOf(".")+1,amount.length);
                if(lastdigits.length>=2)
                            {
                              //alert("Two decimal places only allowed");
                              event.keyCode=0;
                              return false;
                              }
               }
                    return true;
            }
            else
            {
                    event.keyCode=0;
                    //alert("Only Numbers with dot allowed !!");
                    return false;
            }
        }
        function register(){
            
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
                        <h2>Register</h2>
                        <form class="form-horizontal" action="register_sub.php" method="post">
                            <fieldset>

                                <div class="input-prepend" title="username">
                                    
                                    <span class="add-on"><i class="halflings-icon email"></i></span>
                                    <input class="input-large span10" name="email" id="email" type="email" placeholder="type email" required/>
                                </div>
                                <div class="input-prepend" title="email">
                                    
                                    <span class="add-on"><i class="halflings-icon user"></i></span>
                                    <input class="input-large span10" name="username" id="username" type="text" placeholder="type username" required/>
                                </div>
                                <div class="input-prepend" title="street">
                                    
                                    <span class="add-on"><i class="halflings-icon home"></i></span>
                                    <input class="input-large span10" name="street" id="street" type="text" placeholder="type street" required/>
                                </div>
                                <div class="input-prepend" title="phone">
                                    
                                    <span class="add-on"><i class="halflings-icon phone"></i></span>
                                    <input class="input-large span10" name="phone" id="phone" type="text"  onkeypress="return isNumberKey(event);" placeholder="type phone" required/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="input-prepend" title="balance">
                                    
                                    <span class="add-on"><i class="halflings-icon cog"></i></span>
                                    <input class="input-large span10" name="balance" id="balance" type="text" onkeypress="return isBalanceKey(this.id);" placeholder="type balance" required/>
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="password">
                                    <span class="add-on"><i class="halflings-icon lock"></i></span>
                                    <input class="input-large span10" name="password" id="password" type="password" placeholder="type password" required/>
                                </div>
                                <div class="clearfix"></div>


                            <div class="button-login">	
                                <div class="button-login">	
                                    <button type="submit" class="btn btn-primary">Register</button>
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
