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
if($_POST !=null)
{
    $FilmName = $_POST['FilmName'];
    $FilmTime = $_POST['FilmTime'];
    $FilmPrice = $_POST['FilmPrice'];
    $FilmDate = $_POST['FilmDate'];

    $sql = "INSERT INTO $lentele (FilmName, FilmTime, FilmPrice, FilmDate) 
             VALUES ('$FilmName', '$FilmTime', '$FilmPrice', '$FilmDate')";
    if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
    //echo "Įrašyta";
    header("Location:tvarkarasciuVedimas.php");
    $conn->close();
    exit();
}
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
<div class="container">
    <form
        method='post'>


<!--
        <php
        include("include/nustatymai.php"); //įterpiamas meniu pagal vartotojo rolę
        $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT username,userlevel,email "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
        $result = mysqli_query($db, $sql);
        if (!$result || (mysqli_num_rows($result) < 1))
        {echo "Klaida skaitant lentelę users"; exit;}
        echo "<select name=\"kam\">";
        while ($row = mysqli_fetch_assoc($result))
        {$user= $row['username'];
            echo "<option value=".$user.">".$user."</option>";
        }
        echo "</select>";
        ?>

-->
        <div class="form-group col-lg-12">
            <label for="FilmName" class="control-label">Filmo pavadinimas:</label>
            <textarea name='FilmName' class="form-control input-sm"></textarea>
        </div>

        <div class="form-group col-lg-12">
            <label for="FilmTime" class="control-label">Filmo ilgis</label>
            <textarea name='FilmTime' class="form-control input-sm"></textarea>
        </div>

        <div class="form-group col-lg-12">
            <label for="FilmPrice" class="control-label">Filmo bilieto kaina</label>
            <textarea name='FilmPrice' class="form-control input-sm"></textarea>
        </div>

        <div class="form-group col-lg-12">
            <label for="FilmDate" class="control-label">Filmo rodymo data</label>
            <input type="datetime-local" id="FilmDate" name="FilmDate">
            <!-- Note: type="datetime-local" is not supported in Firefox, Safari or Internet Explorer 12 (or earlier). -->
        </div>

        <div class="form-group col-lg-2">
            <input type='submit' name='ok' value='siųsti' class="btnbtn-default">
        </div>
    </form>
</div>
<!-- atvaizduoti-->
</body>
</html>