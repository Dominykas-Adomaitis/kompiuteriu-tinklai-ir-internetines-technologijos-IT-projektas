<?php
session_start();
//var_dump( $_SESSION['user']);
$server="localhost";
$user="root";
$password="stud";
$dbname="vartvald";
$lentele="filmorder";

// prisijungti
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Statistika</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
    </script>

    <style>
        #filmai {
            font-family: Arial; border-collapse: collapse; width: 70%;
        }
        #filmai td {
            border: 1px solid #ddd; padding: 8px;
        }
        #filmai tr:nth-child(even){background-color: #f2f2f2;}
        #filmai tr:hover {background-color: #ddd;}


    </style>

</head>
<body>
    Atgal į [<a href="index.php">Pradžia</a>]
    <center><h1>Statistika</h1></center>
    <table style="margin: 0px auto;" id="filmai">


        <?php
        //  nuskaityti
        //$sql =  "SELECT * FROM $lentele";

        $sql = "SELECT
        SUM(orderTotal) AS total, orderFilmName
        FROM filmorder
        GROUP BY
        orderFilmName";

        if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
        //print_r($sql);

        // parodyti

        //echo "<table border=\"1\">";
        echo "<tr>
		<td>Pavadinimas</td>
		<td>Visa parduotų bilietų suma</td>
		</tr>";

        while($row = $result->fetch_assoc())
        {
            echo "<tr>
		<td>".$row['orderFilmName']."</td>
        <td>".$row['total']."</td>
		</tr>";
        }
        //echo "</table>";
        $conn->close();
        ?>
    </table>
</body>
</html>