<?php
session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$role = $_SESSION["role"];
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
        <title>Admin</title>
    </head>

    <body class="container">
        <h1><?php echo "Hallo " . $username ?></h1>
        <a style="float: right" class="btn btn-danger" href="/logout.php">Logout</a>

        <h3>Neue Anfragen</h3>
        <table class="table" border="1">
            <thead>
                <th scope="col">Titel</th>
                <th scope="col">Kategorie</th>
                <th scope="col">Fragesteller</th>
                <th scope="col">Status</th>
                <th scope="col">Bearbeiten</th>
            </thead>
            <?php
            //mysql connection
            $dbname = "praxis";
            $db = mysqli_connect("", "root", "rootpw")
                or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
            mysqli_select_db($db, $dbname)
                or die("<b>Datenbank konnte nicht angesprochen werden</b>");

            //sql query
            $query = "select * from ticket where ticket_status=\"QA\";";
            //here
            $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
            $anz = mysqli_num_rows($ergebnis);
            for ($a = $anz - 1; $a > -1; $a--) {
                mysqli_data_seek($ergebnis, $a);
                $zeile = mysqli_fetch_row($ergebnis);
                echo "<tr>" .
                    "<td>" . $zeile[2] . "</td>" .
                    "<td>" . $zeile[5] . "</td>" .
                    "<td>" . $zeile[6] . "</td>" .
                    "<td>" . $zeile[4] . "</td>" .
                    "<td> <a href=\"ticket.php?ticket_id=$zeile[0]\">Bearbeiten</a></td>" .
                    "</tr>";
            }
            ?>
        </table>

        <h3>Anfragen verbessern</h3>
        <table class="table" border="1">
            <thead>
                <th scope="col">Titel</th>
                <th scope="col">Kategorie</th>
                <th scope="col">Fragesteller</th>
                <th scope="col">Status</th>
                <th scope="col">Bearbeiten</th>
            </thead>
            <?php
            //sql query
            $query = "select * from ticket where ticket_status=\"NW\";";
            //here
            $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
            $anz = mysqli_num_rows($ergebnis);
            for ($a = $anz - 1; $a > -1; $a--) {
                mysqli_data_seek($ergebnis, $a);
                $zeile = mysqli_fetch_row($ergebnis);
                echo "<tr>" .
                    "<td>" . $zeile[2] . "</td>" .
                    "<td>" . $zeile[5] . "</td>" .
                    "<td>" . $zeile[6] . "</td>" .
                    "<td>" . $zeile[4] . "</td>" .
                    "<td> <a href=\"ticket.php?ticket_id=$zeile[0]\">Bearbeiten</a></td>" .
                    "</tr>";
            }
            ?>
        </table>

    </body>

    </html>
<?php
} else {
    echo "<h1>403 Forbidden</h1>";
    echo "<a href=\"../login.php\">back to login</a>";
}
?>