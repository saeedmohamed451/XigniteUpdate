<?php include("header.php"); ?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php include("leftside.php"); 
			?>
			<!-- end: Main Menu -->
			
			
			
			<!-- start: Content -->
			
			<div id="content" class="span10">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Setting</h2>
						
					</div>
					<div class="box-content">
					
						<?php	
						$rs123=$obj->fetch_site_detail(1); 

						
if(@$_SESSION['msg']!=""){?><div align="center" class="myalert"><?php  echo $_SESSION['msg']; $_SESSION['msg']="";?></div> <?php } ?><form method="post" class="form-horizontal" enctype="multipart/form-data" action="setting_sub.php">
						  <fieldset>
							
				
                            <div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Site Name </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="sname" id="sname" value="<?php echo $rs123['sname']; ?>"  data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div> 
							 <div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Site Title </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="stitle" id="stitle" value="<?php echo $rs123['stitle']; ?>"  data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div>  
							 <div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Site Email </label>
							  <div class="controls">
								<input type="email" class="span6 typeahead" name="semail" id="semail" value="<?php echo $rs123['semail']; ?>"  data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div> 
                            <div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Site Phone No.</label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="sphone" id="sphone" value="<?php echo $rs123['sphone']; ?>"  data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div>
							<div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Site Fax No.</label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="sfax" id="sfax" value="<?php echo $rs123['fax']; ?>"  data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div>
							<div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Admin Email </label>
							  <div class="controls">
								<input type="email" class="span6 typeahead" name="aemail" id="aemail" value="<?php echo $rs123['aemail']; ?>"  data-provide="typeahead" data-items="4" required>
								
							  </div>
							</div>
							<div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Address</label>
							  <div class="controls">
								<textarea  class="span6 typeahead" name="address" id="address"   data-provide="typeahead" required><?php echo $rs123['address']; ?></textarea>
								
							  </div>
							</div>
							 <div id="email1" class="control-group">
							  <label class="control-label" for="typeahead">Site Logo </label>
							  <div class="controls">
		      	<input class="input-file uniform_on" id="fileInput" name="img" type="file"> Logo size - 140x50 px
							  </div>
							</div> 
							
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" onClick="return valid();">Save Change</button>
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
		
	
	
	<div class="clearfix"></div>
	
	<?php include("footer.php"); ?>
	
</body>
</html>
