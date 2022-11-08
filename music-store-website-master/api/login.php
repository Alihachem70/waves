<?php
include("db_info.php");

$array = json_decode(file_get_contents("php://input"), true);
// print_r($array);
if(isset($array['email']) && isset($array['password']))
{
  $email = $array['email'];
  $pass = $array['password'];
}else {
  echo("no required information");
}

$check_user_exist = $mysqli-> prepare("select * from users u where email=? and password=?");
$check_user_exist->bind_param("ss",$email,$pass);
$check_user_exist-> execute();
$array =  $check_user_exist-> get_result();
$user_info=[];
if($array->num_rows > 0)
{
  $user_info['status']=true;
  $user = $array->fetch_assoc();
  foreach ($user as $key => $value) {
     $user_info[$key] = $value;
  }
}
else{
  $user_info['status']=false;
  echo("user not found");
}

$jsonfile = json_encode($user_info);
echo($jsonfile);

 ?>