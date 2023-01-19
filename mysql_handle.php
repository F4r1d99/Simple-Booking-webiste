<?php

//D:\Xampp\htdocs\Lab7(Practice)\LabWork7\mysql_handle.php

//XAMPP default
$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";

//Database name based on previous lab
$dbName = "roomServices";

//connection variable
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

?>