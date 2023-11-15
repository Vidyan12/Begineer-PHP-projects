<?php  


$db_server = "localhost";  

$db_user = "root";  

$db_pass = ""; 

$db_name = "login_db";
$conn = "";  

try{

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);   // Establishing a connection to the database using mysqli_connect function
                                                                    // It takes the server name, username, password, and database name as parameters
}
catch(mysqli_sql_exception){       // Catch any exceptions that may occur during the connection attempt
    
    echo"You are not connected";
}

?>