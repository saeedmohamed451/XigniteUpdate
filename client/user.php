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
			<?php
if(@$_SESSION['msg']!=""){?><div align="center" class="myalert"><?php  echo $_SESSION['msg']; $_SESSION['msg']="";?></div> <?php } ?>
				

			</div>		
			
			<!--/row-->
		
			
		<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>User List</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>			
							      <th>S No.</th>	
								  <th>Name</th>										 							
                                  <th>Email</th>
								  <th>Phone</th>
                                  <th>Address</th>
								  <th>Delivery Address</th>
							  </tr>
						  </thead>   
						  <tbody>
                          
                          
                         <?php
		  $rs=$obj->fetch_user(); 
			if($rs)
		{ $i=1;
		while($row=mysql_fetch_assoc($rs))
        {
                ?> 
							<tr>
								<td><?php echo $row['user_id']; ?></td>
								
								<td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
								<td class="center"><?php echo $row['email']; ?></td>
								<td class="center"><?php echo $row['phone']; ?></td>
								<td class="center">
								<?php echo $row['address']; ?>, <?php $city=$obj->fetch_citybyid($row['city']);  echo $city['city']; ?>, <?php $state=$obj->fetch_statebyid($row['state']);  echo $state['state']; ?>, <?php $country=$obj->fetch_countrybyid($row['country']);  echo $country['country'];  ?>
								</td>
								<td class="center">
								<?php echo $row['d_address']; ?>, <?php $city=$obj->fetch_citybyid($row['d_city']);  echo $city['city']; ?>, <?php $state=$obj->fetch_statebyid($row['d_state']);  echo $state['state']; ?>, <?php $country=$obj->fetch_countrybyid($row['d_country']);  echo $country['country'];  ?>
								</td>
							</tr>
                            
                         <?php $i++; } } ?>   
                            
                            
                            
                            
                            
                            
                            
                            
                            
							
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
