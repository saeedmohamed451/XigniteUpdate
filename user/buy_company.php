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
    function buy() {
        jQuery('#modal_ajax').modal('hide');

        var symbol = $("#symbol").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var change = $("#change").val();
        var datetime = $("#datetime").val();
        var quantity = $("#quantity").val();
        var limit = $("#limit").val();
        var place = $("#place").val();
        if (Number(limit) > 0)
            price = limit;

        $.ajax({
            url: 'buy_product_company.php',
            type: 'GET',
            data: {symbol: symbol, name: name, price: price, change: change, datetime: datetime, quantity: quantity, limit: limit, place: place},
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                //your success code
                //alert(response);
                if (response == "Kaufbetrag wurde erfolgreich abgebucht")
                {
                    var quantity = $("#quantity").val();
                    var price = $("#price").val();
                    var balance = $("#balance").val();

                    var total = Number(quantity) * Number(price);
                    var diff = Number(balance) - total;
                    $("#balance").val(diff);
                }
            },
            error: function () {
                //your error code
            }
        });

    }
    function confirm() {

        var name = $("#name").val();
        var price = $("#price").val();
        var quantity = $("#quantity").val();
        var limit = $("#limit").val();
        var symbol = $("#symbol").val();
        if (Number(limit) > 0)
            price = limit;

        var total = Number(quantity) * Number(price);
        var numberTotal = Number(total).format(2, 3, '.', ',');

        var place = $("#place").val();
        var szPlace = "Intern";
        if (place == 0)
            szPlance = "Xetra";
        else if (place == 1)
            szPlace = "Frankfurt";
        else if (place == 2)
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
    Number.prototype.format = function (n, x, s, c) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

        return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
    };
    function isBalanceKey1(txt) {
        //var res = isBalanceKey(txt);
        var limit = $("#limit").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var balance = $("#balance").val();

        if (Number(limit) > 0) {
            price = limit;
        }


        var total = Number(quantity) * Number(price);
        var diff = Number(balance) - total;


        var numberTotal = Number(total).format(2, 3, '.', ',') + "€";
        $("#total").html('Kaufpreis:<font color="green">' + numberTotal + '</font>');

        var numberDiff = Number(diff).format(2, 3, '.', ',') + "€";
        if (diff > 0)
            $("#rest").html('Rest Kontostand:<font color="green">' + numberDiff + '</font>');
        else
            $("#rest").html('Rest Kontostand:<font color="red">' + numberDiff + '</font>');
        return true;
    }
    function showAjaxModal(symbol, name, price)
    {
        // SHOWING AJAX PRELOADER IMAGE
        var balance = $("#balance").val();

        var numberBalance = Number(balance).format(2, 3, '.', ',') + "€";
        var numberPrice = Number(price).format(2, 3, '.', ',') + "€";
        var diff = Number(balance) - Number(price);
        var numberDiff = Number(diff).format(2, 3, '.', ',') + "€";
        jQuery('#modal_ajax .modal-body').html('<label class="control-label" for="typeahead">Symbol:' + symbol + '</label><BR>'
                + '<label class="control-label" for="typeahead">Wkn:' + name + '</label><BR>'

                + '<div>Börsenplatz:<select id="place" name="place"><option value="0" selected>Xetra</option><option value="1" >Frankfurt</option><option value="2" >Berlin</option>\n\
                                                        <option value="3" >Intern</option></select><div><BR>'
                + '<label class="control-label" for="typeahead">Preis:<font color="green">' + numberPrice + '</font></label><BR>'
                + '<label class="control-label" for="typeahead">Stückzahl</label>'
                + '<input type = "text" id = "quantity" name = "quantity" value="1" onkeypress="return isBalanceKey(this.id);" onkeyup="isBalanceKey1(this.id)"/><BR>'
                + '<input type="checkbox" style = "transform: scale(1.1);"  name="bestchk" id="bestchk" value="bestprice"> bestprice <BR>'
                + '<input type="checkbox" style = "transform: scale(1.1);" name="limitchk" id="limitchk" value="limitchk">Limit:'
                + '<input type = "text" id = "limit" name = "limit" value="0" onkeypress="return isBalanceKey(this.id);" onkeyup="isBalanceKey1(this.id)"/>'
                + '<label class="control-label" for="typeahead">Kontostand:<font color="green">' + numberBalance + '</font></label>'
                + '<label class="control-label" id = "total" name = "total" for="typeahead">Kaufpreis:<font color="green">' + numberPrice + '</font></label>'
                + '<label class="control-label" id = "rest" name = "rest" for="typeahead">Rest Kontostand:<font color="green">' + numberDiff + '</font></label>');


        // LOADING THE AJAX MODAL
        $("#symbol").val(symbol);
        $("#name").val(name);
        $("#price").val(price);
        $("#change").val("");
        $("#datetime").val("");


        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});



    }

