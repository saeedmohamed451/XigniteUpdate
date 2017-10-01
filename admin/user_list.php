<?php include("header.php"); ?>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <?php include("leftside.php"); ?>
        <!-- end: Main Menu -->
        <!-- start: Content -->

        <div id="content" class="span10">
            <div class="row-fluid sortable">
                <?php if (@$_SESSION['msg'] != "") { ?><div align="center" class="myalert"><?php echo $_SESSION['msg'];
                $_SESSION['msg'] = ""; ?></div> <?php } ?>


            </div>		

            <!--/row-->


            <div class="row-fluid sortable">		
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon user"></i><span class="break"></span>Kundenliste</h2>

                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>	
                                    <th>Kunden ID</th>
                                    <th>Name</th>							
                                    <th>Username</th>							
                                    <th>Straße</th>
                                    <th>Tel.1</th>
                                    <th>Tel.2</th>
                                    <th>PLZ</th>
                                    <th>Ort</th>
                                    <th>Email</th>
                                    <th>Fax</th>
                                    <th>Kontoguthaben</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>   
                            <tbody>


                                <?php
                                $rs = $obj->user_data();
                                if ($rs) {
                                    $i = 1;
                                    while ($row = mysql_fetch_object($rs)) {
                                            ?> 
                                            <tr>
                                                <td><?php echo $row->id; ?></td>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->email; ?></td>
                                                <td><?php echo $row->street; ?></td>
                                                <td><?php echo $row->phone; ?></td>
                                                <td><?php echo $row->tel2; ?></td>
                                                <td><?php echo $row->plz; ?></td>
                                                <td><?php echo $row->ort; ?></td>
                                                <td><?php echo $row->email2; ?></td>
                                                <td><?php echo $row->fax; ?></td>
                                                <td><font color = "green"><?php echo number_format($row->balance, 2, ',', '.')."€"; ?></font></td>
                                                <td class="center">
                                                    <a class="btn btn-info" href="user_edit.php?user_id=<?php echo $row->id; ?>">
                                                        <i class="halflings-icon white edit"></i>  
                                                    </a>
                                                    <a class="btn btn-info" href="user_portfoli.php?user_id=<?php echo $row->id; ?>">
                                                        <i class="halflings-icon white detail"></i>  
                                                    </a>
                                                    <a onclick="return confirm('Please Confirm Delete');" class="btn btn-danger" href="user_del.php?user_id=<?php echo $row->id; ?>">
                                                        <i class="halflings-icon white trash"></i> 
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php $i++;
                                        }
                                } ?>   
                            </tbody>
                        </table>            
                    </div>
                </div><!--/span-->

            </div>

        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->



<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
