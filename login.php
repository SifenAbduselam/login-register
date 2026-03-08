<?php
session_start();
if(isset($_SESSION["user"])){

header("Location: index.php");

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">


    <?php  
if(isset($_POST["login"]))
    // did the form sent value called login?
    {

$email = $_POST["email"];
$password=$_POST["password"];

// if the email and password is there we will allow the user to login

require_once"database.php";


$sql =" SELECT * FROM users WHERE email = '$email'";
// search for the email
$result = mysqli_query($conn, $sql);

// excute the query  object is stored 
$user = mysqli_fetch_array($result, MYSQLI_ASSOC );
if($user) {
     if(password_verify($password, $user["password"])) {

    //  6 min left 
    session_start();
    $_SESSION["user"] = "yes";


        header("Location: index.php");
        die();
     }
     else{
            echo "<div class='alert alert-danger'>password does not match</div> ";

     }
} else{
    echo "<div class='alert alert-danger'>Email does not match</div> ";
}




}

    ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter Email:" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter Password:" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="login" name="login" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>