<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";

$db_handler = mysqli_connect($hostname,$username,$password) or die("Not connected! Error!");
mysqli_select_db($db_handler,$dbname) or die("DB not selected!");
