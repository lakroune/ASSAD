<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assad_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "il y a un erreur";
}
