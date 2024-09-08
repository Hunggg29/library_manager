<?php
$servername = "127.0.0.1:3366";
$username = "root";
$password = "";
$dbname = "libmaneger";

// Tạo kết nối
$Conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$Conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>