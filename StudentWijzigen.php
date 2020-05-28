<?php

$servername = "localhost";
$username = "root";
$password = "";


try {
    $conn = new PDO("mysql:host=$servername;dbname=ziekmeldopdracht", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>
<header>
    <link rel="stylesheet" href="cssZiekmelden.css">

    <title>Ziekmelden</title>
</header>
<body>

<nav>
    <div class="menu-container">
        <ul class="menu">
            <li class="menu-apple">
                <a href="#">
                    <i class="fa fa-apple apple-icon" aria-hidden="true"></i>
                </a>
            </li>
            <li class="menu-mac">
                <a href="overzicht.php">
                    <span>Terug</span>
                </a>
            </li>
        </ul>
    </div>
</nav>




<table>
    <thead>
    <?php

    if(isset($_GET['vnr']))
    {
        $sid = $_GET['vnr'];
        $query = "SELECT * FROM studenten WHERE sid = '".$sid."'";
        $stmt = $conn->prepare($query);
        if($stmt->execute()){

            $rij = $stmt->fetch(PDO::FETCH_OBJ);
            ?>

            <table>
                <thead>
                <br/><br/><br/><br/><br/><br/><br/>
                <tr>
                    <center><h1>Student beter melden:</h1></center>
                    <th><b>id:</b></th>
                    <th><b>Voornaam:</b></th>
                    <th><b>Tussenvoegsel:</b></th>
                    <th><b>Achternaam:</b></th>
                    <th><b>Klas:</b></th>
                    <th><b>Mentor:</b></th>
                    <th><b>( Dit veld moet u weizigen naar: "beter" als de student beter is ) <br/> Beter?</b></th>
                </tr>
                </thead>

                <thead>
                <tr>
                    <form method="POST">
                        <td><input type="text" name="id" readonly value="<?php echo $rij->sid; ?>"/></td>
                        <td><input type="text" name="voornaam" readonly value="<?php echo $rij->voornaam; ?>"/></td>
                        <td><input type="text" name="tussenvoegsel" readonly value="<?php echo $rij->tussenvoegsel; ?>"/></td>
                        <td><input type="text" name="achternaam" readonly value="<?php echo $rij->achternaam; ?>"/></td>
                        <td><input type="text" name="klas" readonly value="<?php echo $rij->klas; ?>"/></td>
                        <td><input type="text" name="mentor" readonly value="<?php echo $rij->mentor; ?>"/></td>
                        <td><input type="text" name="ziekbeter" value="<?php echo $rij->ziekbeter; ?>"/></td>
            </table>
    <center><br/><input type="submit" name="btnUpdate" value="UPDATE"/></center>
                    </form>
                </tr>
                </thead>


            <?php

        }

    }else Header("Location: OnTheFlyOverzicht.php");

    if(isset($_POST['btnUpdate']))
    {
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $klas = $_POST['klas'];
        $mentor = $_POST['mentor'];
        $ziekbeter = $_POST['ziekbeter'];

        $query = "UPDATE studenten SET voornaam = '$voornaam', tussenvoegsel = '$tussenvoegsel', achternaam = '$achternaam', klas = '$klas', mentor = '$mentor', ziekbeter = '$ziekbeter' WHERE sid = $sid";

        $stmt = $conn->prepare($query);

        if($stmt->execute())
        {
            echo "<h3>Student beter gemeld, u moet hier onder nog wat belangrijke informatie invullen.</h3>";
        }else echo "failed to update!";
    }


    ?>
    </thead>
</table>


<br/><br/><br/>
<form method="POST">
    <table>
        <center><h2>Vul dit veld in als u een student beter heeft gemeld :</h2></center>
        <thead>
        <tr>
            <th><b>sid ( Het id van de student kunt u hierboven zien ):</b></th>
            <th><b>Vanaf wanneer was de student ziek:</b></th>
            <th><b>Tot wanneer was de student ziek:</b></th>
            <th><b>opmerking:</b></th>
        </tr>
        </thead>

        <thead>
        <tr>
            <td><input type="text" placeholder="student id" name="sid"/></td>
            <td><input type="date" placeholder="vanaf" name="vanaf"/></td>
            <td><input type="date" placeholder="tot" name="tot"/></td>
            <td><input type="text" placeholder="opmerking" name="opmerking"/></td>
        </tr>
        </thead>
    </table>


    <center><br/><input type="submit" name="save" value="OPSLAAN"></center>

</form>

<?php
$host = "localhost";
$dbname = "ziekmeldopdracht";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname","$username","$password") or die("Verbinding mislukt!");


if(isset($_POST['save']))
{
    $sid = $_POST['sid'];
    $VanafWanneer = $_POST['vanaf'];
    $TotWanneer = $_POST['tot'];
    $opmerking = $_POST['opmerking'];


    $query = "INSERT INTO ziek VALUES 
                            (0, '$sid', '$VanafWanneer', '$TotWanneer', '$opmerking')";
    $stm = $conn->prepare($query);
    if($stm->execute()){
        echo "<h3>Beter gemeld! U kunt het nakijken bij overzicht.</h3>";
    }else echo "mislukt";

}




?>



</body>