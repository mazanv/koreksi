<?php
include "koneksi.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Login | Sewa</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <form action="proses_login.php" method="post">
                <label class="label-control" for="username">Username</label>
                <br><input class="form-control" type="username" name="username" id="username" required>
                <label class="label-control" for="password">Password</label>
                <br><input class="form-control" type="password" name="password" id="password" required>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>