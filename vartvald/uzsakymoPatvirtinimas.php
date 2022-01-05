<?php
//var_dump( $_SESSION['user']);
$server="localhost";
$user="root";
$password="stud";
$dbname="vartvald";
$lentele="filmorder";


// prisijungti
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
if($_GET !=null)
{
    $ticketPrice = $_GET['item_price'];
    $orderFilmName = $_GET['item_name'];
    $ticketCount = $_GET['item_quantity'];
    $orderEmail = $_GET['orderEmail'];
    $orderTotal = $_GET['total'];
    $sql = "INSERT INTO $lentele (ticketPrice, orderFilmName, ticketCount, orderEmail, orderTotal) 
             VALUES ('$ticketPrice', '$orderFilmName', '$ticketCount', '$orderEmail', '$orderTotal')";
    if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
    //echo "Įrašyta";
    header("Location:uzsakymoPatvirtinimas.php");
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
        <body>
        Atgal į [<a href="index.php">Pradžia</a>]
        <title>Užsakymo patvirtinimas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <div class="jumbotron text-center">
            <form method='post'>
                <h1>Jūsų užsakymas priimtas</h1>
                <p>Užsakymo patvirtinimas išsiųstas į nurodytą elektroninį paštą.</p>
            </form>
        </div>
        <?php
        ?>
        </body>
</html>