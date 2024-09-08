
<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
    <style>
        .tableofbook {
            overflow-x: auto;
        }
    </style>
</head>
<body>

<div class="tableofbook">
    <form method="GET" action="">
        <label for="genre">Chọn thể loại sách:</label>
        <select id="genre" name="genre">
            <option value="">Tất cả</option>
            <option value="Psychology">Psychology</option>
            <option value="Automative">Automative</option>
            <option value="Electronics">Electronics</option>
            <option value="Shoes">Shoes</option>
            <option value="Grocery">Grocery</option>
            <option value="Garden">Garden</option>
            <option value="Outdoors">Outdoors</option>
            <option value="Books">Books</option>
            <option value="Computers">Computers</option>
            <option value="Beauty">Beauty</option>
            <option value="Sports">Sports</option>
            <option value="Tools">Tools</option>
        </select>
        <button type="submit">Lọc</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Author</th>
            <th>Available</th>
        </tr>
        <?php
        $searchbook = isset($_GET['searchbook']) ? $_GET['searchbook'] : ' ';
        $genre = isset($_GET['genre']) ? $_GET['genre'] : '';

        // Perform query
        if ($searchbook == '' && $genre == '') {
            $query = 'CALL getinfo_availablebook(NULL)';
            $result = mysqli_query($Conn, $query);
            if (!$result) {
                echo "An error occurred: " . mysqli_error($Conn);
                exit;
            }
        } else {
            if ($searchbook == ' ') {
                $query = "CALL find_availablebookBytype(?)";
            } else if ($genre == '') {
                $query = "CALL getinfo_availablebook(?)";
            } else {
                $query = "CALL getinfo_availablebook(?)";
            }
            $stmt = $Conn->prepare($query);

            if (!$stmt) {
                die("Error preparing statement: " . mysqli_error($Conn));
            }

            if ($searchbook == ' ') {
                $stmt->bind_param("s", $genre);
            } else if ($genre == '') {
                $searchbook_param = '%' . $searchbook . '%';
                $stmt->bind_param("s", $searchbook_param);
            } else {
                $searchbook_param = '%' . $searchbook . '%';
                $stmt->bind_param("ss", $genre, $searchbook_param);
            }

            if (!$stmt->execute()) {
                die("Error executing statement: " . mysqli_error($Conn));
            }

            $result = $stmt->get_result();

            if (!$result) {
                die("Error getting result: " . mysqli_error($Conn));
            }
        }

        // Fetch and process the results
        while ($row = ($searchbook == "" ? mysqli_fetch_assoc($result) : $result->fetch_assoc())) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row["book_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["type"]); ?></td>
                <td><?php echo htmlspecialchars($row["author"]); ?></td>
                <td><?php echo htmlspecialchars($row["available"]); ?></td>
                <?php if (isset($_SESSION["signinstatus"]) && $_SESSION["signinstatus"]) { ?>
                    <td>
                        <form action="layout/create_transaction.php" method="POST">
                            <input type="hidden" name="borrowbook_id" value="<?php echo htmlspecialchars($row["book_id"]); ?>">
                            <button type="submit">Borrow</button>
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php
        }

        ?>
    </table>
</div>

</body>
</html>
