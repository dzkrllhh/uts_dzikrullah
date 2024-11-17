<?php
$host = "localhost";
$username= "root";
$password= "";
$database= "db_dikii";

$conn= new mysqli("$host","$username","$password","$database");

if($conn->connect_error) {
    die("koneksi gagal:".$conn->connect_error);
} else {
    echo "1";
}