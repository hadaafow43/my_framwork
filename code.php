<?php

include 'db.php';

$obj = new Database();

 if(isset($_POST['save']))
 {
    $name = $obj->escapeString($_POST['name']);
    $phone =$obj->escapeString($_POST['phone']);

    $obj->insert('studant',array('name'=>$name,'phone'=>$phone));
    $response = $obj->getResult();

    if(!empty($response))
    {
        echo json_encode(array('success'=>$response));
    }
 }



// $obj->select('studant','id,name',null,'name="nuur"','name',null);
// echo " sql result is :";
// print_r($obj->getResult());
?>