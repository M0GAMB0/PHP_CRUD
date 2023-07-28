<?php
$conn=mysqli_connect('localhost','root','','crud_db');
if($conn){
  echo "Connection Succesfull <br />";
}
else{
  die("Connection failed").mysqli_connect_error();
}
?>