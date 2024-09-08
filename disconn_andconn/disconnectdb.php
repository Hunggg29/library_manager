
<?php
$servername = "127.0.0.1:3366";
$username = "root";
$password = "";
$dbname = "libmaneger";


// Đóng kết nối
if (!mysqli_close($Conn)) 
{
    echo "Failed to close connection to " . $servername . ": " . mysqli_connect_error() . "<br/>\n";
}
?>