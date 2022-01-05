<?php
session_start();
//var_dump( $_SESSION['user']);
$server="localhost";
$user="root";
$password="stud";
$dbname="vartvald";
$lentele="film";
$lentele2="schedule";

// prisijungti
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

if(isset($_POST['submitOne']))
{
    $FilmName = $_POST['FilmName'];
    $FilmTime = $_POST['FilmTime'];
    $FilmPrice = $_POST['FilmPrice'];
    $FilmFoto = $_POST['FilmFoto'];

    $sql = "INSERT INTO $lentele (FilmName, FilmTime, FilmPrice, FilmFoto) 
             VALUES ('$FilmName', '$FilmTime', '$FilmPrice', '$FilmFoto')";
    if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
    //echo "Įrašyta";
    header("Location:tvarkarasciuVedimasFoto.php");


    $conn->close();
    exit();
}

else if(isset($_POST['submitTwo']))
{
    $_SESSION['pav'] = $_POST['filmai'];
    $_SESSION['data'] = $_POST['data'];



    header("Location:tvarkarasciuVedimasFoto.php");


    $conn->close();
    exit();
}

else if(isset($_POST['submitThree']))
{
    $FilmPav = $_SESSION['pav'];
    $FilmLaikas = $_POST['laikas'];
    $FilmData = $_SESSION['data'];

    $filmoLaikas = date('Y-m-d H:i:s', strtotime("$FilmData $FilmLaikas"));

    $sql = "INSERT INTO $lentele2 (filmoPavadinimas, filmoValanda, filmoDiena, filmoLaikas) 
             VALUES ('$FilmPav', '$FilmLaikas', '$FilmData', '$filmoLaikas')";
    if (!$result = $conn->query($sql)) die("Negaliu įrašyti laiko į DB " . $conn->error);
    //echo "Įrašyta";
    header("Location:tvarkarasciuVedimasFoto.php");

    unset($_SESSION["pav"]);
    unset($_SESSION["data"]);
    $conn->close();
    exit();
}

