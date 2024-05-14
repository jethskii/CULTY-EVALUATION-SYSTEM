<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</Form>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            padding: 50px;
            margin-left: 50px;
            background-image: url(https://opengameart.org/sites/default/files/school.png);
            background-repeat: no-repeat;
            background-size: cover;
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
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["users"] = "yes";
                    header("Location: home.html");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }

        ?>
        <form id="loginForm" action="login.php" method="post">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary" onclick="redirectToHome()">
            </div>
        </form>

        <script>
            function redirectToHome() {
                window.location.href = "home.html";
            }
        </script>

        </form>
    </div>

</body>

</html>