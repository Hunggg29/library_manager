<!DOCTYPE html>
<html>
<?php session_start() ?>
<?php include "disconn_andconn/dbconnect.php" ?>
<?php
   if(isset($_SESSION["account_id"]) && isset($_SESSION["borrowbook_id"])){
    $query = "SELECT COUNT(transaction_id) 
              FROM (
                  SELECT user_info.userinfo_id, transaction_id, transaction.status 
                  FROM user_info 
                  LEFT JOIN transaction ON user_info.userinfo_id = transaction.userinfo_id 
                  WHERE user_info.status = 1
              ) AS foo 
              WHERE (foo.status = 0 OR foo.status IS NULL) 
              GROUP BY userinfo_id 
              HAVING userinfo_id = " . $_SESSION["account_id"];
    $result = mysqli_query($Conn, $query);
    if($row = mysqli_fetch_assoc($result)){
        $cter1 = $row["COUNT(transaction_id)"];
    }
    
    $query = "INSERT INTO transaction (userinfo_id, book_id) 
              VALUES (" . $_SESSION["account_id"] . ", " . $_SESSION["borrowbook_id"] . ")";
    $result = mysqli_query($Conn, $query);
    
    if($result && $cter1 < 5){
?>


        <script>
            alert('borrow success!');
        </script>

         <head>
        <meta charset="UTF-8">
        <title>SUCCESS</title>
        <link rel="stylesheet" href="../css/create_transaction.css">
    </head>
    <body>
        <div class="card">
        <div class="card_ima">
                <img src="images/book.jpeg">
            </div>
            <div class="card_title" style = "font-size: 15px;"> 
            <?php
                if(isset($_SESSION["borrowbook_id"])){
                $query = 'SELECT book_name,description FROM book WHERE book_id = '.$_SESSION["borrowbook_id"];
                $result = mysqli_query($Conn,$query);
                if($row = mysqli_fetch_assoc($result)){
                    echo 'Borrow success '. $row["book_name"];
                }
            }
            ?> 
            </div>
            <div class="card_option">
                <p><?php  echo $row["description"]; ?></p>
            </div>
            <div class="card_action">
            <a href = "../index.php">Cancel</a>
            </div>
        </div>
    </body>
</html>
<?php
        }
        else{
?>
        <script>
            alert('borrow fail!');
        </script>
         <head>
        <meta charset="UTF-8">
        <title>Product Card</title>
        <link rel="stylesheet" href="../css/create_transaction.css">
    </head>
    <body>
        <div class="card">
            <div class="card_ima">
                <img src="images/book.jpeg">
            </div>
            <div class="card_title" style = "font-size: 15px;"> 
            <?php
                if(isset($_SESSION["borrowbook_id"])){
                $query = 'SELECT book_name,description FROM book WHERE book_id = '.$_SESSION["borrowbook_id"];
                $result = mysqli_query($Conn,$query);
                if($row = mysqli_fetch_assoc($result)){
                    echo 'Wrong borrow '. $row["book_name"];
                }
            }
            ?> 
            </div>
            <div class="card_option">
                <p><?php  echo $row["description"]; ?></p>
            </div>
            <div class="card_action">
            <a href = "../index.php">Cancel</a>
            </div>
        </div>
    </body>
</html>
<?php
        }
    }
    
?>