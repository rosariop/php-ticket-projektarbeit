<?php
    session_start();
    // vars
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $role = $_SESSION["role"];

    $ticketid = $_POST["ticket_id"];
    $neue_antwort = $_POST["antwort"];

    if($role === "admin"){
        //mysql connection
        $dbname = "praxis";
        $db = mysqli_connect("", "root", "rootpw")
        or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
        mysqli_select_db($db, $dbname)
        or die("<b>Datenbank konnte nicht angesprochen werden</b>");

        // sql query
        $query = "update ticket set ticket_status=\"NA\" where ticket_id=". $ticketid . ";";
        $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");

        $query = "update ticket set antwort=\"$neue_antwort\" where ticket_id=". $ticketid . ";";
        $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");

        header("Location: index.php");
    } else {
        echo "<h1>403 Forbidden</h1>";
        echo "<a href=\"../login.php\">back to login</a>";
    }
?>