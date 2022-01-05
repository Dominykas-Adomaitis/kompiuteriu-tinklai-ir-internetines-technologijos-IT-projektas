<?php
session_start();
//var_dump( $_SESSION['user']);
$server="localhost";
$user="root";
$password="stud";
$dbname="vartvald";
$lentele="film";
// prisijungti
$connect = new mysqli($server, $user, $password, $dbname);
if ($connect->connect_error) die("Negaliu prisijungti: " . $connect->connect_error);
$_SESSION['mail_login'] = $_SESSION['umail'];
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"],
                'item_FilmDate'          =>     $_POST["filmai"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Šio filmo bilietai jau krepšelyje")</script>';
            echo '<script>window.location="uzsakymasFoto.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'               =>     $_POST["hidden_name"],
            'item_price'          =>     $_POST["hidden_price"],
            'item_quantity'          =>     $_POST["quantity"],
            'item_FilmDate'          =>     $_POST["filmai"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        unset($_SESSION["shopping_cart"]);
        //echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="uzsakymasFoto.php"</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filmų sąrašas</title>
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
<body >
Atgal į [<a href="index.php">Pradžia</a>]
<center><h3>Filmų sąrašas</h3></center>

<div class="container" style="width:1500px;">
    <?php
    //  nuskaityti
    $sql =  "SELECT * FROM $lentele";
    if (!$result = $connect->query($sql)) die("Negaliu nuskaityti: " . $connect->error);
    //print_r($sql);

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-xs-3">
                <form action="uzsakymasFoto.php?action=add&id=<?php echo $row["FilmID"]?>" method="post">
                    <div style="border:1px solid #333; background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
                        <img src="<?php echo $row["FilmFoto"]; ?>" class="img-responsive" width="250" height="300"/>
                        <br />
                        <h4 class="text-info"><?php echo $row["FilmName"]; ?></h4>
                        <h4 class="text-danger"><?php echo $row["FilmPrice"]; ?> €</h4>
                        <h4 class="text">Trukmė: <?php echo $row["FilmTime"]; ?> min</h4>
                        <h4 class="text">
                            <?php
                            $pav = $row["FilmName"];
                            //echo $pav;
                            $db = mysqli_connect($server, $user, $password, $dbname);
                            $sql = "SELECT filmoLaikas FROM schedule WHERE filmoPavadinimas = '$pav'";
                            $result1 = mysqli_query($db, $sql);


                            echo "<select name='filmai' class='form-control input-sm' style='width:180px;' required>";
                            while ($row1 = mysqli_fetch_assoc($result1))
                            {
                                echo "<option value='".$row1['filmoLaikas']."'>".$row1['filmoLaikas']." </option>";
                            }

                            echo "</select>";
                            ?></h4>
                        <input type="hidden" name="hidden_name" value="<?php echo $row["FilmName"]; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $row["FilmPrice"]; ?>" />
                        <input type="text" name="quantity" class="form-control" value="1" required/>

                        <?php if(!isset($_POST["add_to_cart"])) : ?>
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Pridėti" />
                        <?php endif; ?>

                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
    </div>

<div style="clear:both"></div>
<center><h3>Krepšelis</h3></center>
<div class="table-responsive">
    <table style="margin: 0px auto;" id="filmai">
        <tr>
            <td width="40%">Filmo pavadinimas</td>
            <td width="10%">Bilietų kiekis</td>
            <td width="20%">Bilieto kaina</td>
            <td width="20%">Laikas</td>
            <td width="15%">Visa suma</td>
            <td width="5%">Šalinti</td>
        </tr>
        <?php
        if(!empty($_SESSION["shopping_cart"]))
        {
            $total = 0;
            $total1 = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                ?>
                <tr>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td><?php echo $values["item_quantity"]; ?></td>
                    <td><?php echo $values["item_price"]; ?> €</td>
                    <td><?php echo $values["item_FilmDate"]; ?></td>
                    <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?> €</td>
                    <td><a href="uzsakymasFoto.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Šalinti</span></a></td>
                </tr>
                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>
            <tr>
                <td colspan="4" align="right">Suma</td>
                <td align="left"> <?php echo number_format($total, 2); ?> €</td>
                <td></td>
            </tr>
            <?php
        }
        $connect->close();

        ?>
    </table>
</div>
<div class="col-md-10 bg-light text-right">
    <form/>

    <?php
    if(isset($_POST["add_to_cart"]))
    {
        echo "<a href=\"uzsakymoPatvirtinimas.php?&item_price={$values['item_price']}
        &item_name={$values['item_name']}&item_quantity={$values['item_quantity']}
        &orderEmail={$_SESSION['mail_login']}&total={$total}&link=1\">Užsakyti</a> &nbsp;&nbsp;";
        //echo $_SESSION['mail_login'];
        unset($_SESSION["shopping_cart"]);
    }
    ?>
</div>

</form>
</div>
</body>
</html>
