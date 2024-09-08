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
                    $_SESSION["transaction_id"] = test_input($_POST["transaction_id"]);
                }
                if(isset($_SESSION["transaction_id"])){
                    $query = "CALL findallreturned(?)";
                    $stmt = $Conn->prepare($query);
                
                    if (!$stmt) {
                        die("Error preparing statement: " . mysqli_error($Conn));
                    }
                
                    $transaction_id = $_SESSION["transaction_id"];
                    $stmt->bind_param("i", $transaction_id);
                
                    if (!$stmt->execute()) {
                        die("Error executing statement: " . mysqli_error($Conn));
                    }
                
                    $result = $stmt->get_result();
                
                    if (!$result) {
                        die("Error getting result: " . mysqli_error($Conn));
                    }
                
                    if($row = $result->fetch_assoc()){
                        echo $row["fines"]." VND";
                    }
                
                    $stmt->close();
                }
            ?> 
            </div>
            <div class="card_option" style = "font-size:20px;">
                <p><?php  echo  " Are you confirm ".$row["name"]." pay to fine ".$row["fines"]." ?"; ?></p>
            </div>
            <div class="card_action">
            <a href = "confirmedbook.php">Cancel</a>
            <form action="../pay.php" method = "POST">
                <input type ="hidden" name = "user_id" value ="<?php echo $row["userinfo_id"]; ?>"> 
                <input type ="hidden" name = "fines" value ="<?php echo $row["fines"];?>"> 
                <button type ="submit">Confirm</button>  
            </form>
            </div>
        </div>

    </body>
</html>