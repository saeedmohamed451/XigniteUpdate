<?php
include("header.php");
require 'YahooFinance.php';
$yf = new YahooFinance;
?>
<!-- start: Header -->
<script type="text/javascript">

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    function isBalanceKey(txt) {

        if (event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46)
        {
            var txtbx = document.getElementById(txt);
            var amount = document.getElementById(txt).value;
            var present = 0;
            var count = 0;

            if (amount.indexOf(".", present) || amount.indexOf(".", present + 1))
                ;
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
                present = amount.indexOf(".", present);
                if (present != -1)
                {
                    count++;
                    present++;
                }
            }
            while (present != -1);
            if (present == -1 && amount.length == 0 && event.keyCode == 46)
            {
                event.keyCode = 0;
                //alert("Wrong position of decimal point not  allowed !!");
                return false;
            }

            if (count >= 1 && event.keyCode == 46)
            {

                event.keyCode = 0;
                //alert("Only one decimal point is allowed !!");
                return false;
            }
            if (count == 1)
            {
                var lastdigits = amount.substring(amount.indexOf(".") + 1, amount.length);
                if (lastdigits.length >= 2)
                {
                    //alert("Two decimal places only allowed");
                    event.keyCode = 0;
                    return false;
                }
            }
            return true;
        }
        else
        {
            event.keyCode = 0;
            //alert("Only Numbers with dot allowed !!");
            return false;
        }
    }
    Number.prototype.format = function (n, x, s, c) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

        return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
    };
    function buy() {
        var id = $("#buy_id").val();
        var symbol = $("#symbol").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var change = $("#change").val();
        var datetime = $("#datetime").val();
        var quantity = $("#quantity").val();
        var cur_price = $("#cur_price").val();
        var cur_quantity = $("#quantity_sell").val();
        $.ajax({
            url: 'sell_product.php',
            type: 'GET',
            data: {id: id, symbol: symbol, name: name, price: price, quantity: quantity, cur_price: cur_price, cur_quantity: cur_quantity, change: change, datetime: datetime, quantity:quantity},
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                //your success code
                if (response == "Erfolgreich verkauft, Verkaufserlös wurde erfolgreich Ihrem Konto gutgeschrieben") {
                    {
                        location.reload(false);
                        /*  var quantity = $("#quantity_sell").val();
                         var price = $("#cur_price").val();
                         var balance = $("#balanceval").val();
                         
                         var total = Number(quantity) * Number(price);
                         var diff = Number(balance) + total;
                         $("#balanceval").val(diff);
                         
                         var numberDiff = Number(diff).format(2, 3, '.', ',') + "€";
                         $("#balance").val(numberDiff);*/

                    }
                } else
                    alert(response);
            },
            error: function () {
                //your error code
            }
        });

    }
    function isBalanceKey1(txt) {

        //var res = isBalanceKey(txt);

        var quantity = $("#quantity_sell").val();
        var price = $("#cur_price").val();
        var balance = $("#balanceval").val();

        var total = Number(quantity) * Number(price);
        var diff = Number(balance) + total;


        var numberTotal = Number(total).format(2, 3, '.', ',') + "€";
        $("#total").html('Kaufpreis:<font color="green">' + numberTotal + '</font>');

        var numberDiff = Number(diff).format(2, 3, '.', ',') + "€";
        if (diff > 0)
            $("#rest").html('Rest Kontostand:<font color="green">' + numberDiff + '</font>');
        else
            $("#rest").html('Rest Kontostand:<font color="red">' + numberDiff + '</font>');
        return true;
    }
    function showAjaxModal(buy_id, symbol, name, price, quantity, cur_price, change, datetime)
    {
        // SHOWING AJAX PRELOADER IMAGE
        var balance = $("#balanceval").val();

        var numberBalance = Number(balance).format(2, 3, '.', ',') + "€";
        var numberPrice = Number(price).format(2, 3, '.', ',') + "€";
        var diff = Number(balance) + Number(cur_price);
        var numberDiff = Number(diff).format(2, 3, '.', ',') + "€";
        var numberCur_Price = Number(cur_price).format(2, 3, '.', ',') + "€";


        jQuery('#modal_ajax .modal-body').html('<label class="control-label" for="typeahead">Symbol:' + symbol + '</label><BR>'
                + '<label class="control-label" for="typeahead">Name:' + name + '</label><BR>'
                + '<label class="control-label" for="typeahead">Kauf-Preis:<font color="green">' + numberPrice + '</font></label><BR>'
                + '<label class="control-label" for="typeahead">Stückzahl im Depot:' + quantity + '</label><BR>'
                + '<label class="control-label" for="typeahead">Datum/Uhrzeit:' + datetime + '</label><BR>'
                + '<label class="control-label" for="typeahead">Aktueller Preis:<font color="green">' + numberCur_Price + '</font></label><BR>'
                + '<label class="control-label" for="typeahead">Stückzahl</label>'
                + '<input type = "text" id = "quantity_sell" name = "quantity_sell" value="1" onkeypress="return isBalanceKey(this.id);" onkeyup="isBalanceKey1(this.id)"/>'
                + '<label class="control-label" for="typeahead">Kontostand:<font color="green">' + numberBalance + '</font></label>'
                + '<label class="control-label" id = "total" name = "total" for="typeahead">Aktienwert:<font color="green">' + numberCur_Price + '</font></label>'
                + '<label class="control-label" id = "rest" name = "rest" for="typeahead">Rest Kontostand:<font color="green">' + numberDiff + '</font></label>');

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
    function checkpass() {
        var pass = $("#password").val();
        var pass1 = $("#password1").val();
        if (pass != pass1) {
            alert("falsches Passwort");
            return false;
        }
        return true;

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
<style type="text/css">
    <!--
    .style1 {color: #FF0000}
    -->
</style>
<input type ="hidden" name ="buy_id" id="buy_id"/>
<input type ="hidden" name ="symbol" id="symbol"/>
<input type ="hidden" name ="name" id="name"/>
<input type ="hidden" name ="price" id="price"/>
<input type ="hidden" name ="cur_price" id="cur_price"/>
<input type ="hidden" name ="quantity" id="quantity"/>
<input type ="hidden" name ="change" id="change"/>
<input type ="hidden" name ="datetime" id="datetime"/>

<div class="container-fluid-full">
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><?php echo "Wertpapiere verkaufen" ?></h4>
                </div>

                <div class="modal-body" >



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="buy()" data-dismiss="modal">verkaufen</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <!-- start: Main Menu -->
        <?php include("leftside.php"); ?>

        <!-- start: Main Menu -->

        <!-- end: Main Menu -->
        <div id="content" class="span10">
                <?php
                $rw = $obj->get_desc();
                ?>
                
                

            
            	



            <!--/row-->
            <div class="row-fluid sortable">		
                <div class="box span12">
                    
                    <div class="box-header" data-original-title>
                        <h2><i class="icon-bar-chart"></i><span class="break"></span>Einzahlung</h2>

                    </div>
                    <div class="box-content">
                        <?php
                        ?>
                        <form  method="post" class="form-horizontal" action="desc.php">
                            <fieldset>

                                <div id="balance" class="control-group">
                                    <label class="control-label" for="typeahead">Name der Bank:</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead problem" name="desc1"  value = "<?php echo $rw['desc1']; ?>" id="desc1"  data-provide="typeahead" data-items="4"  >
                                    </div>
                                </div>  
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">IBAN:</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="desc2"  value = "<?php echo $rw['desc2']; ?>" id="desc2"  data-provide="typeahead" data-items="4"  >

                                    </div>
                                </div>  
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">BIC:</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="desc3" value = "<?php echo $rw['desc3']; ?>" id="desc3"  data-provide="typeahead" data-items="4" >

                                    </div>
                                </div> 

                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Verwendungszweck:</label>
                                    <div class="controls">
                                        <input type="text" class="span6 typeahead" name="desc4"  value = "<?php echo $rw['desc4']; ?>" id="desc4"  data-provide="typeahead" data-items="4" >

                                    </div>
                                </div> 
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Änderung speichern</button>
                                    <button type="reset" class="btn">Abbrechen</button>
                                </div>
                            </fieldset>
                        </form>   

                    </div>
                

            </div>




        </div>


        <!-- start: Content -->
        <!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->
<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
