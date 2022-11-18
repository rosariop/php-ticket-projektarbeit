<!DOCTYPE html>
<html lang="de">
<head>
    <style>
        .center {
            text-align: center;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Ticket-System</title>
</head>
<body>
    <div class="center">
        <h1>Login</h1>
        <form action="loginfunc.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username"><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br>

            <input type="submit" value="Login">
        </form>
</body>
</html>