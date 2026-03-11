<?php

require_once "database.php";
  
$errors = [];

if(isset($_POST["submit"])) {

$fullname = trim($_POST["fullname"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$repeatPassword = $_POST["repeat-password"];


$password_hash = password_hash($password, PASSWORD_DEFAULT);


if(empty($fullname) || empty($email) || empty($password) || empty($repeatPassword )){

$errors[] = "All fields are required ";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Email is invalid";
}

if(strlen($password) < 8) {
    $errors[] = "Password must be morethan 8 characters";
}

if($password !== $repeatPassword){
    $errorS[] = "Passwords must match";
}



if(empty($errors)) {
    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        $errors[] = "Email already exists";
    }    
    

    else {
$sql =" INSERT INTO users(fullname, email, password) VALUES(?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $password_hash);

mysqli_stmt_execute($stmt);

echo "<div class = 'alert alert-success'>Registration successful</div>";

    

    }
}

if(!empty($errors)){
    foreach($errors as $error){
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
}
?>