<?php
    session_start();
    // vars
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $role = $_SESSION["role"];

    $ticketId = $_GET["ticket_id"];

    if($role === "user"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tickets</title>
</head>
<body>
<?php 
    //mysql connection
    $dbname = "praxis";
    $db = mysqli_connect("", "root", "rootpw")
    or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
    mysqli_select_db($db, $dbname)
    or die("<b>Datenbank konnte nicht angesprochen werden</b>");

    //sql query
    $query = "select * from ticket where ticket_id = $ticketId;";
    //here
    $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
    $zeile = mysqli_fetch_row($ergebnis);

    echo "<h1>$zeile[1]</h1>";

    echo 
    "<form action=\"ticketlogic.php\" method=\"post\">
        <label for=\"ticket_id\">TicketId:</label><br>
        <input readonly type=\"number\" id=\"ticket_id\" name=\"ticket_id\" value=\"$zeile[0]\"><br>

        <label for=\"fragesteller\">Fragesteller:</label><br>
        <input readonly type=\"text\" id=\"fragesteller\" name=\"fragesteller\" value=\"$zeile[6]\"><br>

        <label for=\"frage\">Frage:</label><br>
        <textarea readonly type=\"text\" id=\"frage\" name=\"frage\" rows=\"10\">$zeile[2]</textarea><br>

        <label for=\"antwort\">Antwort:</label><br>
        <textarea readonly type=\"text\" id=\"antwort\" name=\"antwort\" rows=\"10\">$zeile[3]</textarea><br>
        ";
        if($zeile[4] === "NA"){
            echo "<select name=\"ticket_status\" id=\"ticket_status\">
                <option value=\"\">--- ticket status auswählen ---</option>
                <option value=\"NA\">Braucht Nachbesserung</option>
                <option value=\"OK\">Fertig</option>
            </select>
            <br/>
            <input type=\"submit\" value=\"Senden\">";
        }
    echo "</form>"
    ?>
</body>
</html>
<?php
    } else {
        echo "<h1>403 Forbidden</h1>";
        echo "<a href=\"../login.php\">back to login</a>";
    }
?>