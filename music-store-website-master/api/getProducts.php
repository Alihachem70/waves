<?php
include("db_info.php");

$array = json_decode(file_get_contents("php://input"), true);


$get_products = $mysqli->prepare("SELECT * from products");
$get_products->bind_param("ss",$id,$id);
$get_products-> execute();
$array =  $get_products-> get_result();

$friends_info=[];
if($array->num_rows>0)
{
  $friends_info['status']= true;
  $i=1;
  while($user = $array->fetch_assoc()){
    $friends_info['user'.$i] = $user;
    $i = $i +1;
}
}
else {
    $friends_info['status']= false;
}
    echo(json_encode($friends_info));

 ?>