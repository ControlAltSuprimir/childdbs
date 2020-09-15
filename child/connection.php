<?php

// Instantiate your DB using the database host, port, name, username, and password
$dbName = 'db-de-prueba';
$dbUser = 'root';
$dbPass = '';
$servername = '192.168.64.2';


$mysqli = mysqli_connect($servername,$dbUser,$dbPass,$dbName,"3306") or die("connection failed");
echo "connection success";

