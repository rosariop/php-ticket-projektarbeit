<?php
    session_start();
    if($_SESSION["role"] === "admin"){
        echo "istAdmin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Admin</h1>
</body>
</html>
<?php
    } else {
        echo "<h1>403 Forbidden</h1>";
        echo "<a href=\"../login.php\">back to login</a>";
    }
?>