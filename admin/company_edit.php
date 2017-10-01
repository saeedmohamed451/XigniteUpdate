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
                        <?php
                        $rw = $obj->get_company_info($_GET['companyid']);
                        ?>
                        <form method="post" class="form-horizontal" action="company_update.php">
                            <fieldset>
                                <input type="hidden" name="companyid" value="<?php echo $rw['id']; ?>" />
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Symbol</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="symbol"  value = "<?php echo $rw['symbol']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div>  
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Wkn</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="wkn"  value = "<?php echo $rw['wkn']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Firma</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="firma"  value = "<?php echo $rw['firma']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Kurs</label>
                                    <div class="controls">
                                        <input type="text" onkeypress="return isBalanceKey(event);" class="span6 typeahead" name="kurs"  value = "<?php echo $rw['kurs']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div>
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Börsenplatz</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="platz"  value = "<?php echo $rw['platz']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div>
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">VK Frist</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="frist"  value = "<?php echo $rw['frist']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

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
