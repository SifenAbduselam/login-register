<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">


<?php

require_once "database.php";

if(isset($_POST['submit'])) {


$fullname = trim($_POST["fullname"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$repeatPassword = $_POST["repeat-password"];

$errors = [];

$password_hash = password_hash($password, PASSWORD_DEFAULT);



if(empty($fullname) || empty($email) || empty($password) || empty($repeatPassword)) {

$errors[] = "All fields are required";

}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

$errors[]= "Email is invalid";
}

if(strlen($password) < 8) {

$errors[] = "password must be atleast 8 characters";
}

if($password !== $repeatPassword) {
    $errors[] = "password must match";
}

if(empty($errors)) {

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)>0) {

$errors[] = "Email already exisis";
}

else {

$sql = "INSERT INTO users(fullname, email, password) VALUES(?, ?, ?)";

$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $password_hash);

mysqli_stmt_execute($stmt);

echo "<div class = 'alert alert-success'>Registration successful</div>";

}

}
}
 if(!empty($errors)){
    foreach($errors as $error){
        echo "<div class='alert alert-danger'>$error</div>";
    }
 }
 










?>


        <form action="registration.php" method="POST">
            <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Enter name">
            </div>
             <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
             <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter password">
            </div>
             <div class="form-group">
            <input type="password" class="form-control" name="repeat-password" placeholder="Repeat Password">
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="register" name="submit">
            <div><p>Already registered <a href="login.php">Login Here</a></p></div>

            </div>
        </form>
    </div>
</body>
</html>



 
