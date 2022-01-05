<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";

        //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        if ($userlevel == $user_roles["Vartotojas"])
        {
            //echo '<div class="nav-links" >';
            echo "<a href=\"uzsakymasFoto.php\">Užsisakyti bilietus</a> &nbsp;&nbsp;";
            //echo '</div>';
        }

        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles["Administratorius"] )
        {
            echo "<a href=\"admin.php\">Administratoriaus sąsaja</a> &nbsp;&nbsp;";
            echo "<a href=\"tvarkarasciuVedimasFoto.php\">Tvarkaraščio pildymas</a> &nbsp;&nbsp;";
            echo "<a href=\"uzsakymasFoto.php\">Užsisakyti bilietus</a> &nbsp;&nbsp;";
            echo "<a href=\"adminStats.php\">Užsakymai</a> &nbsp;&nbsp;";
            echo "<a href=\"operacijaDirektorius.php\">Statistika</a> &nbsp;&nbsp;";

        }

        if ($userlevel == $user_roles["Direktorius"] )
        {
            echo "<a href=\"operacijaDirektorius.php\">Statistika</a> &nbsp;&nbsp;";
            echo "<a href=\"uzsakymasFoto.php\">Užsisakyti bilietus</a> &nbsp;&nbsp;";
        }

        echo "<a href=\"filmuSarasasFoto.php\">Filmų tvarkaraštis</a> &nbsp;&nbsp;";

        if ($_SESSION['user'] != "guest")
            echo "<a href=\"useredit.php\">Redaguoti paskyrą</a> &nbsp;&nbsp;";

        echo "<a href=\"logout.php\">Atsijungti</a>";

      echo "</td></tr></table>";
?>       
    
 