</script>

<body>
    <?php
    $rw = $obj->get_user_info($_SESSION['userid']);
    ?>
    <input type ="hidden" name ="symbol" id="symbol"/>
    <input type ="hidden" name ="name" id="name"/>
    <input type ="hidden" name ="price" id="price"/>
    <input type ="hidden" name ="change" id="change"/>
    <input type ="hidden" name ="datetime" id="datetime"/>
    <input type ="hidden" name ="balance" id="balance" value ="<?php echo $rw['balance']; ?>"/>
    <div class="container-fluid-full">

        <!-- (Ajax Modal)-->
        <div class="modal fade" id="modal_ajax">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo "Wertpapiere Ordern" ?></h4>
                    </div>

                    <div class="modal-body" >



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="confirm()" >ordern</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">abbrechen</button>
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
            <?php include("leftside.php"); ?>
            <!-- start: Main Menu -->

            <!-- end: Main Menu -->
            <div id="content" class="span10">
                <div class="row-fluid sortable">

                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2><i class="icon-bar-chart"></i><span class="break"></span>Wertpapiere Suchen</h2>

                        </div>
                        <div class="box-content">
                            <?php
                            ?>
                            <form method="post" class="form-horizontal" action="buy_company.php">
                                <fieldset>
                                    <div id="email1" class="control-group">
                                        <label class="control-label" for="typeahead">Symbol/Wkn</label>
                                        <div class="controls">
                                            <input type="text" class="span6 typeahead" name="name"  id="name"  data-provide="typeahead" data-items="4" value = "<?php echo (isset($_REQUEST['name']) ? $_REQUEST['name'] : ''); ?>" required >
                                            <button type="submit" class="btn btn-primary">Suchen</button>
                                        </div>
                                    </div>  

                                </fieldset>
                            </form>   

                            <?php
                            if (isset($_REQUEST['name'])) {
                                $key = $_REQUEST['name'];
                                set_time_limit(0);
                                $rsSearch = $obj->search_company($key);
                                ?>
                                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                    <thead>
                                        <tr>	
                                            <th>Symbol</th>							
                                            <th>Wkn</th>							
                                            <th>Firma</th>
                                            <th>Kurs</th>
                                            <th>Börsenplatz</th>
                                            <th>VK Frist</th>
                                            <th>Aktion</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php
                                        if ($rsSearch) {
                                            while ($rowSearch = mysql_fetch_assoc($rsSearch)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowSearch['symbol']; ?></td>
                                                    <td><?php echo $rowSearch['wkn']; ?></td>
                                                    <td><?php echo $rowSearch['firma']; ?></td>
                                                    <td><?php echo $rowSearch['kurs']; ?></td>
                                                    <td><?php echo $rowSearch['platz']; ?></td>
                                                    <td><?php echo $rowSearch['frist']; ?></td>


                                                    <td class="center">
                                                        <button type ="button" onclick="showAjaxModal('<?php echo $rowSearch['symbol']; ?>', '<?php echo $rowSearch['wkn']; ?>', '<?php echo $rowSearch['kurs']; ?>')" class="btn btn-primary">Ordern</button>


                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>   
                                    </tbody>
                                </table>    
                                <?php
                            }
                            ?>
                        </div>
                    </div><!--/span-->

                </div>	




                <!--/row-->





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
