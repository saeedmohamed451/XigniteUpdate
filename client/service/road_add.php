<?php
session_start();
include_once("../../include/database.php");
$obj= new database();


$agent_id = $_REQUEST['userid'];
$path = $_REQUEST['path'];
$uploaded_time = date('Y-m-d H:i:s');
 $row = $obj->add_road($agent_id, $uploaded_time, $path);
    if ($row) {
        $result = array();
        $result['status'] = 1;
        $result['message'] = "Road is Saved.";
        echo json_encode($result);
    } else {
        $result = array();
        $result['status'] = 0;
        $result['message'] = "Road is not Saved.";
        echo json_encode($result);
    }
?>