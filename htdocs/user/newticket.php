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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Tickets</title>
    </head>

    <body class="container">
        <form action="newticketlogic.php" method="post">
            <div class="mb-3">
                <label for="titel">Titel:</label><br>
                <input class="form-control" type="text" id="titel" name="titel" maxlength="16"><br>
            </div>

            <div class="mb-3">
                <label for="frage">Frage:</label><br>
                <textarea class="form-control" type="text" id="frage" name="frage" rows="10"></textarea><br>
            </div>

            <div class="mb-3">
                <select class="form-control" name="categorie" id="categorie">
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
            </div>
            <input class="btn btn-primary"type="submit" value="Fragen">
        </form>
        <br/>
        <a href="/user/index.php" style="float: right" class="btn btn-danger">Abbrechen</a>
    </body>

    </html>
<?php
} else {
    echo "<h1>403 Forbidden</h1>";
    echo "<a href=\"../login.php\">back to login</a>";
}
?>