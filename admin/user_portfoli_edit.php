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
                        $rw = $obj->get_product_info($_GET['product_id']);
                        ?>
                        <form method="post" class="form-horizontal" action="user_portfoli_update.php">
                            <fieldset>
                                <input type="hidden" name="productid" value="<?php echo $rw['id']; ?>" />

                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Symbol</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="symbol" value = "<?php echo $rw['symbol']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Name</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="name" value = "<?php echo $rw['name']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Kauf-Preis</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" onkeypress="return isBalanceKey(event);" name="price"  value = "<?php echo $rw['price']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required >

                                    </div>
                                </div>  
                                
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Stückzahl</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" onkeypress="return isNumberKey(event);" name="quantity" value = "<?php echo $rw['quantity']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                
                               <!-- <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Kurs zum Vortag</label>
                                    <div class="controls">
                                        <input type="text" required  class="span6 typeahead" name="changes" value = "<?php echo $rw['changes']; ?>" id="typeahead"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> -->
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Datum und Uhrzeit</label>
                                    <div class="controls">
                                        <input type="datetime-local" class="span6 typeahead" name="dates" value = "<?php $date=date_create($rw['dates']);
echo date_format($date,"Y-m-d")."T".date_format($date, "H:i:s");  ?>"   id="typeahead"  data-provide="typeahead" data-items="4" required>

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
