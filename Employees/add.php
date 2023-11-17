<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($_POST["position"], ENT_QUOTES, 'UTF-8');
    $contact_number = htmlspecialchars($_POST["contact_number"], ENT_QUOTES, 'UTF-8');

    // Server-side validation to ensure contact number has exactly 10 digits
    if (!preg_match('/^\d{10}$/', $contact_number)) {
        echo "Error: Contact number must be a 10-digit number.";
        exit;
    }

    $sql = "INSERT INTO employees (name, position, contact_number) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $name, $position, $contact_number);

        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>

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
            var contactNumber = document.forms["employeeForm"]["contact_number"].value;

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
    <h2>Add New Employee</h2>
    <form name="employeeForm" action="add.php" method="post" onsubmit="return validateForm()">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="position">Position:</label>
        <input type="text" name="position" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required><br>

        <button type="submit">Add Employee</button>
    </form>
    <br>
    <div class="container">
        <a href="index.php" class="button">Back to Employee List</a>
    </div>
</body>
</html>
