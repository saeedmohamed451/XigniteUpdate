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
						<h2><i class="halflings-icon user"></i><span class="break"></span>Product List</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>			
							      <th>Product Code</th>											 								  <th>Name</th>
                                  <th>Category</th>
								 <!-- <th>Invetory</th>-->  
								  <th>Status</th>
								  <th>Featured Status</th>
								   <th>Todays Deal</th>
								      <th>Stock</th>
                                  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          
                          
                         <?php
		  $rs=$obj->fetch_product(); 
			if($rs)
		{ $i=1;
		while($row=mysql_fetch_assoc($rs))
        {
                $rs1=$obj->fetch_catbyid($row['category']);
                          
                         ?> 
							<tr>
								<td><?php echo $row['product_id']; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td class="center"><?php echo $rs1['category']; ?></td>
								<!--<td class="center"><a href="productstep1.php?pid=<?php echo $row['product_id']; ?>">Edit</a></td>-->
								<td class="center">
							   <?php if($row['status']==1){ ?><a href="status_pro.php?id=<?php echo $row['product_id']; ?>&status=0"><span class="label label-success">Active</span></a><?php } ?>
            <?php if($row['status']==0){ ?><a href="status_pro.php?id=<?php echo $row['product_id']; ?>&status=1"><span class="label label-important">Deactive</span><?php } ?></a></td>
                              <td class="center">
							   <?php if($row['hotstatus']==1){ ?><a href="hotstatus_pro.php?id=<?php echo $row['product_id']; ?>&status=0"><span class="label label-success">Yes</span></a><?php } ?>
            <?php if($row['hotstatus']==0){ ?><a href="hotstatus_pro.php?id=<?php echo $row['product_id']; ?>&status=1"><span class="label label-important">No</span><?php } ?></a></td>
			<td class="center">
							   <?php if($row['todaystatus']==1){ ?><a href="todaystatus.php?id=<?php echo $row['product_id']; ?>&status=0"><span class="label label-success">Yes</span></a><?php } ?>
            <?php if($row['todaystatus']==0){ ?><a href="todaystatus.php?id=<?php echo $row['product_id']; ?>&status=1"><span class="label label-important">No</span><?php } ?></a></td>
             <td class="center">
							   <?php if($row['stock_status']==1){ ?><a href="stock_status_pro.php?id=<?php echo $row['product_id']; ?>&status=0"><span class="label label-success">Yes</span></a><?php } ?>
            <?php if($row['stock_status']==0){ ?><a href="stock_status_pro.php?id=<?php echo $row['product_id']; ?>&status=1"><span class="label label-important">No</span><?php } ?></a></td>
								<td class="center">
									
									<a class="btn btn-info" href="edit_product.php?pid=<?php echo $row['product_id']; ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a onclick="return confirm('Please Confirm Delete');" class="btn btn-danger" href="del_product.php?id=<?php echo $row['product_id']; ?>">
										<i class="halflings-icon white trash"></i> 
									</a>
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
