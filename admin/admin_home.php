<?php include("header.php"); ?>
<!-- start: Header -->
<style type="text/css">
    <!--
    .style1 {color: #FF0000}
    -->
</style>


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
                        <h2><i class="halflings-icon cog"></i><span class="break"></span>Admin Profile</h2>

                    </div>
                    <div class="box-content">
                        <fieldset>


                            <div id="email1" class="control-group">
                                <label class="control-label" for="typeahead">Email </label>
                                <div class="controls">
                                    <input type="email" class="span6 typeahead" value="<?php echo $_SESSION['admin_email']; ?>" name="email" id="email"  data-provide="typeahead" data-items="4" required>

                                </div>
                            </div>  

                        </fieldset>

                    </div>
                </div><!--/span-->

            </div>	       

        </div>
        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->


<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
