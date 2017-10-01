<?php include("header.php"); ?>
<!-- start: Header -->
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
</script>
<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <?php include("leftside.php"); ?>
        <!-- end: Main Menu -->



        <!-- start: Content -->
        <div id="content" class="span10">
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="icon-bar-chart"></i><span class="break"></span>Neuer Kunde</h2>

                    </div>
                    <div class="box-content">
                        <?php if (@$_SESSION['msg'] != "") { ?><div align="center" class="myalert"><?php echo $_SESSION['msg'];
                        $_SESSION['msg'] = ""; ?></div> <?php } ?>
                        <form method="post" class="form-horizontal" action="user_add.php">
                            <fieldset>
                                
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Vorname, Name</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="name"  value = "<?php echo (isset($_SESSION['name']) ? $_SESSION['name'] : ''); ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div>  
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Username</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="email" value = "<?php echo (isset($_SESSION['email']) ? $_SESSION['email'] : ''); ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Passwort</label>
                                    <div class="controls">
                                        <input type="password" class="span6 typeahead" name="pass" value = "<?php echo (isset($_SESSION['pass']) ? $_SESSION['pass'] : ''); ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Straße</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="street" value = "<?php echo (isset($_SESSION['street']) ? $_SESSION['street'] : ''); ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Telefon</label>
                                    <div class="controls">
                                        <input type="text" required  onkeypress="return isNumberKey(event);" class="span6 typeahead" name="phone" value = "<?php echo (isset($_SESSION['phone']) ? $_SESSION['phone'] : ''); ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Kontoguthaben</label>
                                    <div class="controls">
                                        <input type="text" required  onkeypress="return isBalanceKey(event);" class="span6 typeahead" name="balance" value = "<?php echo (isset($_SESSION['balance']) ? $_SESSION['balance'] : ''); ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                
                                

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Hinzufügen</button>
                                    <button type="reset" class="btn">Abbrechen</button>
                                </div>
                            </fieldset>
                        </form>   

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
