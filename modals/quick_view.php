<?php session_start();
include_once("../include/database.php");
$obj= new database();
 $pro=$obj->fetch_productbyid($_GET['pid']); ?><!--==================================
		Quick view modal window
======================================-->

<div id="quick_view" class="modal_window">

	<button class="close arcticmodal-close"></button>

	<div class="clearfix">

		<!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

		<div class="single_product">

			<!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

			<div class="image_preview_container" id="qv_preview">

				<img id="img_zoom" data-zoom-image="product/<?php echo $pro['img']; ?>" src="product/<?php echo $pro['img']; ?>" alt="">

			</div><!--/ .image_preview_container-->

			<!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Prodcut thumbs carousel - - - - - - - - - - - - - - - - -->
			
			<!--/ .product_preview-->
			
			<!-- - - - - - - - - - - - - - End of prodcut thumbs carousel - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->
			
			
			<!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->

		</div>

		<!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->

		<div class="single_product_description">

			<h3><a href="#"><?php echo $pro['name']; ?></a></h3>

			

			<div class="description_section">

				 <table class="product_info">

                                                <tbody>

                                                    <tr>

                                                        <td>Brand: </td>
                                                        <td><a href="#"><?php $b=$obj->fetch_brandbyid($pro['brand_id']);  echo $b['brand_name']; ?></a></td>

                                                    </tr>


                                                    <tr>

                                                        <td>Product Code: </td>
                                                        <td><?php echo $pro['code']; ?></td>

                                                    </tr>

                                                </tbody>

                                            </table>

			</div>

			<hr>

			<div class="description_section">

				 <p><?php echo $pro['subdesc']; ?></p>

			</div>

			<hr>

			  <p class="product_price"><?php if($pro['d_price']==0 or $pro['d_price']==$pro['price']){
		?><b class="theme_color">₹<?php echo $pro['price']; ?></b>    <?php
		} else { ?>                      <s>₹<?php echo $pro['price']; ?></s> <b class="theme_color">₹<?php echo $pro['d_price']; ?></b><?php  } ?></p>

			<!-- - - - - - - - - - - - - - Product size - - - - - - - - - - - - - - - - -->

		

			<!-- - - - - - - - - - - - - - End of product size - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Quantity - - - - - - - - - - - - - - - - -->

			<div class="description_section_2 v_centered">
				
				<span class="title">Qty:</span>

				 <div class="qty min clearfix">

                                                <input type="number" min="1" name="qty" id="qty" value="1" >

                                            </div>

			</div>

			<!-- - - - - - - - - - - - - - End of quantity - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

			   <div class="buttons_row">

                                            <button class="button_blue middle_btn" onClick="addtocart('<?php echo $pro['product_id']; ?>');">Add to Cart</button>

                                        </div>

			<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

		</div>

		<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

	</div>

</div>

<!--==================================
		End quick view modal window
====================================== -->