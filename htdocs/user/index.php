<?php
session_start();
// vars
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$role = $_SESSION["role"];
if ($role === "user") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Mainpage</title>
    </head>

    <body class="container">

        <?php echo "<h1>Hallo $username</h1>" ?>

        <a style="float: right" class="btn btn-danger" href="/logout.php">Logout</a>

        <?php
        //mysql connection
        $dbname = "praxis";
        $db = mysqli_connect("", "root", "rootpw")
            or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
        mysqli_select_db($db, $dbname)
            or die("<b>Datenbank konnte nicht angesprochen werden</b>");

        //sql query
        $query = "select * from categorie;";
        //here
        $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
        $anz = mysqli_num_rows($ergebnis);
        echo "<ul>";
        for ($a = $anz - 1; $a > -1; $a--) {
            mysqli_data_seek($ergebnis, $a);
            $zeile = mysqli_fetch_row($ergebnis);
            echo "<li> <a href=\"tickets.php?category=$zeile[0]\">" . $zeile[0] . "</a></li>";
        }
        echo "</ul>";

        echo "<a href=\"newticket.php\">+ neues ticket</a>"
        ?>

        <h3>E-Mail postfach</h3>
        <?php
        //mysql connection
        $dbname = "praxis";
        $db = mysqli_connect("", "root", "rootpw")
            or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
        mysqli_select_db($db, $dbname)
            or die("<b>Datenbank konnte nicht angesprochen werden</b>");

        //sql query
        $query = "select * from ticket where fragensteller = \"$username\" AND NOT ticket_status=\"OK\";";
        //here
        $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
        $anz = mysqli_num_rows($ergebnis);
        echo "<ul>";
        for ($a = $anz - 1; $a > -1; $a--) {
            mysqli_data_seek($ergebnis, $a);
            $zeile = mysqli_fetch_row($ergebnis);
            echo "<li> <a href=\"ticket.php?ticket_id=$zeile[0]\">Neue Aktion Erforderlich: " . $zeile[1] . "</a></li>";
        }
        echo "</ul>";
        ?>
    </body>

    </html>
<?php
} else {
    echo "<h1>403 Forbidden</h1>";
    echo "<a href=\"../login.php\">back to login</a>";
}
?>