
<?php  
// Including the file that establishes the database connection
include("database.php");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" placeholder="Enter your username" name="username" required >
        <input type="password" placeholder="Enter your password" name="password" required>

        <a href="#">Forgot password?</a>
        <input type="submit" class="button" value="Login">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <a  href="signup.php"  for="check">Signup</a>
        </span>
      </div>
    </div>
</div>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password from the form
    $enteredUsername = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $enteredPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    // Query to retrieve the stored password for the entered username
    $query = "SELECT username, password FROM users WHERE username = '$enteredUsername'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if the username exists in the database
        if (mysqli_num_rows($result) > 0) {
            // Fetch the result row
            $row = mysqli_fetch_assoc($result);

            // Verify the entered password against the stored hashed password
            if (password_verify($enteredPassword, $row['password'])) {
                // Redirect to home.php on successful login
                header("Location: demo.php");
                exit(); // Ensure that no further code is executed after the header
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "Username not found. Please check your username.";
        }
    } else {
        // Outputting other database errors
        echo "Error: " . mysqli_error($conn);
    }
}

// Closing the database connection
mysqli_close($conn);
?>







</body>
</html>