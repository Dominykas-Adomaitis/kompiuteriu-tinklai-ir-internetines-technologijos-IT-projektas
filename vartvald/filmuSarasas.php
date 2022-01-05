<?php
session_start();
//var_dump( $_SESSION['user']);
$server="localhost";
$user="root";
$password="stud";
$dbname="vartvald";
$lentele="film";

// prisijungti
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Labarotorinis darbas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
    </script>
    <style>
        #zinutes {
            font-family: Arial; border-collapse: collapse; width: 70%;
        }
        #zinutes td {
            border: 1px solid #ddd; padding: 8px;
        }
        #zinutes tr:nth-child(even){background-color: #f2f2f2;}
        #zinutes tr:hover {background-color: #ddd;}
    </style>

</head>
<body>
Atgal į [<a href="index.php">Pradžia</a>]
<center><h3>Filmų sąrašas</h3></center>
<table style="margin: 0px auto;" id="zinutes">


    <?php
    //  nuskaityti
    $sql =  "SELECT * FROM $lentele";
    if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
    //print_r($sql);

    // parodyti

    //echo "<table border=\"1\">";
    echo "<tr>
		<td>ID</td>
		<td>Pavadinimas</td>
		<td>Ilgis (min)</td>
		<td>Kaina</td>
		<td>Data</td>
		</tr>";

    while($row = $result->fetch_assoc())
    {
        echo "<tr>
		<td>".$row['FilmID']."</td>
		<td>".$row['FilmName']."</td>
		<td>".$row['FilmTime']."</td>
		<td>".$row['FilmPrice']."</td>
		<td>".$row['FilmDate']."</td>
		</tr>";
    }
    //echo "</table>";
    $conn->close();
    ?>
</table>
</body>
</html>