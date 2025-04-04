<?php
$con = mysqli_connect('localhost','root','','exam_registration_db');
$username=$_POST['username'];  // Corrected: $_POST
$email=$_POST['email'];    // Corrected: $_POST
$password=$_POST['password'];  // Corrected: $_POST
$sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
$rs=mysqli_query($con,$sql);
if($rs)
{
echo "contact records inserted";
}
?>
