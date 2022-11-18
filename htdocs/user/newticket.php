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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Tickets</title>
    </head>

    <body>
        <form action="newticketlogic.php" method="post">

            <label for="titel">Titel:</label><br>
            <input type="text" id="titel" name="titel" maxlength="16"><br>

            <label for="frage">Frage:</label><br>
            <textarea type="text" id="frage" name="frage" rows="10"></textarea><br>
            <select name="categorie" id="categorie">
                <option value="">--- Kategorie auswählen ---</option>

                <!-- TODO: Kategorien aus DB laden -->
                <?php
                $dbname = "praxis";
                $db = mysqli_connect("", "root", "rootpw")
                    or die("<b>Zur Zeit kein Connect zum Datenbankserver!</b>");
                mysqli_select_db($db, $dbname)
                    or die("<b>Datenbank konnte nicht angesprochen werden</b>");
                $query = "select * from categorie;";
                $ergebnis = mysqli_query($db, $query) or die("<b>Fehler bei der Datenbankanfrage</b>");
                $anz = mysqli_num_rows($ergebnis);

                for ($a = $anz - 1; $a > -1; $a--) {
                    mysqli_data_seek($ergebnis, $a);
                    $zeile = mysqli_fetch_row($ergebnis);
                    echo "<option value=\"$zeile[0]\">$zeile[0]</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Senden">
    </body>

    </html>
<?php
} else {
    echo "<h1>403 Forbidden</h1>";
    echo "<a href=\"../login.php\">back to login</a>";
}
?>