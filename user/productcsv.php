<?php
include("isvalid.php");
$output = "";
$sql = mysql_query("select product_id, name, price, d_price, w_price, search_keyword FROM product");
	
$columns_total 	= mysql_num_fields($sql);
// Get The Field Name
for ($i = 0; $i < $columns_total; $i++) {
	$heading	=	mysql_field_name($sql, $i);
	$output		.= '"'.$heading.'",';
}
$output .="\n";
// Get Records from the table
while ($row = mysql_fetch_array($sql)) {
	for ($i = 0; $i < $columns_total; $i++) {
		$output .='"'.$row["$i"].'",';
	}
	$output .="\n";
}
// Download the file
$filename =  "productlist.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;
?>