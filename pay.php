<?php session_start() ?>
<?php include "disconn_andconn/dbconnect.php" ?>
<?php include "test.php" ?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_SESSION["account_id"]){
            $query = "INSERT INTO fines(nhanvien_id,userinfo_id,money) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($Conn, $query);
            mysqli_stmt_bind_param($stmt, 'iii', $_SESSION["account_id"], $_POST["user_id"], $_POST["fines"]);
            $result = mysqli_stmt_execute($stmt);
            if($result){
                $query = "UPDATE returnbooks SET status = 1 WHERE transaction_id = ?";
                $stmt = mysqli_prepare($Conn, $query);
                mysqli_stmt_bind_param($stmt, 'i', $_SESSION["transaction_id"]);
                $result = mysqli_stmt_execute($stmt);
                header('location:nhanvienindex/confirmedbook.php');
            }
            else{
                header('location:index.php');
            }
        }
    }
?>

// đã sửa