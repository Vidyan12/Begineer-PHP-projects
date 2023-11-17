<?php
include("db.php");

// Retrieve and display employee records
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>

    <style>
   
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h2 {
            text-align:center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }

        a:hover {
            color: #258cd1;
        }


        .button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            }

      .container {
    text-align: center;
}

    
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Contact Number</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["position"]."</td>
                        <td>".$row["contact_number"]."</td>
                        <td><a href='edit.php?id=".htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8')."'>Edit</a> | <a href='delete.php?id=".htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8')."'>Delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'> No records found </td></tr>";
        }
        ?>
    </table>
    <br>
    <div class="container">
        <a href="add.php" class="button">Add New Employee</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
