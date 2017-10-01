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
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon cog"></i><span class="break"></span>Change Email</h2>

                    </div>
                    <div class="box-content">
                        <?php if (@$_SESSION['msg'] != "") { ?><div align="center" class="myalert"><?php echo $_SESSION['msg'];
                        $_SESSION['msg'] = ""; ?></div> <?php } ?><form method="post" class="form-horizontal" action="email_sub.php">
                            <fieldset>


                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Email </label>
                                    <div class="controls">
                                        <input type="email" class="span6 typeahead" value="<?php echo $_SESSION['admin_email']; ?>" name="email" id="email"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div>  

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" onClick="return valid();">Submit</button>
                                    <button type="reset" class="btn">Cancel</button>
                                </div>
                            </fieldset>
                        </form>   

                    </div>
                </div><!--/span-->

            </div>		
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon cog"></i><span class="break"></span>Change Password</h2>

                    </div>
                    <div class="box-content">
                        <?php if (@$_SESSION['msg'] != "") { ?><div align="center" class="myalert"><?php echo $_SESSION['msg'];
                        $_SESSION['msg'] = ""; ?></div> <?php } ?><form method="post" class="form-horizontal" action="pass_sub.php">
                            <fieldset>


                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Old Password </label>
                                    <div class="controls">
                                        <input type="password" class="span6 typeahead" name="oldpass" id="oldpass"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div>  
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">New Password </label>
                                    <div class="controls">
                                        <input type="password" class="span6 typeahead" name="newpass" id="newpass"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div id="email1" class="control-group">
                                    <label class="control-label" for="typeahead">Confirm Password </label>
                                    <div class="controls">
                                        <input type="password" class="span6 typeahead" name="conpass" id="conpass"  data-provide="typeahead" data-items="4" required>

                                    </div>
                                </div> 
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" onClick="return valid();">Submit</button>
                                    <button type="reset" class="btn">Cancel</button>
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

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<div class="clearfix"></div>

<?php include("footer.php"); ?>

</body>
</html>
