<?php
include('connect.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
   
    if($_POST['user_id']=='-1'){
        addUser($name, $email, $mobile);
    }
    else{
        $user_id = $_POST['user_id'];
        updateUser($user_id, $name, $email, $mobile);
    }
    header("Location: index.php");
}
function updateUser($id, $name, $email, $mobile)
{
    global $conn;
    $query = "UPDATE users SET name='$name', email='$email', mobile=$mobile WHERE id=$id";
    return mysqli_query($conn, $query);
}
function addUser($name, $email, $mobile)
{
    global $conn;
    $query = "INSERT INTO users (name, email, mobile) VALUES ('$name', '$email', $mobile)";
    return mysqli_query($conn, $query);

}
?>