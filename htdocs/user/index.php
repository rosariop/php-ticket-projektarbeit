<?php
    session_start();
    // vars
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $role = $_SESSION["role"];
    if($role === "user"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Mainpage</title>
</head>
<body>

    <?php echo "<h1>Hallo $username</h1>" ?>

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
        echo "<li> <a href=\"tickets?category=$zeile[0]\">" . $zeile[0] . "</a></li>";
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