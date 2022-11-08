<?php
include("db_info.php");

// $array = json_decode(file_get_contents("php://input"), true);

// if(isset($array['id']))
// {
//   $id = $array['id'];
// }
// else {
//   die("no required information");
// }

$get_users = $mysqli->prepare("SELECT * FROM users");
$get_users-> execute();
$array =  $get_users-> get_result();

$user=[];
if($array->num_rows>0)
{
  $users['status']= true;
  $i=1;
  while($user = $array->fetch_assoc()){
    $users['user'.$i] = $user;
    $i = $i +1;
}
}
else {
    $users['status']= false;
}
    echo(json_encode($users));

 ?>