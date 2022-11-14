<!DOCTYPE html>
<html lang="en">
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
        <h1>Registrieren</h1>
        <form action="register.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username"><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br>

            <label for="password-retype">Password</label><br>
            <input type="password-retype" id="password-retype" name="password-retype"><br>
            <br>
            <select name="role" id="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <br>
            <br>
            <input type="submit" value="Registrieren">
        </form>

        <?php 

            $dbname = "praxis";
            // Vars
            $username = $_POST["username"];
            $pass = $_POST["password"];
            $pass2 = $_POST["password-retype"];
            $role = $_POST["role"];

            // Pass retype
            if ($pass != $pass2){
                echo "<p style='color: red'>Passwörter stimmen nicht überein!</p>";
                return;
            }

            //mysql connection
            $db=mysqli_connect("", "root", "rootpw")
            or die ("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
            mysqli_select_db($db, $dbname)
            or die ("<b>Datenbank konnte nicht angesprochen werden</b>");
            
            //sql query
            $query = "INSERT INTO user (username, pass, user_role) values ('". $username . "', '". $pass ."', '". $role ."');";

            mysqli_query($db, $query) or die ("<b>Fehler bei der Datenbankanfrage</b>");         
            mysqli_close($db);

            echo "<p style=\"color: green\">Erfolg</p>"
        ?>
    </div>
</body>
</html>