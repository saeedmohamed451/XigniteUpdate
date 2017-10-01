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
                        <h2><i class="halflings-icon book"></i><span class="break"></span>Aktie</h2>

                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>	
                                    <th>ID</th>
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
                                $rs = $obj->company_list();
                                if ($rs) {
                                    $i = 1;
                                    while ($row = mysql_fetch_object($rs)) {
                                            ?> 
                                            <tr>
                                                <td><?php echo $row->id; ?></td>
                                                <td><?php echo $row->symbol; ?></td>
                                                <td><?php echo $row->wkn; ?></td>
                                                <td><?php echo $row->firma; ?></td>
                                                <td><font color = "green"><?php echo number_format($row->kurs, 2, ',', '.')."€"; ?></font></td>
                                                <td><?php echo $row->platz; ?></td>
                                                <td><?php echo $row->frist; ?></td>
                                                <td class="center">
                                                    <a class="btn btn-info" href="company_edit.php?companyid=<?php echo $row->id;; ?>">
                                                        Bearbeiten
                                                    </a>
                                                    <!--<a onclick="return confirm('Please Confirm Delete');" class="btn btn-danger" href="user_del.php?user_id=<?php echo $row->id; ?>">
                                                        <i class="halflings-icon white trash"></i> 
                                                    </a>-->
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
