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
    function confirm() {
        
        var name = $("#name").val();
        var price = $("#cur_price").val();
        var quantity = $("#quantity").val();
       // var limit = $("#limit").val();
        var symbol = $("#symbol").val();
        
        var total = Number(quantity) * Number(price);
        var numberTotal = Number(total).format(2, 3, '.', ',');
        
        var place = $("#place").val();
        var szPlace = "Intern";
        if( place == 0 )
            szPlance = "Xetra";
        else if( place == 1 )
            szPlace = "Frankfurt";
        else if( place == 2 )
            szPlace = "Berlin";
        
        
        jQuery('#modal_ajax1 .modal-body').html('<label class="control-label" for="typeahead">' +
                'Anzahl: ' + quantity + '<BR>' +
                'Aktien: "' + name + '","' + symbol + "'<BR>" +
                'Preis: ' + price + '€<BR>' + 
                'Börsenplatz: ' + szPlace + '<BR>' +
                'Nach Ausführung der Order wird Ihr Kundenkonto mit dem Kaufpreis in Höhe von ' + numberTotal + '€ belastet.'
                );
        jQuery('#modal_ajax1').modal('show', {backdrop: 'true'});
    }
    function buy() {
        jQuery('#modal_ajax').modal('hide');
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
            url: 'sell_product_company.php',
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
                + '<div>Börsenplatz:<select id="place" name="place"><option value="0" selected>Xetra</option><option value="1" >Frankfurt</option><option value="2" >Berlin</option>\n\
                                                        <option value="3" >Intern</option></select><div><BR>'
                + '<label class="control-label" for="typeahead">Stückzahl</label>'
                + '<input type = "text" id = "quantity_sell" name = "quantity_sell" value="1" onkeypress="return isBalanceKey(this.id);" onkeyup="isBalanceKey1(this.id)"/><BR>'
                + '<input type="checkbox" style = "transform: scale(1.1);"  name="bestchk" id="bestchk" value="bestprice"> bestprice <BR>'
                + '<input type="checkbox" style = "transform: scale(1.1);" name="limitchk" id="limitchk" value="limitchk">Limit:'
                + '<input type = "text" id = "limit" name = "limit" value="0" onkeypress="return isBalanceKey(this.id);" onkeyup="isBalanceKey1(this.id)"/>'
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
    <!-- (Ajax Modal)-->
        <div class="modal fade" id="modal_ajax">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo "Wertpapiere verkaufen" ?></h4>
                    </div>

                    <div class="modal-body" >



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="confirm()" >verkaufen</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- (Ajax Modal)-->
        <div class="modal fade" id="modal_ajax1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo "Orderbestätigung" ?></h4>
                    </div>

                    <div class="modal-body" >



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="buy()" data-dismiss="modal">OK</button>
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
                        $rs = $obj->get_product_company_list($_SESSION['userid']);
                        $total = 0;
                        $cur_prices = array();
                        if ($rs) {
                            $i = 1;
                            while ($row = mysql_fetch_assoc($rs)) {
                                if ($row['quantity'] == 0) {
                                    $i++;
                                    continue;
                                }
                                if ($row['released'] == 0)
                                            continue;
                                set_time_limit(0);
                                $rowPrice = $obj->search_company_price($row['symbol'], $row['name']);
                                if( $rowPrice )
                                    $eur_price = $rowPrice['kurs'];
                                else
                                    $eur_price = "0";
                                $eur_price = sprintf("%.2f", $eur_price);
                                if ($row['released'] == 1)
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
                                    <th>Kaufdatum</th>
                                    <th>Stückzahl</th>
                                    <th>Einstandskurs</th>
                                    <th>Einstandswert</th>
                                    <th>letzter Kurs</th>
                                    <th>Marktwert</th>
                                    <th>G/V p.St</th>
                                    <th>G/V Total</th>
                                    <th>G/V %</th>
                                    <th>Limit</th>
                                    <th>Börsenplatz</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>     
                            <tbody>


                                <?php
                                $rs = $obj->get_product_company_list($_SESSION['userid']);
                                $total_quantity = 0;
                                $total_price = 0;
                                $total_quantity_price = 0;
                                $total_current_quantity_price = 0;
                                $total_diff1 = 0;
                                $total_diff2 = 0;
                                $total_diff3 = 0;
                                if ($rs) {
                                    $i = 1;
                                    $j = 0;
                                    while ($row = mysql_fetch_assoc($rs)) {
                                        if ($row['quantity'] == 0) {
                                            $i++;
                                            continue;
                                        }
                                        if ($row['released'] == 0)
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
                                            <td><?php echo $row['quantity']; 
                                                $total_quantity += $row['quantity'];
                                                                            ?></td>
                                            <td><font color="black"><?php echo number_format($row['price'], 2, ',', '.') . "€"; 
                                            $total_price += $row['price'];
                                
                                            ?></font></td>

                                            <td><font color = "black"><?php
                                                echo number_format($row['price'] * $row['quantity'], 2, ',', '.') . "€";
                                                $total_quantity_price +=  $row['price'] * $row['quantity'];
                                
                                                ?></font></td>

                                            <td><font color = "black"><?php echo number_format($cur_price, 2, ',', '.') . "€"; 
                                            
                                            ?></td>

                                            </font>
                                            <td><font color = "black"><?php
                                                echo number_format($cur_price * $row['quantity'], 2, ',', '.') . "€";
                                                $total_current_quantity_price += $cur_price * $row['quantity'];
                                
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
                                            $total_diff1 += $diff;
                                
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
                                            $total_diff2 += $diff1;
                                
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
                                            $total_diff3 += $diff2;
                                            ?>                                  
                                            <td><font color="black"><?php echo number_format($row['limit_value'], 2, ',', '.') . "€"; ?></font></td>
                                            <td><font color="black"><?php
                                                if ($row['place'] == "0")
                                                    echo "Xetra";
                                                else if ($row['place'] == "1")
                                                    echo "Frankfurt";
                                                else if ($row['place'] == "2")
                                                    echo "Berlin";
                                                else
                                                    echo "Intern";
                                                ?></font></td>
                                            <td class="center">
                                                <button type ="button" onclick="showAjaxModal('<?php echo $id; ?>', '<?php echo $symbol; ?>', '<?php echo $name; ?>', '<?php echo $price; ?>', '<?php echo $quantity; ?>', '<?php echo $cur_price; ?>', '<?php echo $change; ?>', '<?php echo $datetime; ?>')" class="btn btn-primary">verkaufen</button>
                                            </td>
                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                    if( $i > 1 ){
                                    ?>
                                    <tr>
                                            <td>Total</td>
                                            <td></td>
                                            <td></td>
                                            <td><font color="black"><?php 
                                            ?></font></td>
                                            <td><font color="black"><?php 
                                            ?></font></td>
                                            <td><font color="black"><?php echo number_format($total_quantity_price, 2, ',', '.') . "€";
                                            ?></font></td>

                                            <td></td>

                                            
                                            <td><font color="black"><?php echo number_format($total_current_quantity_price, 2, ',', '.') . "€";
                                            ?></font></td>
                                            <td><font color="black"><?php echo "";
                                            ?></font></td>
                                            <td><font color="black"><?php echo number_format($total_diff2, 2, ',', '.') . "€";
                                            ?></font></td>                                
                                            <td><font color="black"><?php echo "";
                                            ?></font></td>                                
                                            <td></td>
                                            <td></td>
                                            <td class="center">
                                                
                                            </td>
                                        </tr>
                                <?php  
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
