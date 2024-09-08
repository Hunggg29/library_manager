<?php include "../disconn_andconn/dbconnect.php" ?>
<?php include "../test.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product Card</title>
        <link rel="stylesheet" href="../css/create_transaction.css">
    </head>
    <body>
        
        <div class="card">
            <div class="card_ima">
                <img src="../images/book.jpeg">
            </div>
            <div class="card_title"> 
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $_SESSION["borrowbook_id"] = test_input($_POST["borrowbook_id"]);
                }
                if(isset($_SESSION["borrowbook_id"])){
                    $query = 'SELECT book_name, description FROM book WHERE book_id = '.$_SESSION["borrowbook_id"];
                    $result = mysqli_query($Conn, $query);
                    if($row = mysqli_fetch_assoc($result)){
                        echo $row["book_name"];
                    }
                }
            ?> 
            </div>
            <div class="card_option">
                <p><?php echo $row["description"]; ?></p>
            </div>
            <div class="card_action">
                <a href = "../index.php">Cancel</a>
                <form action="../create.php">
                    <button type="submit">Borrow Now</button>  
                </form>
            </div>
        </div>

    </body>
</html>