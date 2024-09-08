<!DOCTYPE html>
<html>
<head>
    <title>Transaction List</title>
    <style>
        .tableofbook {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="tableofbook">
    
    <?php 
   

    // Chuẩn bị và thực hiện truy vấn
    if ($searchtransaction == "") {
        $query = "CALL findall_actransaction(NULL)";
        $result = $Conn->query($query);

        if (!$result) {
            die("Error executing query: " . $Conn->error);
        }
    } else {
        $query = "CALL findall_actransaction(?)";
        $stmt = $Conn->prepare($query);

        if (!$stmt) {
            die("Error preparing statement: " . $Conn->error);
        }

        $searchtransaction_param = '%' . $searchtransaction . '%';
        $stmt->bind_param("s", $searchtransaction_param);

        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
    }

    if ($result && $result->num_rows > 0) {
        // Nếu có kết quả, hiển thị bảng
        echo '<table>
                <tr>
                    <th>User</th>
                    <th>Book Borrow</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['book_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['borrowdate']) . "</td>";
            echo "<td>" . htmlspecialchars($row['duedate']) . "</td>";
            echo '<td>
                    <form action="nhanvienindex/confirm.php" method="POST">
                        <input type="hidden" name="transaction" value="' . htmlspecialchars($row['transaction_id']) . '"> 
                        <button type="submit">Confirm</button>
                    </form>
                  </td>';
            echo "</tr>";
        }

        echo '</table>';

        $result->free();
    } else {
        // Nếu không có kết quả, không hiển thị gì
        echo 'No transactions found.';
    }
    ?>
</div>

</body>
</html>
