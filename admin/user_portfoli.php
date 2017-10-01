<?php 
include("header.php"); 
require 'YahooFinance.php';
$yf = new YahooFinance;
?>
<!-- start: Header -->
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
        function buy(){
            var id = $("#buy_id").val();
            var symbol = $("#symbol").val();
            var name =  $("#name").val();
            var price = $("#price").val();
            var change = $("#change").val();
            var datetime = $("#datetime").val();
            var quantity = $("#quantity").val();
            var cur_price = $("#cur_price").val();
            var cur_quantity = $("#quantity_sell").val();
            $.ajax({
                url: 'sell_product.php',
                type: 'GET',
                data: { id:id, symbol: symbol, name : name, price:price, quantity:quantity, cur_price:cur_price, cur_quantity:cur_quantity, change:change, datetime:datetime, quantity:quantity} ,
                contentType: 'application/json; charset=utf-8',
                success: function (response) {
                    //your success code
                    if( response == "Success" ){
                        location.reload(false);
                    }else
                        alert(response);
                },
                error: function () {
                    //your error code
                }
            }); 
            
        }
        
        function showAjaxModal(buy_id, symbol, name, price, quantity, cur_price, change, datetime)
	{
		// SHOWING AJAX PRELOADER IMAGE
                
                jQuery('#modal_ajax .modal-body').html('<label class="control-label" for="typeahead">Symbol:' + symbol + '</label><BR>' 
                                                    + '<label class="control-label" for="typeahead">Name:' + name + '</label><BR>' 
                                                    + '<label class="control-label" for="typeahead">Kauf-Preis:' + price + 'EUR</label><BR>' 
                                                    + '<label class="control-label" for="typeahead">Stückzahl im Depot:' + quantity + '</label><BR>' 
                                                    + '<label class="control-label" for="typeahead">Kurs:' + change + '</label><BR>' 
                                                    + '<label class="control-label" for="typeahead">Datum/Uhrzeit:' + datetime + '</label><BR>'
                                                    + '<label class="control-label" for="typeahead">Aktueller Preis:' + cur_price + '</label><BR>' 
                                                    + '<label class="control-label" for="typeahead">Stückzahl</label>'
                                                    + '<input type = "text" id = "quantity_sell" name = "quantity_sell" value="1" onkeypress="return isBalanceKey(this.id);"/>');
		
		// LOADING THE AJAX MODAL
                
                $("#buy_id").val(buy_id);
                $("#symbol").val(symbol);
                $("#name").val(name);
                $("#price").val(price);
                $("#quantity").val(quantity);
                $("#cur_price").val(cur_price);
                $("#change").val(change);
                $("#datetime").val(datetime);
                
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
	}
        
 </script>
 <style>
 .problem[readonly]{
     color: green;
     /*Preventing selection*/
     -webkit-touch-callout: none;
     -webkit-user-select: none;
     -khtml-user-select: none;
     -moz-user-select: none;
     -ms-user-select: none;
     user-select: none;
     /**/
}​
 </style>
 <div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <?php include("leftside.php"); ?>
<div id="content" class="span10">
            

        
    
    
    
            <!--/row-->
            <div class="row-fluid sortable">		
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon user"></i><span class="break"></span>Portfolio</h2>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>	
                                    <th>symbol</th>		
                                    <th>Name</th>
                                    <th>Kauf-Preis</th>
                                    <th>Stückzahl</th>
                                    <th>Datum und Uhrzeit</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>     
                            <tbody>


                                <?php
                                $_SESSION['user_id'] = $_REQUEST['user_id'];
                                $rs = $obj->get_product_list($_REQUEST['user_id']);
                                if ($rs) {
                                    $i = 1;
                                    while ($row = mysql_fetch_assoc($rs)) {
                                        if( $row['quantity'] == 0 ){
                                            $i++; continue;
                                        }
                                        $symbol = $row['symbol'];
                                        $name = $row['name'];
                                        $change = $row['changes'];
                                        $datetime = $row['dates'];
                                        $price = $row['price'];
                                        $quantity = $row['quantity'];
                                        $id = $row['id'];
                                        ?> 
                                        <tr>
                                            <td><?php echo $row['symbol']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><font color="green"><?php echo number_format($row['price'], 2, ',', '.')."€"; ?></font></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            
                                            <td><?php $date=date_create($row['dates']);
echo date_format($date,"d.m.Y H:i") ?></td>
                                            <td class="center">
                                                <a class="btn btn-info" href="user_portfoli_edit.php?product_id=<?php echo $id; ?>">
                                                        <i class="halflings-icon white edit"></i>  
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                }
                                ?>   
                            </tbody>
                        </table>            
                    </div>
                </div><!--/span-->

            </div>


                                
                    
        </div>


        <!-- start: Content -->
        <!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->
</div>
<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
