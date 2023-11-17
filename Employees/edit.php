<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $position = $row["position"];
        $contact_number = $row["contact_number"];
    } else {
        header("Location: index.php");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $contact_number = $_POST["contact_number"];

    // Server-side validation to ensure contact number has exactly 10 digits
    if (!preg_match('/^\d{10}$/', $contact_number)) {
        echo "Error: Contact number must be a 10-digit number.";
        exit;
    }

    $sql = "UPDATE employees SET name='$name', position='$position', contact_number='$contact_number' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>

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
            color: #333;
            text-align:center;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #3498db;
            text-decoration: none;
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



<script>
        function validateForm() {
            var contactNumber = document.forms["editForm"]["contact_number"].value;

            // Check if the contact number contains exactly 10 digits
            if (!/^\d{10}$/.test(contactNumber)) {
                alert("Contact number must be a 10-digit number.");
                return false;
            }
            return true;
        }
    </script>


</head>
<body>
    <h2>Edit Employee</h2>
    <form name="editForm" action="edit.php" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required><br>

        <label for="position">Position:</label>
        <input type="text" name="position" value="<?php echo $position; ?>" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" required><br>

        <button type="submit">Save Changes</button>
    </form>
    <br>
    <div class="container">
    <a href="index.php" class="button">Back to Employee List</a>
    </div>
</body>
</html>