else if(isset($_POST['submitFour']))
{
    header("Location:tvarkarasciuVedimasFoto.php");

    unset($_SESSION["pav"]);
    unset($_SESSION["data"]);
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
		</tr>";

    while($row = $result->fetch_assoc())
    {
        echo "<tr>
		<td>".$row['FilmID']."</td>
		<td>".$row['FilmName']."</td>
		<td>".$row['FilmTime']."</td>
		<td>".$row['FilmPrice']."</td>
		</tr>";
    }
    //echo "</table>";
    $conn->close();
    ?>
</table>
<div class="container">
    <form
        method='POST'>
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
        <div class="form-group col-sm-3">
            <label for="FilmName" class="control-label">Filmo pavadinimas:</label>
            <textarea name='FilmName' class="form-control input-sm" required></textarea>
        </div>

        <div class="form-group col-sm-3">
            <label for="FilmTime" class="control-label">Filmo trukmė:</label>
            <textarea name='FilmTime' class="form-control input-sm" required></textarea>
        </div>

        <div class="form-group col-sm-3">
            <label for="FilmPrice" class="control-label">Filmo bilieto kaina:</label>
            <textarea name='FilmPrice' class="form-control input-sm" required></textarea>
        </div>
        <!--
        <div class="form-group col-sm-3">
            <label for="FilmDate" class="control-label">Filmo rodymo data</label>
            <input type="datetime-local" id="FilmDate" name="FilmDate">
        </div>
        -->

        <div class="form-group col-sm-3">
            <label for="FilmFoto" class="control-label">Filmo afiša:</label>
            <input type="file" id="FilmFoto" name="FilmFoto" accept="image/png, image/jpeg" required>
        </div>

        <div class="form-group col-sm-12">
            <input type='submit' name='submitOne' value='Siųsti' class="btnbtn-default">
        </div>
    </form>
</div>

<div class="container">
    <form
            method='POST'>
        <div class="form-group col-sm-3">
            <?php
            /*
            $db=mysqli_connect($server, $user, $password, $dbname);
            $sql = "SELECT FilmName,FilmID "
                . "FROM " . $lentele . " ORDER BY FilmID DESC, FilmName";
            $result = mysqli_query($db, $sql);
            if (!$result || (mysqli_num_rows($result) < 1))
            {
                echo "Klaida skaitant lentelę film"; exit;
            }
            ?>
            <label for="filmai">Filmas:</label>
            <input list="pavadinimai" name="filmai" id="pavadinimas">
            <datalist id="pavadinimai">
            <?php
                while ($row = mysqli_fetch_assoc($result))
                {
                    $filmai= $row['FilmName'];
                    echo "<option value='".$filmai."'</option>";
                }
            ?>

            </datalist>
            <?php
            */
            ?>

            <?php
            if(empty($_SESSION['pav']) && empty($_SESSION['data']))
            {
                $db=mysqli_connect($server, $user, $password, $dbname);
                $sql = "SELECT FilmName,FilmID "
                    . "FROM " . $lentele . " ORDER BY FilmID DESC, FilmName";
                $result = mysqli_query($db, $sql);
                if (!$result || (mysqli_num_rows($result) < 1))
                {
                    echo "Klaida skaitant lentelę film"; exit;
                }
                echo "<label for='filmai' class='control-label'>Filmas:</label>";
                echo "<select name='filmai' class='form-control input-sm' style='width:200px;'>";
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo "<option value='".$row['FilmName']."'>".$row['FilmName']."</option>";
                }
                echo "</select>";

                echo "</div>";
                echo "<br>";
                echo " <div class='form-group col-sm-3'>";
                    echo " <label for='data' class='control-label'>Filmo rodymo data:</label><br>";
                    echo " <input type='date' id='data' name='data' required>";
                    echo " </div>";
                echo "  <br>";


                echo "<div class='form-group col-sm-3'>";
                    echo "<input type='submit' name='submitTwo' value='Rasti laisvus laikus' class='btnbtn-default'>";
                echo "</div>";
                echo "<br>";
            }

            if(!empty($_SESSION['pav']) && !empty($_SESSION['data'])) {
                echo "<div class='form-group col-sm-12'>";
                echo "<h4>Filmo pavadinimas: {$_SESSION['pav']}</h4>";
                echo "<h4>Filmo data: {$_SESSION['data']}</h4>";
                echo "</div>";


                $data = $_SESSION['data'];

                $db = mysqli_connect($server, $user, $password, $dbname);
                $sql = "SELECT filmoValanda FROM schedule WHERE filmoDiena = '$data'";
                $result = mysqli_query($db, $sql);

                if ((mysqli_num_rows($result) > 3))
                {
                    echo "<h4 class='form-group col-sm-12'>Šia dieną visi laikai užimti</h4>";
                    echo "<div class='form-group col-sm-3'>";
                    echo "<input type='submit' name='submitFour' value='Grįžti' class='btnbtn-default'>";
                    echo "</div>";

                }
                else {
                    $valandosKint = array('10:00:00', '13:00:00', '16:00:00', '19:00:00',);
                    while($row = $result->fetch_assoc())
                    {
                        $valanda = $row['filmoValanda'];
                        if (($key = array_search($valanda, $valandosKint)) !== false)
                        {
                            unset($valandosKint[$key]);
                        }
                    }
                    //print_r( $valandosKint);
                    echo "<div class='form-group col-sm-3'>";
                    echo "<label for='laikas' class='control-label'>Laisvi laikai</label>";
                    echo "<select name='laikas'  class='form-control' style='width:200px;'>";
                    foreach ($valandosKint as $valanda)
                    {
                        //echo $valanda;
                        if($valanda == '10:00:00')
                            echo "<option value='10:00'>10h</option>";
                        else if($valanda == '13:00:00')
                            echo "<option value='13:00'>13h</option>";
                        else if($valanda == '16:00:00')
                            echo "<option value='16:00'>16h</option>";
                        else if($valanda == '19:00:00')
                            echo "<option value='19:00'>19h</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "<br>";

                    echo "<div class='form-group col-sm-3'>";
                    echo "<input type='submit' name='submitThree' value='Siųsti' class='btnbtn-default'>";
                    echo "</div>";


                }
            }
            /*
             $valandosKint = array('10:00:00', '13:00:00', '16:00:00', '19:00:00',);
                    while($row = $result->fetch_assoc())
                    {
                        $valanda = $row['filmoValanda'];
                        if (($key = array_search($valanda, $valandosKint)) !== false)
                        {
                            unset($valandosKint[$key]);
                        }
                    }
                    //print_r( $valandosKint);
                    eecho "<div class='form-group col-sm-3'>";
                    echo "<label for='laikas' class='control-label'>Laisvi laikai</label>";
                    foreach ($valandosKint as $valanda)
                    {
                        //echo $valanda;
                        if($valanda == '10:00:00')
                        {
                            echo "<input type='checkbox' id='laikas1' name='laikas' value=10:00'>";
                            echo "<label for='laikas1'> 10 h</label><br>";
                        }
                        else if($valanda == '13:00:00')
                        {
                            echo "<input type='checkbox' id='laikas2' name='laikas' value=13:00'>";
                            echo "<label for='laikas2'> 13 h</label><br>";
                        }
                        else if($valanda == '16:00:00')
                        {
                            echo "<input type='checkbox' id='laikas3' name='laikas' value=16:00'>";
                            echo "<label for='laikas3'> 16 h</label><br>";
                        }
                        else if($valanda == '19:00:00')
                        {
                            echo "<input type='checkbox' id='laikas4' name='laikas' value=19:00'>";
                            echo "<label for='laikas4'> 19 h</label><br>";
                        }
                    }
                    echo "</div>";
                    echo "<br>";
                }
            */
            ?>

    </form>
</div>
<!-- atvaizduoti-->
</body>
</html>