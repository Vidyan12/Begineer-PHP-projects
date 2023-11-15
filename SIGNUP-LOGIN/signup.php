<?php
// Including the file that establishes the database connection
include("database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling form submission when the user clicks "register"
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    // Checking if username is empty
    if (empty($username)) {
        echo "Please enter a username";
    }

    // Checking if password is empty
    elseif (empty($password)) {
        echo "Please enter a password";
    } else {
        // Hashing the password for security
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert user data into the 'users' table
        $sql = "INSERT INTO users(username, password) VALUES ('$username' , '$hash') ";

        // Executing the SQL query
        $result = mysqli_query($conn, $sql);

        // Checking for errors in the query execution
        if ($result === false) {
            // Checking for duplicate entry error (code 1062)
            if (mysqli_errno($conn) == 1062) {
                echo "That username is already taken. Try another one.";
            } else {
                // Outputting other database errors
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Successful registration message
            echo "You are now registered";
            // Redirect to home.php on successful login
            header("Location: login.php");
            exit(); // Ensure that no further code is executed after the header
        }
    }
}

// Closing the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
  width: 100%;
  background: #009579;
}
.container{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  max-width: 430px;
  width: 100%;
  background: #fff;
  border-radius: 7px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.3);
}
.container .registration{
  
}
#check:checked ~ .registration{
  display: block;
}
#check:checked ~ .login{
 
}
#check{
  
}
.container .form{
  padding: 2rem;
}
.form header{
  font-size: 2rem;
  font-weight: 500;
  text-align: center;
  margin-bottom: 1.5rem;
}
 .form input{
   height: 60px;
   width: 100%;
   padding: 0 15px;
   font-size: 17px;
   margin-bottom: 1.3rem;
   border: 1px solid #ddd;
   border-radius: 6px;
   outline: none;
 }
 .form input:focus{
   box-shadow: 0 1px 0 rgba(0,0,0,0.2);
 }
.form a{
  font-size: 16px;
  color: #009579;
  text-decoration: none;
}
.form a:hover{
  text-decoration: underline;
}
.form input.button{
  color: #fff;
  background: #009579;
  font-size: 1.2rem;
  font-weight: 500;
  letter-spacing: 1px;
  margin-top: 1.7rem;
  cursor: pointer;
  transition: 0.4s;
}
.form input.button:hover{
  background: #006653;
}
.signup{
  font-size: 17px;
  text-align: center;
}
.signup label{
  color: #009579;
  cursor: pointer;
}
.signup label:hover{
  text-decoration: underline;
}


    </style>
   
</head>
<body>

<div class="container">
<div class="registration form">
    <header>Signup</header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" placeholder="Enter your username" name="username">
        <input type="password" placeholder="Create a password" name="password">
        <input type="submit" class="button" value="Signup">
    </form>
    <div class="signup">
        <span class="signup">Already have an account?
            <a href="login.php" for="check">Login</a>
        </span>
    </div>
</div>

</div>


</body>
</html>