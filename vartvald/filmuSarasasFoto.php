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
<<br />
<div class="container" style="width:1500px;">
    <?php
    $query = "SELECT * FROM $lentele";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-xs-3">
                <form method="post" action="filmuSarasasFoto.php?action=add&id=<?php echo $row["FilmID"]; ?>">
                    <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                        <img src="<?php echo $row["FilmFoto"]; ?>" class="img-responsive" width="250" height="300" /><br />
                        <h4 class="text-info"><?php echo $row["FilmName"]; ?></h4>
                        <h4 class="text-danger">Kaina: <?php echo $row["FilmPrice"]; ?> €</h4>
                        <h4 class="text">Trukmė: <?php echo $row["FilmTime"]; ?> min</h4>
                        <h4 class="text">
                            <?php
                            $pav = $row["FilmName"];
                            //echo $pav;
                            $db = mysqli_connect($server, $user, $password, $dbname);
                            $sql = "SELECT filmoLaikas FROM schedule WHERE filmoPavadinimas = '$pav'";
                            $result1 = mysqli_query($db, $sql);


                            echo "<select name='filmai' class='form-control input-sm' style='width:180px;'>";
                            while ($row1 = mysqli_fetch_assoc($result1))
                            {
                                echo "<option value='".$row1['filmoLaikas']."'>".$row1['filmoLaikas']."</option>";
                            }

                            echo "</select>";

                            ?></h4>
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</body>
</html>