<?php

session_start();
include_once("../../include/database.php");
$obj = new database();
$training_id = $_REQUEST['trainingid'];
$rw = $obj->training_data_id_with_only($training_id);
$slides = explode("::", $rw['slides']);


$result = array();

$resData = array();
$host = $_SERVER['HTTP_HOST'];
class T1 {
    var $name = "";
}
class T2{
    var $question;
    var $answer1;
    var $answer2;
    var $answer3;
    var $answer4;
    var $correct;
}

for($i = 0; $i < count($slides); $i++){
    $d = new T1();
    $d->name = "http://" . $_SERVER['HTTP_HOST']."/phaseii/product/training/".$slides[$i];
    $resData[] = $d;
}
$result['status'] = 1;
$result['slides'] = $resData;
$res = array();
for($i = 1; $i < 6; $i++){
    $question_id = $rw['question'.$i];
    $rq = $obj->question_data_id($question_id);
    
    $d = new T2();
    $d->question = $rq['question'];
    $d->answer1 = $rq['answer1'];
    $d->answer2 = $rq['answer2'];
    $d->answer3 = $rq['answer3'];
    $d->answer4 = $rq['answer4'];
    $d->correct = $rq['correct'];
    $res[] = $d;
}
$result['questions'] = $res;
echo json_encode($result);
?>

