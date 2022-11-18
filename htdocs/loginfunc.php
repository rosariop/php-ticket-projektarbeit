<?php
    session_start();
    // Vars
    $username = $_POST["username"];
    $pass = $_POST["password"];

    //mysql connection
    $dbname = "praxis";
    $db = mysqli_connect("", "root", "rootpw")
        or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
    mysqli_select_db($db, $dbname)
        or die("<b>Datenbank konnte nicht angesprochen werden</b>");

    //sql query
    $query = "select * from user where username = '" . $username . "' and pass = '" . $pass . "';";
    //here
    $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
    $zeile = mysqli_fetch_row($ergebnis);

    $role = $zeile[2];
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $pass;
    $_SESSION["role"] = $role;

    if($role === "admin"){
        mysqli_close($db);
        header("Location: /admin/index.php");
    }
    if($role === "user"){
        mysqli_close($db);
        header("Location: /user/index.php");
    }
    

    mysqli_close($db);
    header("Location: /user/index.php");
?>