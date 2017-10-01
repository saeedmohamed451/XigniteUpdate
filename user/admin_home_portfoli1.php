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
            $rw = $obj->get_user_info($_SESSION['userid']);
            ?>
            <input type ="hidden" name ="balanceval" id="balanceval" value="<?php echo $rw['balance']; ?>"/>







            <!--/row-->
            <div class="row-fluid sortable">		
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon user"></i><span class="break"></span>Kauforder</h2>
                        <?php
                        $rs = $obj->get_product_list($_SESSION['userid']);
                        $total = 0;
                        $cur_prices = array();
                        if ($rs) {
                            $i = 1;
                            while ($row = mysql_fetch_assoc($rs)) {
                                if ($row['quantity'] == 0) {
                                    $i++;
                                    continue;
                                }
                                set_time_limit(0);
                                $quote = $yf->getQuotes($row['symbol']);
                                $quotedata = json_decode($quote, true);
                                $resquote = $quotedata['query']['results']['quote'];
                                $currency = $resquote['Currency'];
                                $price = $resquote['LastTradePriceOnly'];
                                $date = $resquote['LastTradeDate'];
                                $time = $resquote['LastTradeTime'];
                                $change = $resquote['Change'];


                                if ($currency == "EUR") {
                                    $eur_price = $price;
                                } else {
                                    if ($currency == "") {
                                        $eur_price = 0;
                                    } else {
                                        $converting = $yf->currency_convert($currency, "EUR");
                                        $json = json_decode($converting, true);
                                        $key = $currency . "_EUR";
                                        $eur_price = $json[$key]['val'] * $price;
                                    }
                                }
                                $eur_price = sprintf("%.2f", $eur_price);
                                if( $row['released'] == 0 )
                                    $cur_prices[] = $eur_price;
                                $total = $total + $eur_price * $row['quantity'];
                            }
                        }
                        ?>
                        <h2 style = "float:right"><span class="break"></span><font color = "green"><?php echo "Aktienwert Depotwert: " . number_format($total, 2, ',', '.') . "€"; ?></font></h2>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>

                                    <th>Symbol</th>		
                                    <th>Name</th>
                                    <th>Datum und Uhrzeit</th>
                                    <th>Stückzahl</th>
                                    <th>Einstandskurs</th>
                                    <th>Einstandswert</th>
                                    <th>letzter Kurs</th>
                                    <th>Marktwert</th>
                                    <th>Buchgewinn</th>
                                    <th>Buchgewinn2</th>
                                    <th>Buchgewinn3</th>
                                    <th>Limit</th>
                                    <th>Börsenplatz</th>
                                    <!--<th>Aktion</th>-->
                                </tr>
                            </thead>     
                            <tbody>


                                <?php
                                $rs = $obj->get_product_list($_SESSION['userid']);
                                if ($rs) {
                                    $i = 1;
                                    $j = 0;
                                    while ($row = mysql_fetch_assoc($rs)) {
                                        if ($row['quantity'] == 0) {
                                            $i++;
                                            continue;
                                        }
                                        if ($row['released'] == 1)
                                            continue;
                                        $eur_price = sprintf("%.2f", $cur_prices[$j]);
                                        $j++;

                                        $symbol = $row['symbol'];
                                        $name = $row['name'];
                                        $change = $row['changes'];
                                        $datetime = $row['dates'];
                                        $cur_price = $eur_price;
                                        $price = $row['price'];
                                        $quantity = $row['quantity'];
                                        $id = $row['id'];
                                        $diff = $cur_price - $row['price'];
                                        $diff1 = $cur_price * $row['quantity'] - $row['price'] * $row['quantity'];
                                        $diff2 = $diff / $row['price'] * 100;
                                        ?> 
                                        <tr>
                                            <td><?php echo $row['symbol']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php
                                                $date = date_create($row['dates']);
                                                echo date_format($date, "d.m.Y H:i")
                                                ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><font color="black"><?php echo number_format($row['price'], 2, ',', '.') . "€"; ?></font></td>

                                            <td><font color = "black"><?php
                                                echo number_format($row['price'] * $row['quantity'], 2, ',', '.') . "€";
                                                ?></font></td>

                                            <td><font color = "black"><?php echo number_format($cur_price, 2, ',', '.') . "€"; ?></td>

                                            </font>
                                            <td><font color = "black"><?php
                                                echo number_format($cur_price * $row['quantity'], 2, ',', '.') . "€";
                                                ?></font></td>
                                            <?php
                                            if ($diff < 0) {
                                                ?>
                                                <td><font color = "red"><?php
                                                    echo number_format($diff, 2, ',', '.') . "€";
                                                    ?></font></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><font color = "green"><?php
                                                    echo number_format($diff, 2, ',', '.') . "€";
                                                    ?></font></td>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($diff1 < 0) {
                                                ?>
                                                <td><font color = "red"><?php
                                                    echo number_format($diff1, 2, ',', '.') . "€";
                                                    ?></font></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><font color = "green"><?php
                                                    echo number_format($diff1, 2, ',', '.') . "€";
                                                    ?></font></td>
                                                <?php
                                            }
                                            ?>                                  
                                            <?php
                                            if ($diff2 < 0) {
                                                ?>
                                                <td><font color = "red"><?php
                                                    echo number_format($diff2, 2, ',', '.') . "%";
                                                    ?></font></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><font color = "green"><?php
                                                    echo number_format($diff2, 2, ',', '.') . "%";
                                                    ?></font></td>
                                                <?php
                                            }
                                            ?>                                  
                                            <td><font color="black"><?php echo number_format($row['limit_value'], 2, ',', '.') . "€"; ?></font></td>
                                            <td><font color="black"><?php
                                                if ($row['place'] == "0")
                                                    echo "Xetra";
                                                else if ($row['place'] == "1")
                                                    echo "Frankfurt";
                                                else if( $row['place'] == "2")
                                                    echo "Berlin";
                                                else 
                                                    echo "Intern";
                                                ?></font></td>
                                            <!--<td class="center">
                                                <button type ="button" onclick="showAjaxModal('<?php echo $id; ?>', '<?php echo $symbol; ?>', '<?php echo $name; ?>', '<?php echo $price; ?>', '<?php echo $quantity; ?>', '<?php echo $cur_price; ?>', '<?php echo $change; ?>', '<?php echo $datetime; ?>')" class="btn btn-primary">verkaufen</button>
                                            </td>-->
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
<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
