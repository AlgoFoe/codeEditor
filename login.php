<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partials/_dbconnect.php";
    $login = false;
    $showError = false;
    $username = $_POST['name'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($pass, $row["password"])) {
                $login = true;
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["loggedin"] = true;
                // redirect
                header("location:index.php");
            }else {
                $showError = "Passwords do not match";
            }
        }
    } else {
        $showError = "Passwords do not match";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "partials/_nav.php" ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($login) {
            echo "Success: Logged in";
        }
        if ($showError) {
            echo "Error: $showError";
        }
    }
    ?>
    <div class="container my-2" style="display:flex;flex-direction:column;align-items:center">
        <h2 class="text-center mb-2">Login to account</h2>
        <form method="POST" action="/webpage/login_sys/login.php">
            <div class=" mb-3 ">
                <label for="name" class="col-sm-2 col-form-label">Username</label>
                <div class="col-md-12" style="width:500px">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class=" mb-3 ">
                <label for="pass" class="col-sm-2 col-form-label">Password</label>
                <div class="col-md-12" style="width:500px">
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>