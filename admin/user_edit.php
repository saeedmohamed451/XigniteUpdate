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
                        <h2><i class="icon-bar-chart"></i><span class="break"></span>Kunden Information</h2>

                    </div>
                    <div class="box-content">
                        <?php
                        $rw = $obj->get_user_info($_GET['user_id']);
                        ?>
                        <form method="post" class="form-horizontal" action="user_update.php">
                            <fieldset>
                                <input type="hidden" name="userid" value="<?php echo $rw['id']; ?>" />

                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Username</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="email" value = "<?php echo $rw['email']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Passwort</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="pass" value = "<?php echo $rw['password']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Vorname, Name</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="name"  value = "<?php echo $rw['name']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div>  
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Straße</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="street" value = "<?php echo $rw['street']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                
                                
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Tel.1</label>
                                    <div class="controls">
                                        <input type="text" required  onkeypress="return isNumberKey(event);" class="span6 typeahead" name="phone" value = "<?php echo $rw['phone']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div>
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Tel.2</label>
                                    <div class="controls">
                                        <input type="text" required  onkeypress="return isNumberKey(event);" class="span6 typeahead" name="tel2" value = "<?php echo $rw['tel2']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">PLZ</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="plz" value = "<?php echo $rw['plz']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Ort</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="ort" value = "<?php echo $rw['ort']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Email</label>
                                    <div class="controls">
                                        <input type="email" class="span6 typeahead" name="email2" value = "<?php echo $rw['email2']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Fax</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="fax" value = "<?php echo $rw['fax']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Kontoguthaben</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="balance" value = "<?php echo $rw['balance']; ?>"  onkeypress="return isBalanceKey(event);" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Änderung speichern</button>
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
