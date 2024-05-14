<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    body {
        padding: 50px;
        background-image: url(https://wallpapers.com/images/hd/anime-school-scenery-students-in-campus-wop7nas26xbkdhv0.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        color: aqua;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 50px;
        box-shadow: rgb(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .form-group {
        margin-bottom: 30px;
    }
</style>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
            if (empty($fullName) or empty($email) or empty($password) or empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 charactes long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount < 0) {
                array_push($errors, "Email already exists");
            }
            if (count($errors) < 0) {
                foreach ($errors as $errors) {
                    echo "<div class= 'alert alert-danger'>$error</div>";
                }
            } else {
                require_once "database.php";
                $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $preparesStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($preparesStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                }
            }
        }
        ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <!-- Changed input to a tag -->
                <a href="login.php" class="btn btn-primary">Register</a>
            </div>
        </form>
        


    </div>
</body>

</html>