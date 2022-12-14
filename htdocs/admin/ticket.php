<?php
session_start();
// vars
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$role = $_SESSION["role"];

$ticketId = $_GET["ticket_id"];

if ($role === "admin") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Tickets</title>
    </head>

    <body class="container">
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
        <div class=\"mb-3\">
            <label for=\"ticket_id\">TicketId:</label><br>
            <input readonly class=\"form-control\" type=\"number\" id=\"ticket_id\" name=\"ticket_id\" value=\"$zeile[0]\"><br>
        </div>
        <div class=\"mb-3\">
            <label for=\"fragesteller\">Fragesteller:</label><br>
            <input readonly class=\"form-control\" type=\"text\" id=\"fragesteller\" name=\"fragesteller\" value=\"$zeile[6]\">
            </div>
        <div class=\"mb-3\">
            <label for=\"frage\">Frage:</label><br>
            <textarea readonly class=\"form-control\" type=\"text\" id=\"frage\" name=\"frage\" rows=\"10\">$zeile[2]</textarea>
        </div>    
        <div class=\"mb-3\">
            <label for=\"antwort\">Antwort:</label><br>
            <textarea class=\"form-control\" type=\"text\" id=\"antwort\" name=\"antwort\" rows=\"10\">$zeile[3]</textarea>
        </div>
        ";
        ?>
        <input class="btn btn-primary" type="submit" value="Senden">
    </form>
        <a href="/admin" style="float: right" class="btn btn-danger" type="submit" value="Senden">Abbrechen</a>
    </body>

    </html>
<?php
} else {
    echo "<h1>403 Forbidden</h1>";
    echo "<a href=\"../login.php\">back to login</a>";
}
?>