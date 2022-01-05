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
                    'item_quantity'          =>     $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
            }
            else
            {
                echo '<script>alert("Item Already Added")</script>';
                echo '<script>window.location="operacija1.php"</script>';
            }
        }
        else
        {
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }

    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="operacija1.php"</script>';
                }
            }
        }
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
		<center><h3>Filmų sąrašas</h3></center>

<table style="margin: 0px auto;" id="filmai">
<?php	
//  nuskaityti 
	$sql =  "SELECT * FROM $lentele";
	if (!$result = $connect->query($sql)) die("Negaliu nuskaityti: " . $connect->error);
	//print_r($sql);

	// parodyti
	
	//echo "<table border=\"1\">";
	echo "<tr>
		<td>ID</td>
		<td>Pavadinimas</td>
		<td>Ilgis (min)</td>
		<td>Kaina</td>
		<td>Data</td>
		<td>Kiekis</td>
		<td>Krepšelis</td>
		</tr>";
	
	while($row = $result->fetch_assoc()) 
	{
	    ?>
        <div>
            <form action="operacija1.php?action=add&id=<?php echo $row["FilmID"]?>" method="post">
                <tr>
                <td><?php echo $row["FilmID"]; ?></td>
                <td><?php echo $row["FilmName"]; ?></td>
                <td><?php echo $row["FilmTime"]; ?></td>
                <td><?php echo $row["FilmPrice"]; ?></td>
                <td><?php echo $row["FilmDate"]; ?></td>
                    <input type="hidden" name="hidden_name" value="<?php echo $row["FilmName"]; ?>" />
                    <input type="hidden" name="hidden_price" value="<?php echo $row["FilmPrice"]; ?>" />
                <td>
                    <input type="text" name="quantity" class="form-control" value="1" />
                </td>
                <td>
                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Pridėti" />
                </td>


                </tr>
            </form>
        </div>
        <?php
	}
	//echo "</table>";
	//$connect->close();
?>	
</table>
        <div style="clear:both"></div>
        <center><h3>Krepšelis</h3></center>
        <div class="table-responsive">
            <table style="margin: 0px auto;" id="filmai">
                <tr>
                    <td width="40%">Filmo pavadinimas</td>
                    <td width="10%">Bilietų kiekis</td>
                    <td width="20%">Bilieto kaina</td>
                    <td width="15%">Visa suma</td>
                    <td width="5%">Action</td>
                </tr>
                <?php
                if(!empty($_SESSION["shopping_cart"]))
                {
                    $total = 0;
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    {
                        ?>
                        <tr>
                            <td><?php echo $values["item_name"]; ?></td>
                            <td><?php echo $values["item_quantity"]; ?></td>
                            <td>$ <?php echo $values["item_price"]; ?></td>
                            <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                            <td><a href="operacija1.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                        </tr>
                        <?php
                        $total = $total + ($values["item_quantity"] * $values["item_price"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" align="right">Suma</td>
                        <td align="right">$ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <div class="col-md-10 bg-light text-right">
        <form action="pvz.php" >
            <input type="submit" name="uzsakyti" style="margin-top:5px;", class="btn btn-success" value="Užsakyti" />
        </form>
        </div>
	</body>
</html>