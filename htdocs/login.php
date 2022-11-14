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
        <form action="login.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username"><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br>

            <input type="submit" value="Login">
        </form>

        <?php 

            $dbname = "praxis";
            // Vars
            $username = $_POST["username"];
            $pass = $_POST["password"];

            //mysql connection
            $db=mysqli_connect("", "root", "rootpw")
            or die ("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
            mysqli_select_db($db, $dbname)
            or die ("<b>Datenbank konnte nicht angesprochen werden</b>");
            
            //sql query
            $query = "select * from user where username = '". $username ."' and pass = '" . $pass ."';";
            //here
            $ergebnis = mysqli_query($db, $query) or die ("<b>Fehler bei der Datenbankanfrage</b>");         
            
            mysqli_close($db);
        ?>
    </div>
</body>
</html>