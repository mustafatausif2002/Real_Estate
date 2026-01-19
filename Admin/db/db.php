<?php
$host="localhost";
$user="root";
$pass="";
$dbname="real_estate";

$conn = new mysqli($host,$user,$pass,$dbname);

if($conn->connect_error)
{
    die("Connect lost". $conn->connect_error);        
}
?>
