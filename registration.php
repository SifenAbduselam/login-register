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


        <form action="process_register.php" method="POST">
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



 
