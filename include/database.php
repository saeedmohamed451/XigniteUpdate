<?php

//include_once("config.php");
include_once("class.smtp.php");
include_once("class.phpmailer.php");
class T {

    var $name = "";
    var $content = "";
    var $time = "";

}

;

class database {

    private $link;

/*    function __construct() {
        $this->link = mysql_connect("localhost", "root", "");
        mysql_select_db("demo_db", $this->link) or die(mysql_error());
    }*/
function __construct() {
        $this->link = mysql_connect("localhost", "root", "");
        mysql_select_db("finance", $this->link) or die(mysql_error());
    }

    
    function __distruct() {
        mysql_close($this->link);
    }

    function forgot_adminpass($email) {
        $sql = "select * from admin where email='$email'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    

    function employee_data() {
        $sql = "select * from admin";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function status_emp($status, $id) {
        $sql = "update admin set status='$status' where aid='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function emp_data_id($id) {
        $sql = "select * from admin where aid='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function job_data() {
        $sql = "select * from job";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function job_data_id($id) {
        $sql = "select * from job where id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function del_emp($id) {
        $sql = sprintf("delete FROM admin where aid=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function add_employe($email, $user_name, $password, $job) {
        $date1 = date('Y-m-d');
        $sql = sprintf("insert into  admin(username,email,password,reg_date,job_status)values('$user_name','$email','$password','$date1','$job')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }
    function add_userrole_from_distributor($stock_assignment, $stock_inventory, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $road_delete, $payment, $raisepo) {
        $sql = sprintf("insert into userrole(stock_assignment,stock_inventory, mail_send, report_activation, report_transaction, report_ordertracking, report_e_transaction, report_sales_manget_kpi, report_geo_tagging, road_delete, payment, raisepo)"
                . "values('$stock_assignment', '$stock_inventory', '$mail_send', '$report_activation', '$report_transaction', '$report_ordertracking', '$report_e_transaction', '$report_sales_manget_kpi', '$report_geo_tagging', '$road_delete', '$payment', '$raisepo')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }
    function update_userrole_from_distributor($role_id, $stock_assignment, $stock_inventory, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $road_delete, $payment, $raisepo) {
        $sql = sprintf("update userrole set stock_assignment = '$stock_assignment', report_sales_manget_kpi = '$report_sales_manget_kpi', payment = '$payment', "
                . "stock_inventory = '$stock_inventory', mail_send = '$mail_send', report_geo_tagging = '$report_geo_tagging', raisepo = '$raisepo', "
                . "report_activation = '$report_activation', report_transaction = '$report_transaction', report_ordertracking = '$report_ordertracking', "
                . "report_e_transaction = '$report_e_transaction', road_delete = '$road_delete' where role_id='$role_id'");

        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }
    function add_userrole_from_sub_distributor($stock_assignment, $stock_inventory, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $payment, $raisepo) {
        $sql = sprintf("insert into userrole(stock_assignment,stock_inventory, mail_send, report_activation, report_transaction, report_ordertracking, report_e_transaction, report_sales_manget_kpi, report_geo_tagging, payment, raisepo)"
                . "values('$stock_assignment', '$stock_inventory', '$mail_send', '$report_activation', '$report_transaction', '$report_ordertracking', '$report_e_transaction', '$report_sales_manget_kpi', '$report_geo_tagging',  '$payment', '$raisepo')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }
    function update_userrole_from_sub_distributor($role_id, $stock_assignment, $stock_inventory, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $payment, $raisepo) {
        $sql = sprintf("update userrole set stock_assignment = '$stock_assignment', report_sales_manget_kpi = '$report_sales_manget_kpi', payment = '$payment', "
                . "stock_inventory = '$stock_inventory', mail_send = '$mail_send', report_geo_tagging = '$report_geo_tagging', raisepo = '$raisepo', "
                . "report_activation = '$report_activation', report_transaction = '$report_transaction', report_ordertracking = '$report_ordertracking', "
                . "report_e_transaction = '$report_e_transaction' where role_id='$role_id'");

        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }
    function add_userrole_from_dealer($stock_assignment, $stock_inventory, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $payment, $raisepo) {
        $sql = sprintf("insert into userrole(stock_assignment,stock_inventory, mail_send, report_activation, report_transaction, report_ordertracking, report_e_transaction, report_sales_manget_kpi, report_geo_tagging, payment, raisepo)"
                . "values('$stock_assignment', '$stock_inventory', '$mail_send', '$report_activation', '$report_transaction', '$report_ordertracking', '$report_e_transaction', '$report_sales_manget_kpi', '$report_geo_tagging',  '$payment', '$raisepo')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }
    function update_userrole_from_dealer($role_id, $stock_assignment, $stock_inventory, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $payment, $raisepo) {
        $sql = sprintf("update userrole set stock_assignment = '$stock_assignment', report_sales_manget_kpi = '$report_sales_manget_kpi', payment = '$payment', "
                . "stock_inventory = '$stock_inventory', mail_send = '$mail_send', report_geo_tagging = '$report_geo_tagging', raisepo = '$raisepo', "
                . "report_activation = '$report_activation', report_transaction = '$report_transaction', report_ordertracking = '$report_ordertracking', "
                . "report_e_transaction = '$report_e_transaction' where role_id='$role_id'");

        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }
    function add_userrole_from_agent($mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $payment, $raisepo,
        $pin_sales, $pinless_sales, $physical_sales, $bill_payment, $prepaid_registration, $chat_with_telco, $get_training_certificate, $road_upload) {
        $sql = sprintf("insert into userrole(mail_send, report_activation, report_transaction, report_ordertracking, report_e_transaction, report_sales_manget_kpi, report_geo_tagging, payment, raisepo, "
                . "pin_sales, pinless_sales, physical_sales, bill_payment, prepaid_registration, chat_with_telco, get_training_certificate, road_upload)"
                . "values('$mail_send', '$report_activation', '$report_transaction', '$report_ordertracking', '$report_e_transaction','$report_sales_manget_kpi', '$report_geo_tagging', '$payment', '$raisepo', "
                . "'$pin_sales', '$pinless_sales', '$physical_sales', '$bill_payment', '$prepaid_registration', '$chat_with_telco', '$get_training_certificate', '$road_upload')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function update_userrole_from_agent($role_id, $mail_send, $report_activation, $report_transaction, $report_ordertracking, $report_e_transaction, $report_sales_manget_kpi, $report_geo_tagging, $payment, $raisepo,
        $pin_sales, $pinless_sales, $physical_sales, $bill_payment, $prepaid_registration, $chat_with_telco, $get_training_certificate, $road_upload) {
        $sql = sprintf("update userrole set mail_send = '$mail_send',report_activation = '$report_activation',report_transaction = '$report_transaction',report_ordertracking = '$report_ordertracking',report_e_transaction = '$report_e_transaction',report_sales_manget_kpi = '$report_sales_manget_kpi',report_geo_tagging = '$report_geo_tagging',"
                . "payment = '$payment',raisepo = '$raisepo',pin_sales = '$pin_sales',pinless_sales = '$pinless_sales',physical_sales = '$physical_sales',bill_payment = '$bill_payment',prepaid_registration = '$prepaid_registration',chat_with_telco = '$chat_with_telco',"
                . "get_training_certificate = '$get_training_certificate',road_upload = '$road_upload' where role_id = '$role_id'");
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function check_distributor($email) {
        $sql = sprintf("select email from user_distributor where email = '$email'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function add_distributor($name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues, $role_id) {
        $sql = sprintf("insert into user_distributor(name,address1,address2,state,region,pin,phonenumber,email,password,latitude,longitude,wallet_account,ipay88_accountid,ipay88_password,kpi_activations,kpi_revenues, role_id)"
                . "values('$name','$address1','$address2','$state','$region','$pin','$phonenumber','$email','$password','$latitude','$longitude','$wallet_account','$ipay88_accountid','$ipay88_password','$kpi_activations','$kpi_revenues', '$role_id')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $dist_id = sprintf("DIST%04d", $id);
            $sql = sprintf("update user_distributor set dist_id = '$dist_id' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function update_distributor($dist_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues) {
        $sql = sprintf("update user_distributor set name = '$name', address1 = '$address1', address2 = '$address2',state = '$state',region = '$region',pin = '$pin',"
                . "phonenumber = '$phonenumber',email = '$email',password = '$password',latitude = '$latitude',longitude = '$longitude',wallet_account = '$wallet_account',"
                . "ipay88_accountid = '$ipay88_accountid',ipay88_password = '$ipay88_password',kpi_activations = '$kpi_activations',kpi_revenues='$kpi_revenues' where dist_id = '$dist_id'");
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function distributor_data() {
        $sql = "select * from user_distributor";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function distributor_data_id($dist_id) {
        $sql = "select * from user_distributor where dist_id='$dist_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function role_data_id($role_id) {
        $sql = "select * from userrole where role_id='$role_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function del_distributor($dist_id, $role_id) {
        $sql = "delete FROM userrole where role_id = '$role_id'";
        mysql_query($sql, $this->link);

        $sql = sprintf("delete FROM user_distributor where dist_id='$dist_id'");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_employe($email, $user_name, $password, $job, $id) {
        $sql = sprintf("update admin set email='$email',username='$user_name',password='$password',job_status='$job' where aid='$id'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function acheck_pass($username, $pass) {
        $sql = sprintf("select * from telco where id ='%s' and password='%s'", $username, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function achange_pss($username, $newpass) {
        $sql = sprintf("update telco set password='$newpass' where id='$username'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_country() {
        $sql = sprintf("select * from country");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function add_country($country) {
        $sql = sprintf("insert into  country(country)values('$country')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function del_country($id) {
        $sql = sprintf("delete FROM country where country_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function add_city($city, $state) {
        $sql = sprintf("insert into  city(city,state_id)values('$city','$state')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function del_city($id) {
        $sql = sprintf("delete FROM city where city_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_state() {
        $sql = sprintf("select * from state");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_city() {
        $sql = sprintf("select * from city");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_statesbycid($id) {
        $sql = "select * from state where country_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_citybysid($id) {
        $sql = "select * from city where state_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_statebyid($id) {
        $sql = "select * from state where state_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_citybyid($id) {
        $sql = "select * from city where city_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_category() {
        $sql = sprintf("select * from category");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_categoryposi() {
        $sql = sprintf("select * from category order by position+0 ASC");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_catbyid($id) {
        $sql = "select * from category where category_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_category($id, $category, $seotitle, $seodesc, $seokey, $img, $discount, $position) {
        $sql = "update category set category='$category', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey',img='$img', discount='$discount', position='$position' where category_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_subcategory() {
        $sql = sprintf("select * from subcategory");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_subtopic() {
        $sql = sprintf("select * from subtopic");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_subcatbyid($id) {
        $sql = "select * from subcategory where subcategory_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_subtopic($subtopic, $id, $seotitle, $seodesc, $seokey) {
        $sql = "update subtopic set subtopic='$subtopic', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey' where subtopic_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_subcategory($subcategory, $id, $seotitle, $seodesc, $seokey) {
        $sql = "update subcategory set subcategory='$subcategory', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey' where subcategory_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function add_category($category, $seotitle, $seodesc, $seokey, $img, $discount, $position) {
        $sql = sprintf("insert into  category(category,seo_tit,seo_desc,seo_key,img,discount,position) values ('$category','$seotitle','$seodesc','$seokey','$img','$discount','$position')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function del_category($id) {
        $sql = sprintf("delete FROM category where category_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function add_subcategory($category, $subcategory, $seotitle, $seodesc, $seokey) {
        $sql = sprintf("insert into  subcategory(category_id,subcategory,seo_tit,seo_desc,seo_key)values('$category','$subcategory','$seotitle','$seodesc','$seokey')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function fetch_subtopicbycid($id) {
        $sql = "select * from subtopic where subcategory_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_subtopicbyid($id) {
        $sql = "select * from subtopic where subtopic_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_subcatbycid($id) {
        $sql = "select * from subcategory where category_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_subcatbycidposi($id) {
        $sql = "select * from subcategory where category_id='$id' order by position ASC";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function add_subtopic($category, $subcategory, $subtopic, $seotitle, $seodesc, $seokey) {
        $sql = sprintf("insert into  subtopic(cat_id,subtopic,subcategory_id,seo_tit,seo_desc,seo_key)values('$category','$subtopic','$subcategory','$seotitle','$seodesc','$seokey')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function del_subtopic($id) {
        $sql = sprintf("delete FROM subtopic where subtopic_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function del_subcategory($id) {
        $sql = sprintf("delete FROM subcategory where subcategory_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_site_detail($id) {
        $sql = sprintf("select * from site_detail where id='$id'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_detail($sname, $stitle, $semail, $sphone, $aemail, $logo, $sfax, $address) {
        $sql = sprintf("update site_detail set sname='$sname', stitle='$stitle', semail='$semail', sphone='$sphone', aemail='$aemail', logo='$logo', fax='$sfax', address='$address' where id='1'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_ref($referee, $referral) {
        $sql = sprintf("update site_detail set referee='$referee', referral='$referral' where id='1'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function add_photo($advpos, $tit, $img, $url, $button) {
        $sql = sprintf("insert into flash (center_id,tit,image,url,status,button) VALUES ('$advpos','$tit','$img','$url',1,'$button')");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function fetch_photo() {
        $sql = sprintf("select * from flash");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_photobytype($id) {
        $sql = sprintf("select * from flash where center_id='$id' and status=1");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function deleteflash($aid) {
        $sql = sprintf("delete from flash where fid='$aid'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_flashbycid($cid) {
        $sql = sprintf("select * from flash where center_id='$cid'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_flashbyid($cid) {
        $sql = sprintf("select * from flash where fid='$cid'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_data() {
        $sql = sprintf("select * from data");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_data1() {
        $sql = sprintf("select * from data where status=1");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_databyid($id) {
        $sql = sprintf("select * from data where did='$id'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_contant($id, $title, $contant, $seotitle, $seodesc, $seokey) {
        $sql = ("update data set title='$title', contant='$contant', seo_tit='$seotitle', seo_desc='$seodesc', seo_key='$seokey' where did='$id'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_user() {
        $sql = sprintf("select * from reg_user");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_brand() {
        $sql = "select * from brand";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_brand1() {
        $sql = "select * from brand limit 20";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function add_brand($brandname, $desc, $discount) {
        $sql = sprintf("insert into  brand(brand_name,bdesc,discount)values('$brandname','$desc','$discount')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function add_contant($title, $contant, $seotitle, $seodesc, $seokey) {
        $sql = "insert into data (title,contant,seo_tit,seo_desc,seo_key)values('$title','$contant','$seotitle','$seodesc','$seokey')";
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function fetch_brandbyid($id) {
        $sql = "select * from brand where brand_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_brand($brandname, $id, $desc, $discount) {
        $sql = "update brand set brand_name='$brandname', bdesc='$desc',discount='$discount' where brand_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function del_brand($id) {
        $sql = sprintf("delete FROM brand where brand_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function del_content($id) {
        $sql = sprintf("delete FROM data where did=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function status_data($status, $id) {
        $sql = "update data set status='$status' where did='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_product() {
        $sql = "select * from product";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_product1() {
        $sql = "select * from product where status=1";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function add_product($name, $code, $desc, $seotit, $seodesc, $seokey, $price, $d_price, $wprice, $scharge, $category, $subcategory, $subtopic, $img1, $brand, $subdesc, $status, $discount) {
        $date1 = date('Y-m-d');
        $sql = ("insert into  product(name,code,pro_desc,seotitle,seodesc,seokey,price,d_price,w_price,scharge,category,subcategory,subtopic,img,date,status,brand_id,subdesc,discount)values('$name','$code','$desc','$seotit','$seodesc','$seokey','$price','$d_price','$wprice','$scharge','$category','$subcategory','$subtopic','$img1','$date1','$status','$brand','$subdesc','$discount')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function hotstatus_pro($status, $id) {
        $sql = "update product set hotstatus='$status' where product_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function todaystatus($status, $id) {
        $sql = "update product set todaystatus='$status' where product_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function status_flash($status, $id) {
        $sql = "update flash set status='$status' where fid='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function status_pro($status, $id) {
        $sql = "update product set status='$status' where product_id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function del_product($id) {
        $sql = sprintf("delete FROM product where product_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_productbyid($id) {
        $sql = "select * from product where product_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_productstep($pid, $name, $code, $desc, $seotit, $seodesc, $seokey, $price, $dprice, $wprice, $scharge, $category, $subcategory, $subtopic, $img1, $discount) {
        $sql = ("update product set name='$name', code='$code', pro_desc='$desc', seotitle='$seotit', seodesc='$seodesc', seokey='$seokey', price='$price', d_price='$dprice',scharge='$scharge',category='$category',subcategory='$subcategory',subtopic='$subtopic',img='$img1',w_price='$wprice',discount=$discount where product_id='$pid'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_noproorder($id) {
        $sql = sprintf("SELECT count(*) as no FROM product_order where orderid='$id'");
        $rs_count = mysql_query($sql, $this->link);
        $data = mysql_fetch_assoc($rs_count);
        if ($data)
            return $data['no'];
        return false;
    }

    function fetch_finalorder($id) {
        $sql = "select * from finalorder where deliverstatus='$id' and ( paystatus=1 or pmethod=0 ) order by forderid DESC";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function status_order($status, $id) {


        $sql = "update finalorder set deliverstatus='$status' where forderid='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_finalorderreport($date) {
        $sql = "select sum(total) as v from finalorder where order_date like('%$date%') and  paystatus=1 ";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1) {
            $row = mysql_fetch_assoc($rs);
            if ($row['v'] != 0) {
                return $row['v'];
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function email_change($username, $email) {
        $sql = sprintf("update telco set email='$email' where id='$username'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function change_pass($username, $newpass) {
        $sql = sprintf("update reg_user set password='$newpass' where user_id='$username'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function user_sub($title, $fname, $lname, $email, $password, $phone, $address, $city, $state, $country, $zip, $daddress, $dcity, $dstate, $dcountry, $dzip, $referrel, $code) {
        $date1 = date('Y-m-d');
        $sql = "insert into  reg_user(title,fname,lname,email,password,phone,address,city,state,country,zip,d_address,d_city,d_state,d_country,d_zip,reg_date,status,referby,referral_code)values('$title','$fname','$lname','$email','$password','$phone','$address','$city','$state','$country','$zip','$daddress','$dcity','$dstate','$dcountry','$dzip','$date1',0,'$referrel','$code')";

        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function check_login($username, $pass) {
        $sql = sprintf("select * from reg_user where email ='$username' and password='$pass' and status=1");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function forgot_pass($email) {
        $sql = "select * from reg_user where email='$email'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function checkcode($code) {
        $sql = "select * from reg_user where referral_code='$code'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function check_pass($username, $pass) {
        $sql = sprintf("select * from reg_user where user_id ='%s' and password='%s'", $username, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_hotproduct($hsts, $limit, $cat) {
        $date = date("Y-m-d H:i:s");
        $sql = sprintf("select * from product where hotstatus='$hsts'and category='$cat'and status=1 order by product_id DESC limit $limit");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_reletedproduct($cat, $limit) {
        $date = date("Y-m-d H:i:s");
        $sql = sprintf("select * from product where category='$cat'and status=1 order by product_id DESC limit $limit");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_todaydeal($hsts, $limit, $cat) {
        $date = date("Y-m-d H:i:s");
        //$sql = sprintf("select * from product where todaystatus='$hsts' and category='$cat' and status=1 order by product_id DESC limit $limit");
        $sql = sprintf("select *, ((price - d_price)/price * 100) AS 'discountprice' from product where d_price < price and category='$cat' and status=1 HAVING discountprice != 100 and discountprice != 0 order by discountprice DESC limit $limit");
        //$sql = sprintf("select product_id, name, code, pro_desc, subdesc, seotitle, seodesc, seokey, price, discount, d_price, w_price, scharge, category, subcategory, subtopic, brand_id, img, date, status, hotstatus, todaystatus, stock_status, search_keyword, ((price - d_price)/price * 100) AS 'discountprice' from product where category='$cat' and status=1 order by discountprice ASC limit $limit");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_latestproduct($cat) {
        $sql = sprintf("select * from product where category='$cat'and status=1  order by product_id DESC limit 8");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_userbyid($id) {
        $sql = sprintf("select * from reg_user where user_id ='%s'", $id);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_orderbyid($id) {
        $sql = "select * from finalorder where forderid='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_proorderbyid($id) {
        $sql = sprintf("select * from product_order where orderid ='$id'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function add_coupon($ctitle, $ccode, $dtype, $discount, $mamount, $sdate, $edate) {
        $date1 = date('Y-m-d');
        $sql = ("insert into  coupon(coupon_name,code,discount,dtype,amount_total,date_start,date_end,create_date,status)values('$ctitle','$ccode','$discount','$dtype','$mamount','$sdate','$edate','$date1',1)");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function fetch_couponcode($code) {
        $sql = sprintf("select * from  coupon where code ='$code'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_couponbyid($id) {
        $sql = sprintf("select * from  coupon where id ='$id'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_coupon() {
        $sql = sprintf("select * from  coupon");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function status_coupon($status, $id) {
        $sql = "update coupon set status='$status' where id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function del_coupon($id) {
        $sql = sprintf("delete FROM coupon where id=$id");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_coupon($id, $ctitle, $ccode, $dtype, $discount, $mamount, $sdate, $edate) {
        $sql = "update coupon set coupon_name='$ctitle',code='$ccode',discount='$discount',dtype='$dtype',amount_total='$mamount',date_start='$sdate',date_end='$edate' where id='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_catbyname($name) {
        $sql = "select * from category where category='$name'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_subtopicbyname($name, $id) {
        $sql = "select * from subtopic where subtopic='$name' and subcategory_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_subcatbyname($name, $id) {
        $sql = "select * from subcategory where subcategory='$name' and category_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_brandbyname($name) {
        $sql = "select * from brand where brand_name='$name'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_status($email) {
        $sql = "update reg_user set status=1 where email='$email'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_otp($email, $otp) {
        $sql = "update reg_user set otp='$otp' where email='$email'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_addtocartbyuser($uid) {
        $sql = "select * from  product_order where user_id='$uid'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function update_addtocartuser($uid, $userid) {
        $sql = sprintf("update product_order set user_id='$userid' where user_id='$uid'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_productsearch($name, $cat) {
        if ($cat == 0) {
            $cat1 = '%';
        } else {
            $cat1 = $cat;
        }
        $sql = "select * from product where name like('%$name%') or search_keyword like('%$name%') and category like('$cat1') and status=1 ";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0) {
            return $rs;
        } else {
            return false;
        }
    }

    function fetch_temporder($sid, $sts) {
        $sql = "select * from product_order where user_id ='$sid' and status ='$sts'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function updatecartitems($id, $qty) {
        $sql = "update product_order set qty='$qty' where oid='$id'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function checkuserinventory($sid, $pid, $sts) {
        $sql = "select * from  product_order where product_id='$pid' and user_id='$sid' and status='$sts'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function addtocart($sid, $pid, $price, $d_price, $qty) {
        $date1 = date('Y-m-d');
        $sql = sprintf("insert into product_order(product_id,user_id,price,discountprice,qty,status,odate) values ('$pid','$sid','$price','$d_price','$qty',0,'$date1')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function updatecart($oid, $qty) {
        $sql = "update product_order set qty='$qty' where oid='$oid'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function deletecartitem($id) {
        $sql = sprintf("delete FROM product_order where oid=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function addfinorder($uid, $email, $total, $dis, $scharge, $wprice, $code, $bname, $bphone, $baddress, $bcountry, $bstate, $bcity, $bzip, $pmethod, $dmethod, $slot) {
        $date1 = date('Y-m-d');
        $time1 = date('h:i:s');
        $sql = sprintf("insert into  finalorder(user_id,total,scharge,wtotal,cdiscount,ccode,order_date,order_time,paystatus,b_name,b_phone,b_address,b_country,b_state,b_city,b_zip,email,pmethod,dmethod,oslote)values('$uid','$total','$scharge','$wprice','$dis','$code','$date1','$time1',0,'$bname','$bphone','$baddress','$bcountry','$bstate','$bcity','$bzip','$email','$pmethod','$dmethod','$slot')");

        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function update_ordercart($oid, $foid) {
        $sql = "update product_order set status=1, orderid='$foid' where oid='$oid'";
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function subscriber_sub($email) {
        $date = date("Y-m-d");
        $sql = sprintf("insert into  subscriber(email,sdate)values('$email','$date')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function fetch_semail($email) {
        $sql = sprintf("select * from subscriber where email='%s'", $email);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function contact_sub($name, $email, $subject, $message, $phone) {
        $sql = sprintf("insert into  contact(name,email,subject,msg,phone)values('$name','$email','$subject','$message','$phone')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function fetch_countrybyid($id) {
        $sql = "select * from country where country_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function fetch_contact() {
        $sql = "select * from contact";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_subscriber() {
        $sql = sprintf("select * from subscriber");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_finalordercount($date) {
        $sql = "SELECT count(*) as no FROM finalorder where order_date like('%$date%')";
        $rs_count = mysql_query($sql, $this->link);
        $data = mysql_fetch_assoc($rs_count);
        if ($data)
            return $data['no'];
        return false;
    }

    function fetch_order($id) {
        $sql = "select * from finalorder where user_id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_ordergross() {
        $sql = "select * from finalorder";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_ordergrossbyslote($slote) {
        $sql = "select * from finalorder where oslote like('%$slote')";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_productbycategories($catid, $subcatid, $topicid, $name) {
        $date = date("Y-m-d H:i:s");
        $limil = 20;
        if ($catid == 0) {
            $cat1 = '%';
        } else {
            $cat1 = $catid;
        }
        if ($subcatid == 0) {
            $subcatid1 = '%';
        } else {
            $subcatid1 = $subcatid;
        }
        if ($topicid == 0) {
            $topicid1 = '%';
        } else {
            $topicid1 = $topicid;
        }
        if ($name != '') {
            $sql = "select * from product where name like('%$name%') or search_keyword like('%$name%') and category like('$cat1') and subcategory like('$subcatid1') and subtopic like('$topicid1') and status=1 limit $limil ";
        } else {
            $sql = "select * from product where name like('%$name%') and category like('$cat1') and subcategory like('$subcatid1') and subtopic like('$topicid1') and status=1 limit $limil ";
        }
        //$sql = "select * from product where name like('%$name%') and category like('$cat1') and subcategory like('$subcatid1') and subtopic like('$topicid1') and status=1 limit $limil ";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function update_profile($userid, $fname, $lname, $phone, $address, $country, $state, $city, $zip, $daddress, $dcountry, $dstate, $dcity, $dzip) {
        $sql = "update reg_user set fname='$fname', lname='$lname', phone='$phone' , address='$address'  ,country='$country',state='$state',city='$city' , zip='$zip', d_address='$daddress'  ,d_country='$dcountry',d_state='$dstate',d_city='$dcity' , d_zip='$zip'  where user_id='$userid'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_photo($id, $center, $tit, $img, $url, $button) {
        $sql = ("update flash set tit='$tit', center_id='$center', url='$url', image='$img', button='$button' where fid='$id'");
        $rs = mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function clearcartitem($id) {
        $sql = sprintf("delete FROM product_order where user_id=%d", $id);
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_accountbyuid($id) {
        $sql = "select * from account where uid='$id' order by account_id DESC";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function fetch_refby($id) {
        $sql = sprintf("select * from reg_user where referral_code='$id'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function add_amount($user_id, $referee, $detail, $oid, $ttype) {
        $date1 = date('Y-m-d h:i:s');
        $sql = sprintf("insert into  account(uid,amount,detail,oid,ttype,sdate,status)values('$user_id','$referee','$detail','$oid',$ttype,'$date1',1)");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }

    function check_pcart($uid, $pid) {
        $sql = "select * from  product_order where user_id='$uid' and product_id='$pid' and status=0";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function update_response($oid, $val) {
        $sql = "update finalorder set paystatus='$val' where forderid='$oid'";
        mysql_query($sql, $this->link)or die(mysql_error());
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function fetch_productbycategories1($catid, $subcatid, $topicid, $name) {
        $date = date("Y-m-d H:i:s");

        if ($catid == 0) {
            $cat1 = '%';
        } else {
            $cat1 = $catid;
        }
        if ($subcatid == 0) {
            $subcatid1 = '%';
        } else {
            $subcatid1 = $subcatid;
        }
        if ($topicid == 0) {
            $topicid1 = '%';
        } else {
            $topicid1 = $topicid;
        }
        $sql = "select * from product where name like('%$name%') and category like('$cat1') and subcategory like('$subcatid1') and subtopic like('$topicid1') and status=1 group by brand_id limit 20";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) != 0)
            return $rs;
        return false;
    }

    function distributor_ids() {
        $sql = "select dist_id from user_distributor";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function check_sub_distributor($email) {
        $sql = sprintf("select email from user_sub_distributor where email = '$email'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function add_sub_distributor($dist_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues, $role_id) {
        $sql = sprintf("insert into user_sub_distributor(dist_id, name,address1,address2,state,region,pin,phonenumber,email,password,latitude,longitude,wallet_account,ipay88_accountid,ipay88_password,kpi_activations,kpi_revenues, role_id)"
                . "values('$dist_id', '$name','$address1','$address2','$state','$region','$pin','$phonenumber','$email','$password','$latitude','$longitude','$wallet_account','$ipay88_accountid','$ipay88_password','$kpi_activations','$kpi_revenues', '$role_id')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $sub_dist_id = sprintf("SUBDIST%04d", $id);
            $sql = sprintf("update user_sub_distributor set sub_dist_id = '$sub_dist_id' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function sub_distributor_data() {
        $sql = "select * from user_sub_distributor";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function sub_distributor_data_id($sub_dist_id) {
        $sql = "select * from user_sub_distributor where sub_dist_id='$sub_dist_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function del_sub_distributor($sub_dist_id, $role_id) {
        $sql = "delete FROM userrole where role_id = '$role_id'";
        mysql_query($sql, $this->link);

        $sql = sprintf("delete FROM user_sub_distributor where sub_dist_id='$sub_dist_id'");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_sub_distributor($sub_dist_id, $dist_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues) {
        $sql = sprintf("update user_sub_distributor set dist_id = '$dist_id', name = '$name', address1 = '$address1', address2 = '$address2',state = '$state',region = '$region',pin = '$pin',"
                . "phonenumber = '$phonenumber',email = '$email',password = '$password',latitude = '$latitude',longitude = '$longitude',wallet_account = '$wallet_account',"
                . "ipay88_accountid = '$ipay88_accountid',ipay88_password = '$ipay88_password',kpi_activations = '$kpi_activations',kpi_revenues='$kpi_revenues' where sub_dist_id = '$sub_dist_id'");
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function sub_distributor_ids($dist_id) {
        $sql = "select sub_dist_id from user_sub_distributor where dist_id = '$dist_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function check_dealer($email) {
        $sql = sprintf("select email from user_agent where email = '$email'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function add_dealer($dist_id, $sub_dist_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues, $role_id) {
        $sql = sprintf("insert into user_dealer(dist_id, sub_dist_id, name,address1,address2,state,region,pin,phonenumber,email,password,latitude,longitude,wallet_account,ipay88_accountid,ipay88_password,kpi_activations,kpi_revenues, role_id)"
                . "values('$dist_id','$sub_dist_id', '$name','$address1','$address2','$state','$region','$pin','$phonenumber','$email','$password','$latitude','$longitude','$wallet_account','$ipay88_accountid','$ipay88_password','$kpi_activations','$kpi_revenues', '$role_id')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $dealer_id = sprintf("DEALER%04d", $id);
            $sql = sprintf("update user_dealer set dealer_id = '$dealer_id' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function dealer_data() {
        $sql = "select * from user_dealer";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function dealer_data_id($dealer_id) {
        $sql = "select * from user_dealer where dealer_id='$dealer_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function del_dealer($dealer_id, $role_id) {
        $sql = "delete FROM userrole where role_id = '$role_id'";
        mysql_query($sql, $this->link);

        $sql = sprintf("delete FROM user_dealer where dealer_id='$dealer_id'");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_dealer($dealer_id, $sub_dist_id, $dist_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues) {
        $sql = sprintf("update user_dealer set sub_dist_id = '$sub_dist_id', dist_id = '$dist_id', name = '$name', address1 = '$address1', address2 = '$address2',state = '$state',region = '$region',pin = '$pin',"
                . "phonenumber = '$phonenumber',email = '$email',password = '$password',latitude = '$latitude',longitude = '$longitude',wallet_account = '$wallet_account',"
                . "ipay88_accountid = '$ipay88_accountid',ipay88_password = '$ipay88_password',kpi_activations = '$kpi_activations',kpi_revenues='$kpi_revenues' where dealer_id = '$dealer_id'");
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function dealer_ids($dist_id, $sub_dist_id) {
        $sql = "select dealer_id from user_dealer where dist_id = '$dist_id' and sub_dist_id = '$sub_dist_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function check_agent($email) {
        $sql = sprintf("select email from user_agent where email = '$email'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function add_agent($dist_id, $sub_dist_id, $dealer_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues, $role_id) {
        $sql = sprintf("insert into user_agent(dist_id, sub_dist_id, dealer_id, name,address1,address2,state,region,pin,phonenumber,email,password,latitude,longitude,wallet_account,ipay88_accountid,ipay88_password,kpi_activations,kpi_revenues, role_id)"
                . "values('$dist_id','$sub_dist_id', '$dealer_id', '$name','$address1','$address2','$state','$region','$pin','$phonenumber','$email','$password','$latitude','$longitude','$wallet_account','$ipay88_accountid','$ipay88_password','$kpi_activations','$kpi_revenues', '$role_id')");

        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $agent_id = sprintf("AGENT%04d", $id);
            $sql = sprintf("update user_agent set agent_id = '$agent_id' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function agent_data() {
        $sql = "select * from user_agent";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function agent_data_groupby_dist_id() {
        $sql = "select * from user_agent group by dist_id";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function agent_data_groupby_sub_dist_id() {
        $sql = "select * from user_agent group by sub_dist_id";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function agent_data_groupby_dealer_id() {
        $sql = "select * from user_agent group by dealer_id";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function agent_data_groupby_region() {
        $sql = "select * from user_agent group by region";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function agent_data_id($agent_id) {
        $sql = "select * from user_agent where agent_id='$agent_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function del_agent($agent_id, $role_id) {
        $sql = "delete FROM userrole where role_id = '$role_id'";
        mysql_query($sql, $this->link);

        $sql = sprintf("delete FROM user_agent where agent_id='$agent_id'");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function update_agent($agent_id, $dealer_id, $sub_dist_id, $dist_id, $name, $address1, $address2, $state, $region, $pin, $phonenumber, $email, $password, $latitude, $longitude, $wallet_account, $ipay88_accountid, $ipay88_password, $kpi_activations, $kpi_revenues) {
        $sql = sprintf("update user_agent set dealer_id = '$dealer_id', sub_dist_id = '$sub_dist_id', dist_id = '$dist_id', name = '$name', address1 = '$address1', address2 = '$address2',state = '$state',region = '$region',pin = '$pin',"
                . "phonenumber = '$phonenumber',email = '$email',password = '$password',latitude = '$latitude',longitude = '$longitude',wallet_account = '$wallet_account',"
                . "ipay88_accountid = '$ipay88_accountid',ipay88_password = '$ipay88_password',kpi_activations = '$kpi_activations',kpi_revenues='$kpi_revenues' where agent_id = '$agent_id'");
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function agent_ids($dist_id, $sub_dist_id, $dealer_id) {
        $sql = "select agent_id from user_agent where dist_id = '$dist_id' and sub_dist_id = '$sub_dist_id' and dealer_id = '$dealer_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function check_stock($name) {
        $sql = sprintf("select name from stock_definition where name = '$name'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_num_rows($rs) >= 1)
            return true;
        return false;
    }

    function add_stock($name, $description, $cost) {
        $sql = sprintf("insert into stock_definition(name, description, cost) values('$name', '$description', '$cost')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $code = sprintf("PRD%03d", $id);
            $sql = sprintf("update stock_definition set code = '$code' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function stock_codes() {
        $sql = "select code from stock_definition";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function add_stock_quantity($code, $quantity) {
        $sql = sprintf("insert into stock_addition(code, quantity) values('$code', '$quantity')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            return $id;
        }
        return false;
    }

    function get_remaining_quantity($code) {
        $sql = sprintf("select sum(quantity) as quantity from stock_addition where code = '$code'");
        $rs = mysql_query($sql, $this->link);
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return 0;
    }

    function stock_assignment($dist_id, $sub_dist_id, $dealer_id, $agent_id, $code, $quantity) {
        $sql = sprintf("insert into stock_assignment(dist_id, sub_dist_id, dealer_id, agent_id, code, quantity) values('$dist_id', '$sub_dist_id', '$dealer_id', '$agent_id', '$code', '$quantity')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            return $id;
        }
        return false;
    }

    function get_inventory() {
        $sql = sprintf("SELECT  B.name as name, B.code as code, B.description as description, sum(A.quantity) as quantity from stock_addition as A, stock_definition as B where B.code = A.code group by A.code");
        $rs = mysql_query($sql, $this->link);
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return 0;
    }

    function add_posm($name, $description, $type, $image) {
        $sql = sprintf("insert into posm_material(name, description, type, image) values('$name', '$description', '$type', '$image')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $code = sprintf("POSM%03d", $id);
            $sql = sprintf("update posm_material set code = '$code' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function get_posm_data() {
        $sql = "select * from posm_material";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function del_posm($code) {
        $sql = "delete FROM posm_material where code = '$code'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function add_road($agent_id, $uploaded_time, $image) {
        $sql = sprintf("insert into road_table(agent_id, uploaded_time, image) values('$agent_id', '$uploaded_time', '$image')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            return $id;
        }
        return false;
    }

    function get_road_data() {
        $sql = "select * from road_table";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function del_road($id) {
        $sql = "delete FROM road_table where id = '$id'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function road_data_id($id) {
        $sql = "select * from road_table where id = '$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function check_state($state) {
        $sql = sprintf("select state from state_table where state = '$state'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function add_state($state) {
        $sql = sprintf("insert into state_table(state) values('$state')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            return $id;
        }
        return false;
    }

    function get_state_data() {
        $sql = "select * from state_table";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function state_del($id) {
        $sql = "delete FROM state_table where id = '$id'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function state_data_id($id) {
        $sql = "select * from state_table where id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function get_state_data_id($id) {
        $sql = "select * from state_table where id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs)['state'];
        return '';
    }

    function state_update($id, $state) {
        $sql = "update state_table set state = '$state' where id = '$id'";
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function check_region($region) {
        $sql = sprintf("select region from region_table where region = '$region'");
        $rs = mysql_query($sql, $this->link);

        if (mysql_affected_rows() == 1)
            return true;
        return false;
    }

    function add_region($region) {
        $sql = sprintf("insert into region_table(region) values('$region')");
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            return $id;
        }
        return false;
    }

    function get_region_data() {
        $sql = "select * from region_table";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function region_del($id) {
        $sql = "delete FROM region_table where id = '$id'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }

    function region_data_id($id) {
        $sql = "select * from region_table where id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function get_region_data_id($id) {
        $sql = "select * from region_table where id='$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs)['region'];
        return '';
    }

    function region_update($id, $region) {
        $sql = "update region_table set region = '$region' where id = '$id'";
        $rs = mysql_query($sql, $this->link);
        if ($rs)
            return true;
        return false;
    }

    function get_email_address_from_dist($state, $region) {
        $sql = "select email from user_distributor ";
        if ($state == "0" && $region != "0") {
            $sql = $sql . "where region = '$region'";
        } else if ($state != "0" && $region == "0") {
            $sql = $sql . "where state = '$state'";
        } else if ($state != "0" && $region != "0") {
            $sql = $sql . "where state = '$state' and region = '$region'";
        }
        $res = array();
        $rs = mysql_query($sql, $this->link);
        while ($row = mysql_fetch_assoc($rs)) {
            $res[] = $row['email'];
        }
        return $res;
    }

    function get_email_address_from_sub_dist($state, $region) {
        $sql = "select email from user_sub_distributor ";
        if ($state == "0" && $region != "0") {
            $sql = $sql . "where region = '$region'";
        } else if ($state != "0" && $region == "0") {
            $sql = $sql . "where state = '$state'";
        } else if ($state != "0" && $region != "0") {
            $sql = $sql . "where state = '$state' and region = '$region'";
        }
        $res = array();
        $rs = mysql_query($sql, $this->link);
        while ($row = mysql_fetch_assoc($rs)) {
            $res[] = $row['email'];
        }
        return $res;
    }

    function get_email_address_from_dealer($state, $region) {
        $sql = "select email from user_dealer ";
        if ($state == "0" && $region != "0") {
            $sql = $sql . "where region = '$region'";
        } else if ($state != "0" && $region == "0") {
            $sql = $sql . "where state = '$state'";
        } else if ($state != "0" && $region != "0") {
            $sql = $sql . "where state = '$state' and region = '$region'";
        }
        $res = array();
        $rs = mysql_query($sql, $this->link);
        while ($row = mysql_fetch_assoc($rs)) {
            $res[] = $row['email'];
        }
        return $res;
    }

    function get_email_address_from_agent($state, $region) {
        $sql = "select email from user_agent ";
        if ($state == "0" && $region != "0") {
            $sql = $sql . "where region = '$region'";
        } else if ($state != "0" && $region == "0") {
            $sql = $sql . "where state = '$state'";
        } else if ($state != "0" && $region != "0") {
            $sql = $sql . "where state = '$state' and region = '$region'";
        }
        $res = array();
        $rs = mysql_query($sql, $this->link);
        while ($row = mysql_fetch_assoc($rs)) {
            $res[] = $row['email'];
        }
        return $res;
    }

    function get_email_address($type, $state, $region) {
        if ($type == "0")
            return array_merge($this->get_email_address_from_dist($state, $region), $this->get_email_address_from_sub_dist($state, $region), $this->get_email_address_from_dealer($state, $region), $this->get_email_address_from_agent($state, $region));
        if ($type == "1")
            return $this->get_email_address_from_dist($state, $region);
        if ($type == "2")
            return $this->get_email_address_from_sub_dist($state, $region);
        if ($type == "3")
            return $this->get_email_address_from_dealer($state, $region);
        if ($type == "4")
            return $this->get_email_address_from_agent($state, $region);
    }

    function get_admin($id) {
        $sql = sprintf("select * from telco where id = '$id'");
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function add_question($question, $correct, $answer1, $answer2, $answer3, $answer4) {
        $sql = "insert into training_question(question, correct, answer1, answer2, answer3, answer4) values('$question', '$correct', '$answer1', '$answer2', '$answer3', '$answer4')";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            return $id;
        }
        return false;
    }

    function add_training($name, $description, $detail, $slides, $question1, $question2, $question3, $question4, $question5) {
        $sql = "insert into training_table(name, description, detail, slides, question1, question2, question3, question4, question5) values('$name', "
                . "'$description', '$detail', '$slides', '$question1', '$question2', '$question3', '$question4', '$question5')";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) {
            $id = mysql_insert_id();
            $training_id = sprintf("TRAIN%04d", $id);
            $sql = sprintf("update training_table set training_id = '$training_id' where id = '$id'");
            $rs = mysql_query($sql, $this->link);
            return $id;
        }
        return false;
    }

    function get_training_data() {
        $sql = "select * from training_table";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }

    function del_training($training_id) {
        $sql = "delete FROM training_table where training_id = '$training_id'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }
    function training_data_id_with_only($training_id) {
        $sql = "select * from training_table where training_id = '$training_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1) {
            return mysql_fetch_assoc($rs);
        }
        return false;
    }
    function training_data_id($training_id) {
        $sql = "select * from training_table where training_id = '$training_id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1) {
            $res = array();
            $row = mysql_fetch_assoc($rs);
            $res['name'] = $row['name'];
            $res['description'] = $row['description'];
            $res['detail'] = $row['detail'];
            $res['slides'] = $row['slides'];

            for ($i = 1; $i < 6; $i++) {
                $row1 = $this->question_data_id($row["question$i"]);
                $res["question$i"] = $row1['question'];
                $res["question$i" . "_correct"] = $row1['correct'];
                $res["answer$i" . "_1"] = $row1['answer1'];
                $res["answer$i" . "_2"] = $row1['answer2'];
                $res["answer$i" . "_3"] = $row1['answer3'];
                $res["answer$i" . "_4"] = $row1['answer4'];
            }
            return $res;
        }
        return false;
    }

    function question_data_id($id) {
        $sql = "select * from training_question where id = '$id'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return mysql_fetch_assoc($rs);
        return false;
    }

    function getMsg($sender, $time) {
        $sql = "select sender, message, time from chattable where (sender = 'telco' or receiver = 'telco') and time > '$time' order by time asc";

        $res = mysql_query($sql, $this->link);
        $result = array();

        while (($row = mysql_fetch_object($res))) {
            $t = new T();
            $t->name = $row->sender;
            $t->content = $row->message;
            $t->time = $row->time;
            if ($row->time != null)
                $result[] = $t;
        }

        $resArray = array();
        $resArray['res'] = $result;
        return json_encode($result);
    }

    function addMsg($sender, $msg, $time, $region, $dist_id, $sub_dist_id, $dealer_id) {
        $sql = "insert into chattable(sender, receiver, message, time, region, dist_id, sub_dist_id, dealer_id) values('telco', 'all', '$msg', '$time', '$region', '$dist_id', '$sub_dist_id', '$dealer_id')";
        mysql_query($sql, $this->link);
    }
    function addMsg_from_agent($sender, $msg, $time) {
        $sql = "insert into chattable(sender, receiver, message, time) values('$sender', 'telco', '$msg', '$time')";
        mysql_query($sql, $this->link);
    }
    function getMsg_from_agent($sender, $time, $rs) {
        $dist_id = $rs['dist_id'];
        $sub_dist_id = $rs['sub_dist_id'];
        $dealer_id = $rs['dealer_id'];
        $region = $rs['region'];
        $sql = "select sender, message, time from chattable where (sender = '$sender' or (receiver = 'all' and (dist_id = '-1' or dist_id = '$dist_id') and "
                . "(sub_dist_id = '-1' or sub_dist_id = '$sub_dist_id') and (dealer_id = '-1' or dealer_id = '$dealer_id') and (region = '-1' or region = '$region')) ) and time > '$time' order by time asc";

        
        $res = mysql_query($sql, $this->link);
        $result = array();

        while (($row = mysql_fetch_object($res))) {
            $t = new T();
            $t->name = $row->sender;
            $t->content = $row->message;
            $t->time = $row->time;
            if ($row->time != null)
                $result[] = $t;
        }

        $resArray = array();
        $resArray['status'] = 1;
        $resArray['res'] = $result;
        return json_encode($result);
    }
    
    
    function distributor_login($email, $pass) {
        $sql = sprintf("select * from user_distributor where email ='%s' and password='%s'", $email, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }
    function sub_distributor_login($email, $pass) {
        $sql = sprintf("select * from user_sub_distributor where email ='%s' and password='%s'", $email, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }
    function dealer_login($email, $pass) {
        $sql = sprintf("select * from user_dealer where email ='%s' and password='%s'", $email, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }
    function agent_login($email, $pass) {
        $sql = sprintf("select * from user_agent where email ='%s' and password='%s'", $email, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }
    
    
    function Save_Sale_History($reload, $phoneno, $date, $type){
            $query = "insert into agent_sale_history(amount, phoneno, time, type) values('$reload', '$phoneno', '$date', '$type')";
            $rs = mysql_query($query, $this->link);
            if(mysql_affected_rows() > 0 ){
                return mysql_insert_id();
            }
            return false;
    }
    function getVoucher($number){
            $query = "select * from voucher_table where number='$number'";
            $res = mysql_query($query, $this->link);
            if( mysql_num_rows($res) > 0 )
                return true;
            return false;
        }
        
     function SaveVoucherHistory($reload, $phoneno, $voucher, $date){
            $query = "insert into voucher_history(amount, phoneno, time, voucher_number) values('$reload', '$phoneno', '$date', '$voucher')";
            mysql_query($query, $this->link);
            if(mysql_affected_rows() > 0 )
                return mysql_insert_id ();
            return false;
        }
        function getAllOperator(){
            $sql = "select * from operator_table";
            $rs = mysql_query($sql, $this->link);
            if(mysql_affected_rows() > 0 )
                return $rs;
            return false;
        }
        function isExistCustomer($msisdn){
            $sql = "select * from customer_table where msisdn = '$msisdn'";
            $res = mysql_query($sql, $this->link);
            if(mysql_num_rows($res) > 0 )
                return true;
            return false;
        }
        function AddCustomer($name,$msisdn,$simsn,$nric,$dob,$sex,$address,$signature,$passport){
            $sql = "insert into customer_table(name, msisdn,simsn,nric,dob,sex,address,signature,passport) values('$name','$msisdn','$simsn','$nric','$dob','$sex','$address','$signature','$passport')";
            mysql_query($sql, $this->link);
            if(mysql_affected_rows() > 0 )
                return mysql_insert_id ();
            return false;
        }
        
    function user_login($email, $pass) {
        $sql = sprintf("select * from tbl_user where email ='%s' and password='%s'", $email, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }      
    function user_register($email, $pass, $name, $balance, $street, $phone, $plz, $ort, $tel2, $email2, $fax) {
        $sql = "insert into tbl_user(email, password, name, street, phone, balance, plz, ort, tel2, email2, fax) values('$email', '$pass', '$name', '$street', '$phone', '$balance', '$plz', '$ort', '$tel2', '$email2', '$fax')";
        $rs = mysql_query($sql, $this->link);
        
        if (mysql_affected_rows() == 1)
            return mysql_insert_id();
        return false;
    }
    function check_email($email){
        $sql = "select * from tbl_user where email = '$email'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return true;
        return false;
    }
    function get_user_info($userid){
        $sql = "select * from tbl_user where id = '$userid'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return mysql_fetch_assoc($rs);
        return false;
    }
    function user_update($userid, $name, $street, $phone, $pass, $plz, $ort, $tel2, $email2, $fax){
        $sql = "update tbl_user set name = '$name', street = '$street', phone = '$phone', password = '$pass', "
                . "plz = '$plz', ort = '$ort', tel2 = '$tel2', email2 = '$email2', fax = '$fax' where id = '$userid'";
        
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return true;
        return false;
    }
    function product_release($buyid){
        $sql = "update tbl_buy set released = '1' where id = '$buyid';";
        mysql_query($sql, $this->link);
        return true;
    }
    function get_product_list($userid){
        $sql = "select * from tbl_buy where userid = '$userid'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function get_waitlist(){
        $sql = "select A.*,B.id as user_id, B.name as username, B.street as street, B.phone as phone, B.balance as balance, B.email as email from tbl_buy as A, tbl_user as B where A.userid = B.id and A.released = 0";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function get_product_info($productid){
        $sql = "select * from tbl_buy where id = '$productid'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_affected_rows() == 1) 
            return mysql_fetch_assoc($rs);
        return false;
    }
    function buy_product($userid, $symbol, $name, $change, $datetime, $price, $quantity, $balance, $limit, $place){
        $balance = $balance - ($price * $quantity);
        $sql = "update tbl_user set balance = '$balance' where id = '$userid'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_affected_rows() >= 1)
        {
            $sql = "insert into tbl_buy(userid, symbol, name, changes, dates, price, quantity, limit_value, place) values('$userid', '$symbol', '$name', '$change', '$datetime', '$price', '$quantity', '$limit', '$place')";
            $rs = mysql_query($sql, $this->link);
            if (mysql_affected_rows() == 1)
                return true;
            else
                return false;
        }else
            return false;
    }
    function sell_product($userid, $buy_id, $symbol, $name, $change, $datetime, $cur_quantity, $cur_price, $quantity, $price){
        $ru = $this->get_user_info($userid);
        if( $ru ){
            $balance = $ru['balance'];
            $balance = $balance + ($cur_price * $cur_quantity);
            $sql = "update tbl_user set balance = '$balance' where id = '$userid'";
            
            mysql_query($sql, $this->link);
            
            $quantity = $quantity - $cur_quantity;
            $sql = "update tbl_buy set quantity = '$quantity' where id = '$buy_id'";
            mysql_query($sql, $this->link);
            
            $sql = "insert into tbl_sell(userid, symbol, name, changes, dates, price, quantity) values('$userid', '$symbol', '$name', '$change', '$datetime', '$cur_price', '$cur_quantity')";
            mysql_query($sql, $this->link);
        }
    }
    function admin_login($username, $pass) {
        $sql = sprintf("select * from tbl_admin where email ='%s' and password='%s'", $username, $pass);
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) == 1)
            return mysql_fetch_assoc($rs);
        return false;
    }  
    function user_data() {
        $sql = "select * from tbl_user";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function del_user($userid) {
        $sql = "delete FROM tbl_user where id = '$userid'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1)
            return true;
        else
            return false;
    }
    function check_email_update($userid, $email){
        $sql = "select * from tbl_user where email = '$email'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() > 1) 
            return true;
        else if(mysql_affected_rows() == 1 ){
            $row = mysql_fetch_assoc($rs);
            if( $row['id'] == $userid )
                return false;
            else
                return true;
        }
        return false;
    }
    function user_updatefull($userid, $email, $pass, $name, $street, $phone, $balance, $plz, $ort, $tel2, $email2, $fax){
        $sql = "update tbl_user set email = '$email', name = '$name', street = '$street', phone = '$phone', balance = '$balance', "
                . "plz = '$plz', ort = '$ort', tel2 = '$tel2', email2 = '$email2', fax = '$fax' where id = '$userid'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return true;
        return false;
    }
    function product_update($id, $symbol, $name, $changes, $dates, $price, $quantity){
        $sql = "update tbl_buy set symbol = '$symbol', name = '$name', changes = '$changes', dates = '$dates', price = '$price', quantity = '$quantity' where id = '$id'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return true;
        return false;
    }
    function send_mail($userid, $sub, $content){
       
        $row = $this->get_user_info($userid);
        $from_addr = $row['email'];
        $from_pass = $row['password'];



        $subject = $sub;
        $msg = $content;
        $email = "sale@fidococapital.com";
        $from = $from_addr;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .="From:" . $from;
        $a = mail($email, $subject, $msg, $headers);
        return;
        //continue;
        //Local Send Email
        $to = "sale@fidococapital.com";
        $subject = $sub;
        $message = $content;
        //require_once('class.phpmailer.php');

        $mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch
        //$mail->SMTPDebug = 1;

        $mail->IsSMTP(); // telling the class to use SMTP

        $host = "smtp.live.com";
        $port = 25;
        $from = $from_addr;
        $pass = $from_pass;

        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Port = $port;
        $mail->SMTPSecure = "tls";
        $mail->Username = $from;
        $mail->Password = $pass;

        $mail->SetFrom($from, 'Master');
        $mail->AddAddress($to, 'Master');
        $mail->Subject = $sub; // ¸ÞÀÏ Á¦¸ñ
        $mail->Body = $message;
        //mail('caffeinated@example.com', 'My Subject', $message);

        if (!$mail->Send($to, $subject, $message)) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            // makeFailResponse();
            //echo "Error";
        } else {
            //mail sent
        }
        //Server Send Email
        /*      $to = $email_data[$i];
          $subject = $sub;
          $message = $content;
          //require_once('class.phpmailer.php');

          $mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch
          //$mail->SMTPDebug = 1;

          $mail->IsSMTP(); // telling the class to use SMTP

          $host = "smtp.live.com";
          $port = 25;
          $from = $from_addr;
          $pass = $from_pass;

          $mail->Host = $host;
          $mail->SMTPAuth = true;
          $mail->Port = $port;
          $mail->SMTPSecure = "tls";
          $mail->Username   = $from;
          $mail->Password   = $pass;

          $mail->SetFrom($from, 'Master');
          $mail->AddAddress($to, 'Master');
          $mail->Subject = $subject; // ¸ÞÀÏ Á¦¸ñ
          $mail->Body = $message;
          //mail('caffeinated@example.com', 'My Subject', $message);

          if(!mail($to,$subject,$message)) {
          //echo "Mailer Error: " . $mail->ErrorInfo;
          //makeFailResponse();
          } else {
          // makeSuccessResponse();
          } */
    }
	function get_desc(){
        $sql = "CREATE TABLE IF NOT EXISTS `tbl_desc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc1` varchar(200) NOT NULL,
  `desc2` varchar(200) NOT NULL,
  `desc3` varchar(200) NOT NULL,
  `desc4` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
        mysql_query($sql, $this->link);
        $sql = "select * from tbl_desc";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return mysql_fetch_assoc($rs);
        return false;
    }
    function update_desc($desc1, $desc2, $desc3, $desc4){
        $sql = "select * from tbl_desc";
        $rs = mysql_query($sql, $this->link);
        if(mysql_affected_rows() == 1 ){
            $rw = mysql_fetch_assoc($rs);
            $id = $rw['id'];
            $sql = "update tbl_desc set desc1 = '$desc1', desc2 = '$desc2', desc3 = '$desc3', desc4= '$desc4' where id = '$id'";
            mysql_query($sql, $this->link);
        }else{
            $sql = "insert into tbl_desc(desc1, desc2, desc3, desc4) values('$desc1', '$desc2', '$desc3', '$desc4')";
            mysql_query($sql, $this->link);
        }
    }
    function check_company_update($companyid, $symbol, $wkn){
        $sql = "select * from tbl_company where (symbol = '$symbol' or wkn = '$wkn') and id <> '$companyid'";
        mysql_query($sql, $this->link);
        if(mysql_affected_rows() > 0 )
            return true;
        return false;
    }
    function check_company($symbol, $wkn){
        $sql = "select * from tbl_company where symbol = '$symbol' or wkn = '$wkn'";
        mysql_query($sql, $this->link);
        if(mysql_affected_rows() > 0 )
            return true;
        return false;
    }
    function add_company($symbol, $wkn, $firma, $kurs, $platz, $frist){
        $sql = "insert into tbl_company(symbol, wkn, firma, kurs, platz, frist) values('$symbol', '$wkn', '$firma', '$kurs', '$platz', '$frist')";
        mysql_query($sql, $this->link);
        if(mysql_affected_rows() > 0 )
            return true;
        return false;
    }
    function company_list() {
        $sql = "select * from tbl_company";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function get_company_info($companyid){
        $sql = "select * from tbl_company where id = '$companyid'";
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return mysql_fetch_assoc($rs);
        return false;
    }
    function company_update($companyid, $symbol, $wkn, $firma, $kurs, $platz, $frist){
        $sql = "update tbl_company set symbol = '$symbol', wkn = '$wkn', firma= '$firma', kurs= '$kurs', "
                . "platz = '$platz', frist = '$frist' where id = '$companyid'";
        
        $rs = mysql_query($sql, $this->link);
        if (mysql_affected_rows() == 1) 
            return true;
        return false;
    }
    function search_company($key){
        $sql = "select * from tbl_company where symbol like '%$key%' or wkn like '%$key%'";
        $rs = mysql_query($sql, $this->link);
        if(mysql_affected_rows() > 0 )
            return $rs;
        return false;
    }
    function search_company_price($symbol, $wkn){
        $sql = "select * from tbl_company where symbol = '$symbol' or wkn = '$wkn'";
        $rs = mysql_query($sql, $this->link);
        if(mysql_affected_rows() > 0 )
            return mysql_fetch_assoc($rs);
        return false;
    }
    function buy_product_company($userid, $symbol, $name, $change, $datetime, $price, $quantity, $balance, $limit, $place){
        $balance = $balance - ($price * $quantity);
        $sql = "update tbl_user set balance = '$balance' where id = '$userid'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_affected_rows() >= 1)
        {
            $sql = "insert into tbl_buy_company(userid, symbol, name, changes, dates, price, quantity, limit_value, place) values('$userid', '$symbol', '$name', '$change', '$datetime', '$price', '$quantity', '$limit', '$place')";
            $rs = mysql_query($sql, $this->link);
            if (mysql_affected_rows() == 1)
                return true;
            else
                return false;
        }else
            return false;
    }
    function get_product_company_list($userid){
        $sql = "select * from tbl_buy_company where userid = '$userid'";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function product_back_money($userid, $buyid, $back_money){
        $ru = $this->get_user_info($userid);
        if( $ru ){
            $balance = $ru['balance'];
            $balance = $balance + $back_money;
            $sql = "update tbl_user set balance = '$balance' where id = '$userid'";
            mysql_query($sql, $this->link);
            
            $sql = "delete from tbl_buy where id = '$buyid'";
            mysql_query($sql, $this->link);
        }
    }
    function get_waitlist_company(){
        $sql = "select A.*,B.id as user_id, B.name as username, B.street as street, B.phone as phone, B.balance as balance, B.email as email from tbl_buy_company as A, tbl_user as B where A.userid = B.id and A.released = 0";
        $rs = mysql_query($sql, $this->link) or die(mysql_error());
        if (mysql_num_rows($rs) >= 1)
            return $rs;
        return false;
    }
    function product_release_company($buyid){
        $sql = "update tbl_buy_company set released = '1' where id = '$buyid';";
        mysql_query($sql, $this->link);
        return true;
    }
    function product_back_money_company($userid, $buyid, $back_money){
        $ru = $this->get_user_info($userid);
        if( $ru ){
            $balance = $ru['balance'];
            $balance = $balance + $back_money;
            $sql = "update tbl_user set balance = '$balance' where id = '$userid'";
            mysql_query($sql, $this->link);
            
            $sql = "delete from tbl_buy_company where id = '$buyid'";
            mysql_query($sql, $this->link);
        }
    }
    function sell_product_company($userid, $buy_id, $symbol, $name, $change, $datetime, $cur_quantity, $cur_price, $quantity, $price){
        $ru = $this->get_user_info($userid);
        if( $ru ){
            $balance = $ru['balance'];
            $balance = $balance + ($cur_price * $cur_quantity);
            $sql = "update tbl_user set balance = '$balance' where id = '$userid'";
            mysql_query($sql, $this->link);
            
            $quantity = $quantity - $cur_quantity;
            $sql = "update tbl_buy_company set quantity = '$quantity' where id = '$buy_id'";
            mysql_query($sql, $this->link);
            
            $sql = "insert into tbl_sell(userid, symbol, name, changes, dates, price, quantity) values('$userid', '$symbol', '$name', '$change', '$datetime', '$cur_price', '$cur_quantity')";
            mysql_query($sql, $this->link);
        }
    }
}

?>