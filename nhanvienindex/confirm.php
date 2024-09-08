<?php include "../disconn_andconn/dbconnect.php" ?>
<?php include "../test.php" ?>
<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["transaction_id"] = test_input($_POST["transaction"]);
    if ($_SESSION["account_id"] && $_SESSION["transaction_id"]) {
        $query = 'INSERT IGNORE INTO returnbooks(transaction_id, nhanvien_id) 
                  VALUES(' . $_SESSION["transaction_id"] . ',' . $_SESSION["account_id"] . ')';
        $result = mysqli_query($Conn, $query);
        if ($result) {
            echo "<script>alert('Confirm SUCCESS')</script>";
            header('location:../index.php');
        } else {
            echo "<script>alert('Confirm FALSE')</script>";
            header('location:../index.php');
        }
    }
}
?>
