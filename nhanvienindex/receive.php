<?php include "../disconn_andconn/dbconnect.php"; ?>
<?php include "../test.php"; ?>
<?php include "../status.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/userstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>libmaneger</title>
</head>
<body>

<div class="user_header">
    <p><?php echo "Hello " . $_SESSION["typeaccount"] . " " . $_SESSION["accountname"]; ?></p>
    <div class="optionaluser">
        <ul>
            <li class="logout" style="font-size:11px;"><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            <li class="profile" style="font-size:11px;"><a href="profileuser.php"><i class="fas fa-user"></i>Profile</a></li>
            <li class="home" style="font-size:11px;"><a href="../index.php"><i class="fa fa-home"></i>Home</a></li>
        </ul>
    </div>
</div>

<div class="imageintro">
    <img src="../images/Introlib.jpeg" alt="Library Intro Image">
</div>

<?php
$searchdate = $searchdateErr = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["searchdate"])) {
        $searchdateErr = "Search date is required";
    } else {
        $searchdate = test_input($_GET["searchdate"]);
    }
}
?>

<div class="searchbar">
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" target="_self">
        <input type="date" value="<?php echo date("Y-m-d"); ?>" name="searchdate">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>

<div class="tableofbook" style="overflow-x: auto;">
    <table>
        <tr>
            <th>Name</th>
            <th>User</th>
            <th>ReceiveNhanVien</th>
            <th>Money</th>
            <th>Fines Date</th>
        </tr>
        <?php
        // Prepare and execute the query
        $searchdate = isset($_GET['searchdate']) ? $_GET['searchdate'] : '';

        if ($searchdate == '') {
            $query = "CALL findallfined(NULL)";
        } else {
            $query = "CALL findallfined(?)";
        }

        if ($stmt = $Conn->prepare($query)) {
            if ($searchdate != "") {
                $stmt->bind_param("s", $searchdate);
            }

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nhanvienusername"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["money"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["finesdate"]) . "</td>";
                    echo "</tr>";
                }
                $result->free();
            } else {
                echo "Error: " . $Conn->error;
            }

        } else {
            echo "Error preparing statement: " . $Conn->error;
        }


        ?>
    </table>
</div>

<?php include "../disconn_andconn/disconnectdb.php"; ?>
<script src="../js/app.js"></script>

</body>
</html>
