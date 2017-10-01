<?php

include_once("config.php");

class database

{

	private $link;

	function __construct()

	{

		$this->link = mysql_connect(config::host,config::username,config::password);

		mysql_select_db(config::database,$this->link) or die(mysql_error());

	}

	function __distruct()

	{

		mysql_close($this->link);

	}

	function forgot_adminpass($email)

	 { 

		 $sql = "select * from admin where email='$email'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function admin_login($username,$pass)

  {

   $sql = sprintf("select * from admin where username ='%s' and password='%s' and status='1'",$username,$pass);

  $rs=mysql_query($sql,$this->link) or die(mysql_error());

  if(mysql_num_rows($rs)==1)

  return mysql_fetch_assoc($rs);

     return false;

  }

  

  function employee_data()

  { 

   $sql = "select * from admin";

  $rs=mysql_query($sql,$this->link) or die(mysql_error());

  if(mysql_num_rows($rs)>=1)

  return $rs;

     return false;

  }

   function status_emp($status,$id)

  {   

 $sql="update admin set status='$status' where aid='$id'";

     mysql_query($sql,$this->link)or die(mysql_error());

  if(mysql_affected_rows()==1)

  return true;

  else

  return false;

     }

   function emp_data_id($id)

  { 

   $sql = "select * from admin where aid='$id'";

  $rs=mysql_query($sql,$this->link) or die(mysql_error());

  if(mysql_num_rows($rs)==1)

  return mysql_fetch_assoc($rs);

     return false;

  }

   function job_data()

  { 

   $sql = "select * from job";

  $rs=mysql_query($sql,$this->link) or die(mysql_error());

  if(mysql_num_rows($rs)>=1)

  return $rs;

     return false;

  }

    function job_data_id($id)

  { 

   $sql = "select * from job where id='$id'";

  $rs=mysql_query($sql,$this->link) or die(mysql_error());

  if(mysql_num_rows($rs)==1)

  return mysql_fetch_assoc($rs);

     return false;

  }

   function del_emp($id)

  {

   $sql=sprintf("delete FROM admin where aid=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)  

      return true;

      else

      return false;

  }

  function add_employe($email,$user_name,$password,$job)

  {   

  $date1=date('Y-m-d');

 $sql=sprintf("insert into  admin(username,email,password,reg_date,job_status)values('$user_name','$email','$password','$date1','$job')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

     return mysql_insert_id();

      return false;

     }

    function update_employe($email,$user_name,$password,$job,$id)

  {

     $sql = sprintf("update admin set email='$email',username='$user_name',password='$password',job_status='$job' where aid='$id'");

     $rs=mysql_query($sql,$this->link)or die(mysql_error());

  if(mysql_affected_rows()==1)

  return true;

  else

  return false;

  }

	  function acheck_pass($username,$pass)

	 {

	 	$sql = sprintf("select * from admin where aid ='%s' and password='%s'",$username,$pass);

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	  function achange_pss($username,$newpass)

	 {

	    $sql = sprintf("update admin set password='$newpass' where aid='$username'");

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	  function fetch_country()

	 { 

		$sql = sprintf("select * from country");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function add_country($country)

	 {   

	 $sql=sprintf("insert into  country(country)values('$country')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function del_country($id)

	 {

	  $sql=sprintf("delete FROM country where country_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 

	 function add_state($country,$state)

	 {   

	 $sql=sprintf("insert into  state(country_id,state)values('$country','$state')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function del_state($id)

	 {

	  $sql=sprintf("delete FROM state where state_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 

	 function add_city($city,$state)

	 {   

	 $sql=sprintf("insert into  city(city,state_id)values('$city','$state')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function del_city($id)

	 {

	  $sql=sprintf("delete FROM city where city_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	  function fetch_state()

	 { 

		$sql = sprintf("select * from state");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	   function fetch_city()

	 { 

		$sql = sprintf("select * from city");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 function fetch_statesbycid($id)

	 { 

		$sql = "select * from state where country_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 function fetch_citybysid($id)

	 { 

		$sql = "select * from city where state_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 function fetch_statebyid($id)

	 { 

		$sql = "select * from state where state_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function fetch_citybyid($id)

	 { 

		$sql = "select * from city where city_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function fetch_category()

	 { 

		$sql = sprintf("select * from category");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 function fetch_categoryposi()

	 { 

		$sql = sprintf("select * from category order by position ASC");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 function fetch_catbyid($id)

	 { 

		$sql = "select * from category where category_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 function update_category($id,$category,$seotitle,$seodesc,$seokey,$img,$discount)

	 {  

	    $sql="update category set category='$category', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey',img='$img', discount='$discount' where category_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	  function fetch_subcategory()

	 { 

		$sql = sprintf("select * from subcategory");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	   function fetch_subtopic()

	 { 

		$sql = sprintf("select * from subtopic");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 function fetch_subcatbyid($id)

	 { 

		$sql = "select * from subcategory where subcategory_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	  function update_subtopic($subtopic,$id,$seotitle,$seodesc,$seokey)

	 {  

	    $sql="update subtopic set subtopic='$subtopic', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey' where subtopic_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	 function update_subcategory($subcategory,$id,$seotitle,$seodesc,$seokey)

	 {  

	    $sql="update subcategory set subcategory='$subcategory', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey' where subcategory_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	 function add_category($category,$seotitle,$seodesc,$seokey,$img,$discount)

	 {   

	 $sql=sprintf("insert into  category(category,seo_tit,seo_desc,seo_key,img,discount)values('$category','$seotitle','$seodesc','$seokey','$img','$discount')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function del_category($id)

	 {

	  $sql=sprintf("delete FROM category where category_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 

	 function add_subcategory($category,$subcategory,$seotitle,$seodesc,$seokey)

	 {   

	 $sql=sprintf("insert into  subcategory(category_id,subcategory,seo_tit,seo_desc,seo_key)values('$category','$subcategory','$seotitle','$seodesc','$seokey')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	  function fetch_subtopicbycid($id)

	 { 

		$sql = "select * from subtopic where subcategory_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function fetch_subtopicbyid($id)

	 { 

		$sql = "select * from subtopic where subtopic_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function fetch_subcatbycid($id)

	 { 

		$sql = "select * from subcategory where category_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 function fetch_subcatbycidposi($id)

	 { 

		$sql = "select * from subcategory where category_id='$id' order by position ASC";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function add_subtopic($category,$subcategory,$subtopic,$seotitle,$seodesc,$seokey)

	 {   

	 $sql=sprintf("insert into  subtopic(cat_id,subtopic,subcategory_id,seo_tit,seo_desc,seo_key)values('$category','$subtopic','$subcategory','$seotitle','$seodesc','$seokey')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function del_subtopic($id)

	 {

	  $sql=sprintf("delete FROM subtopic where subtopic_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	  	  

	 function del_subcategory($id)

	 {

	  $sql=sprintf("delete FROM subcategory where subcategory_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 

	  function fetch_site_detail($id)

    { 

    $sql = sprintf("select * from site_detail where id='$id'");

    $rs=mysql_query($sql,$this->link) or die(mysql_error());

    if(mysql_num_rows($rs)==1)

    return mysql_fetch_assoc($rs);

     return false;

    }

   function update_detail($sname,$stitle,$semail,$sphone,$aemail,$logo,$sfax,$address)

  {

     $sql = sprintf("update site_detail set sname='$sname', stitle='$stitle', semail='$semail', sphone='$sphone', aemail='$aemail', logo='$logo', fax='$sfax', address='$address' where id='1'");

     $rs=mysql_query($sql,$this->link)or die(mysql_error());

  if(mysql_affected_rows()==1)

  return true;

  else

  return false;

  }

  

  function update_ref($referee,$referral)

  {

     $sql = sprintf("update site_detail set referee='$referee', referral='$referral' where id='1'");

     $rs=mysql_query($sql,$this->link)or die(mysql_error());

  if(mysql_affected_rows()==1)

  return true;

  else

  return false;

  }

  

	function add_photo($advpos,$tit,$img,$url,$txt_size,$txt_color,$btn_color)

	{

	   $sql=sprintf("insert into flash (center_id,tit,image,url,status,txt_size,txt_color,btn_color) VALUES ('$advpos','$tit','$img','$url',1,'$txt_size','$txt_color','$btn_color')");

	   $rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

	    return false;

	}

	function fetch_photo()

	{

	    $sql = sprintf("select * from flash");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	

	function fetch_photobytype($id)

	{

	    $sql = sprintf("select * from flash where center_id='$id'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	function deleteflash($aid)

	{

	  $sql = sprintf("delete from flash where fid='$aid'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		 if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	}

	function fetch_flashbycid($cid)

	{

	  $sql = sprintf("select * from flash where center_id='$cid'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	function fetch_flashbyid($cid)

	{

	  $sql = sprintf("select * from flash where fid='$cid'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	}

		function fetch_data()

	 {

	 	 $sql = sprintf("select * from data");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 function fetch_data1()

	 {

	 	 $sql = sprintf("select * from data where status=1");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function fetch_databyid($id)

	 {

	 	 $sql = sprintf("select * from data where did='$id'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	  function update_contant($id,$title,$contant,$seotitle,$seodesc,$seokey)

	 {

	    $sql = ("update data set title='$title', contant='$contant', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey' where did='$id'");

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	  function fetch_user()

	 {

	 	 $sql = sprintf("select * from reg_user");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function fetch_brand()

	 { 

		$sql = "select * from brand";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 

	 function add_brand($brandname,$desc,$discount)

	 {   

	  $sql=sprintf("insert into  brand(brand_name,bdesc,discount)values('$brandname','$desc','$discount')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function add_contant($title,$contant,$seotitle,$seodesc,$seokey)

	 {

	    $sql = "insert into data (title,contant,seo_tit,seo_desc,seo_key)values('$title','$contant','$seotitle','$seodesc','$seokey')";

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

	 }

	 

	 function fetch_brandbyid($id)

	 { 

		$sql = "select * from brand where brand_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 function update_brand($brandname,$id,$desc,$discount)

	 {  

	    $sql="update brand set brand_name='$brandname', bdesc='$desc',discount='$discount' where brand_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	 function del_brand($id)

	 {

	  $sql=sprintf("delete FROM brand where brand_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 

	  function del_content($id)

	 {

	  $sql=sprintf("delete FROM data where did=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	  function status_data($status,$id)

	 {   

	$sql="update data set status='$status' where did='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	 function fetch_product()

	 { 

		$sql = "select * from product";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function fetch_product1()

	 { 

		$sql = "select * from product where status=1";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 function add_product($name,$code,$desc,$seotit,$seodesc,$seokey,$price,$d_price,$wprice,$scharge,$category,$subcategory,$subtopic,$img1,$brand,$subdesc,$status,$discount,$stockstatus)

	 {   

	 $date1=date('Y-m-d');

	$sql=("insert into  product(name,code,pro_desc,seotitle,seodesc,seokey,price,d_price,w_price,scharge,category,subcategory,subtopic,img,date,status,brand_id,subdesc,discount,stock_status)values('$name','$code','$desc','$seotit','$seodesc','$seokey','$price','$d_price','$wprice','$scharge','$category','$subcategory','$subtopic','$img1','$date1','$status','$brand','$subdesc','$discount','$stockstatus')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	  function stock_status_pro($status,$id)

	 {   

	$sql="update product set stock_status='$status' where product_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	  function hotstatus_pro($status,$id)

	 {   

	$sql="update product set hotstatus='$status' where product_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	  function todaystatus($status,$id)

	 {   

	$sql="update product set todaystatus='$status' where product_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	 

	 function status_flash($status,$id)

	 {   

	$sql="update flash set status='$status' where fid='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	 function status_pro($status,$id)

	 {   

	$sql="update product set status='$status' where product_id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	 

	  function del_product($id)

	 {

	  $sql=sprintf("delete FROM product where product_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	  function fetch_productbyid($id)

	 { 

		 $sql = "select * from product where product_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function update_productstep($pid,$name,$code,$desc,$seotit,$seodesc,$seokey,$price,$dprice,$wprice,$scharge,$category,$subcategory,$subtopic,$img1,$discount,$stockstatus)

  {

     $sql = ("update product set name='$name', code='$code', pro_desc='$desc', seotitle='$seotit', seodesc='$seodesc', seokey='$seokey', price='$price', d_price='$dprice',scharge='$scharge',category='$category',subcategory='$subcategory',subtopic='$subtopic',img='$img1',w_price='$wprice',discount=$discount,stock_status='$stockstatus' where product_id='$pid'");

     $rs=mysql_query($sql,$this->link)or die(mysql_error());

  if(mysql_affected_rows()==1)

  return true;

  else

  return false;

  }

   function fetch_noproorder($id)

	  {

	    $sql=sprintf("SELECT count(*) as no FROM product_order where orderid='$id'");

	    $rs_count=mysql_query($sql,$this->link);

	    $data= mysql_fetch_assoc($rs_count);

		if($data)		

        return $data['no'];	

		return false; 	

      }

	  function fetch_finalorder($id)

	 { 

		$sql = "select * from finalorder where paystatus=1 and deliverstatus='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function status_order($status,$id)

	 {   

	 

	

	$sql="update finalorder set deliverstatus='$status' where forderid='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	 

	 function fetch_finalorderreport($date)

	 { 

		 $sql = "select sum(total) as v from finalorder where order_date like('%$date%') and  paystatus=1 ";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		{

		$row=mysql_fetch_assoc($rs);

		if($row['v']!=0)

		{

		return $row['v'];

		}

		else

		{

		return 0;

		}

		}

		else

		{

		return 0;

		}

	 }

	



	 function email_change($username,$email)

	 {

	    $sql = sprintf("update admin set email='$email' where aid='$username'");

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 function change_pass($username,$newpass)

	 {

	    $sql = sprintf("update reg_user set password='$newpass' where user_id='$username'");

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	

	

 function user_sub($title,$fname,$lname,$email,$password,$phone,$address,$city,$state,$country,$zip,$daddress,$dcity,$dstate,$dcountry,$dzip,$referrel,$code)

	 {   

	 $date1=date('Y-m-d');

	$sql=sprintf("insert into  reg_user(title,fname,lname,email,password,phone,address,city,state,country,zip,d_address,d_city,d_state,d_country,d_zip,reg_date,status,referby,referral_code)values('$title','$fname','$lname','$email','$password','$phone','$address','$city','$state','$country','$zip','$daddress','$dcity','$dstate','$dcountry','$dzip','$date1',0,'$referrel','$code')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	 function check_login($username,$pass)

	 {

	 	$sql = sprintf("select * from reg_user where email ='$username' and password='$pass' and status=1");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function forgot_pass($email)

	 { 

		 $sql = "select * from reg_user where email='$email'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	  function checkcode($code)

	 { 

		 $sql = "select * from reg_user where referral_code='$code'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function check_pass($username,$pass)

	 {

	 	$sql = sprintf("select * from reg_user where user_id ='%s' and password='%s'",$username,$pass);

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	

	 

	 function fetch_hotproduct($hsts,$limit,$cat)

	{   $date=date("Y-m-d H:i:s");

	    $sql = sprintf("select * from product where hotstatus='$hsts'and category='$cat'and status=1 order by product_id DESC limit $limit");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	

	 function fetch_reletedproduct($cat,$limit)

	{   $date=date("Y-m-d H:i:s");

	    $sql = sprintf("select * from product where category='$cat'and status=1 order by product_id DESC limit $limit");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	

	 function fetch_todaydeal($hsts,$limit,$cat)

	{   $date=date("Y-m-d H:i:s");

	    $sql = sprintf("select * from product where todaystatus='$hsts'and category='$cat' and status=1 order by product_id DESC limit $limit");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	   function fetch_latestproduct($cat)

	{  

	    $sql = sprintf("select * from product where category='$cat'and status=1  order by product_id DESC limit 8");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	}

	  function fetch_userbyid($id)

	 {

	 	 $sql = sprintf("select * from reg_user where user_id ='%s'",$id);

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	  function fetch_orderbyid($id)

	 { 

		$sql = "select * from finalorder where forderid='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	  function fetch_proorderbyid($id)

	 {

	 	 $sql = sprintf("select * from product_order where orderid ='$id'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function add_coupon($ctitle,$ccode,$dtype,$discount,$mamount,$sdate,$edate)

	 {   

	 $date1=date('Y-m-d');

	$sql=("insert into  coupon(coupon_name,code,discount,dtype,amount_total,date_start,date_end,create_date,status)values('$ctitle','$ccode','$discount','$dtype','$mamount','$sdate','$edate','$date1',1)");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	  function fetch_couponcode($code)

	 {

	 	 $sql = sprintf("select * from  coupon where code ='$code'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	  function fetch_couponbyid($id)

	 {

	 	 $sql = sprintf("select * from  coupon where id ='$id'");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	  function fetch_coupon()

	 {

	 	 $sql = sprintf("select * from  coupon");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function status_coupon($status,$id)

	 {   

	$sql="update coupon set status='$status' where id='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	 

	  function del_coupon($id)

	 {

	  $sql=sprintf("delete FROM coupon where id=$id");

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 function update_coupon($id,$ctitle,$ccode,$dtype,$discount,$mamount,$sdate,$edate)

	 {   

	 $sql="update coupon set coupon_name='$ctitle',code='$ccode',discount='$discount',dtype='$dtype',amount_total='$mamount',date_start='$sdate',date_end='$edate' where id='$id'";

       mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	  function fetch_catbyname($name)

	 { 

		 $sql = "select * from category where category='$name'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	  function fetch_subtopicbyname($name,$id)

	 { 

		$sql = "select * from subtopic where subtopic='$name' and subcategory_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 function fetch_subcatbyname($name,$id)

	 { 

		$sql = "select * from subcategory where subcategory='$name' and category_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	  function fetch_brandbyname($name)

	 { 

		$sql = "select * from brand where brand_name='$name'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	  function update_status($email)

	 {  

	    $sql="update reg_user set status=1 where email='$email'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	  function fetch_addtocartbyuser($uid)

	 { 

		$sql = "select * from  product_order where user_id='$uid'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function update_addtocartuser($uid,$userid)

	 {

	   $sql = sprintf("update product_order set user_id='$userid' where user_id='$uid'");

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 } 

	 function fetch_productsearch($name,$cat)

	 {  

	 if($cat==0){

	 $cat1='%';}

	 else{

	 $cat1=$cat;

	 }

	    $sql = "select * from product where name like('%$name%') and category like('$cat1') and status=1 ";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 } 

	 

	 function fetch_temporder($sid,$sts)

	 {

	    $sql = "select * from product_order where user_id ='$sid' and status ='$sts'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 function updatecartitems($id,$qty)

	 {  

	    $sql="update product_order set qty='$qty' where oid='$id'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 

	 

	 

	 function checkuserinventory($sid,$pid,$sts)

	 { 

		 $sql = "select * from  product_order where product_id='$pid' and user_id='$sid' and status='$sts'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	 function addtocart($sid,$pid,$price,$d_price,$qty)

	 {   

	 $date1=date('Y-m-d');

	 $sql=sprintf("insert into product_order(product_id,user_id,price,discountprice,qty,status,odate) values ('$pid','$sid','$price','$d_price','$qty',0,'$date1')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	  function updatecart($oid,$qty)

	 {   

	    $sql="update product_order set qty='$qty' where oid='$oid'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

     }

	  function deletecartitem($id)

	 {

	  $sql=sprintf("delete FROM product_order where oid=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	  function addfinorder($uid,$email,$total,$dis,$scharge,$wprice,$code,$bname,$bphone,$baddress,$bcountry,$bstate,$bcity,$bzip,$pmethod,$dmethod,$slot)

	 {   

	  $date1=date('Y-m-d');

	  $time1=date('h:i:s');

	 $sql=sprintf("insert into  finalorder(user_id,total,scharge,wtotal,cdiscount,ccode,order_date,order_time,paystatus,b_name,b_phone,b_address,b_country,b_state,b_city,b_zip,email,pmethod,dmethod,oslote)values('$uid','$total','$scharge','$wprice','$dis','$code','$date1','$time1',1,'$bname','$bphone','$baddress','$bcountry','$bstate','$bcity','$bzip','$email','$pmethod','$dmethod','$slot')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	 

	  function update_ordercart($oid,$foid)

	 {

	   $sql = "update product_order set status=1, orderid='$foid' where oid='$oid'";

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }	

	  function  subscriber_sub($email)

	 {   

	 $date=date("Y-m-d");

	 $sql=sprintf("insert into  subscriber(email,sdate)values('$email','$date')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

	  function fetch_semail($email)

	 { 

		$sql = sprintf("select * from subscriber where email='%s'",$email);

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 

	  function contact_sub($name,$email,$subject,$message)

	 {   

	 $sql=sprintf("insert into  contact(name,email,subject,msg)values('$name','$email','$subject','$message')");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }	

	  function fetch_countrybyid($id)

	 { 

		$sql = "select * from country where country_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)==1)

		return mysql_fetch_assoc($rs);

	    return false;

	 }

	 function fetch_contact()

	 { 

		$sql = "select * from contact";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	 function fetch_subscriber()

	 {

	 	 $sql = sprintf("select * from subscriber");

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function fetch_finalordercount($date)

	  {

	    $sql="SELECT count(*) as no FROM finalorder where order_date like('%$date%')";

	    $rs_count=mysql_query($sql,$this->link);

	    $data= mysql_fetch_assoc($rs_count);

		if($data)		

        return $data['no'];	

		return false; 	

      }

	  

	  function fetch_order($id)

	 { 

		$sql = "select * from finalorder where user_id='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function fetch_ordergross()

	 { 

		$sql = "select * from finalorder";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function fetch_ordergrossbyslote($slote)

	 { 

		$sql = "select * from finalorder where oslote like('%$slote')";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	  function fetch_productbycategories($catid,$subcatid,$topicid,$name)

	 {  $date=date("Y-m-d H:i:s");

	    $sql = "select * from product where name like('$name%') and category like('$catid%') and subcategory like('$subcatid%') and subtopic like('$topicid%') and status=1 ";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 } 

	 

	  function update_profile($userid,$fname,$lname,$phone,$address,$country,$state,$city,$zip,$daddress,$dcountry,$dstate,$dcity,$dzip)

	 {  

	    $sql="update reg_user set fname='$fname', lname='$lname', phone='$phone' , address='$address'  ,country='$country',state='$state',city='$city' , zip='$zip', d_address='$daddress'  ,d_country='$dcountry',d_state='$dstate',d_city='$dcity' , d_zip='$zip'  where user_id='$userid'";

	    mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	 function update_photo($id,$center,$tit,$img,$url,$txt_size,$txt_color,$btn_color)

	 {

	    $sql = ("update flash set tit='$tit', center_id='$center', url='$url', image='$img',txt_size='$txt_size',txt_color='$txt_color',btn_color='$btn_color' where fid='$id'");

	    $rs=mysql_query($sql,$this->link)or die(mysql_error());

		if(mysql_affected_rows()==1)

		return true;

		else

		return false;

	 }

	

	 function clearcartitem($id)

	 {

	  $sql=sprintf("delete FROM product_order where user_id=%d",$id);

      $rs = mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)		

      return true;

      else

      return false;

	 }

	 

	 function fetch_accountbyuid($id)

	 { 

		$sql = "select * from account where uid='$id'";

		$rs=mysql_query($sql,$this->link) or die(mysql_error());

		if(mysql_num_rows($rs)!=0)

		return $rs;

	    return false;

	 }

	 

	  function fetch_refby($id)

    { 

    $sql = sprintf("select * from reg_user where referral_code='$id'");

    $rs=mysql_query($sql,$this->link) or die(mysql_error());

    if(mysql_num_rows($rs)==1)

    return mysql_fetch_assoc($rs);

     return false;

    }

	 function add_amount($user_id,$referee,$detail,$oid,$ttype)

	 {   

	 $date1=date('Y-m-d h:i:s');

	 $sql=sprintf("insert into  account(uid,amount,detail,oid,ttype,sdate,status)values('$user_id','$referee','$detail','$oid',$ttype,'$date1',1)");

      $rs=mysql_query($sql,$this->link);

      if(mysql_affected_rows()==1)

  	  return mysql_insert_id();

      return false;

     }

}

?>