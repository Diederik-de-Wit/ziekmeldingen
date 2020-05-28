<?php
$host = "localhost";
$dbname = "ziekmeldopdracht";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname","$username","$password") or die("Verbinding mislukt!");

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
            <li class="menu-tv">
                <a href="ziekmeldingenMenu.php">
                    <span>Beginscherm</span>
                </a>
            </li>
            <li class="menu-mac">
                <a href="registratieformulier.php">
                    <span>Ziekmelden</span>
                </a>
            </li>
            <li class="menu-iPad">
                <a href="overzicht.php">
                    <span>Overzicht</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<br/><br/><br/><br/><br/><br/><br/>
<h1>Studenten Invoeren:</h1>
<form method="POST">
    <table>
        <thead>
        <tr>
            <th><b>Voornaam:</b></th>
            <th><b>Tussenvoegsel:</b></th>
            <th><b>Achternaam:</b></th>
            <th><b>Klas:</b></th>
            <th><b>Mentor:</b></th>
            <th><b>Ziek of Beter?:</b></th>
        </tr>
        </thead>

        <thead>
        <tr>
            <td><input type="text" placeholder="voornaam" name="voornaam"/></td>
            <td><input type="text" placeholder="tussenvoegsel" name="tussenvoegsel"/></td>
            <td><input type="text" placeholder="achternaam" name="achternaam"/></td>
            <td><input type="text" placeholder="klas" name="klas"/></td>
            <td><input type="text" placeholder="mentor" name="mentor"/></td>
            <td><input type="text" placeholder="ziek of beter" name="ZoB"/></td>
        </tr>
        </thead>
    </table>


    <ul><p><input type="submit" name="opslaan" value="Opslaan"></p></ul>
</form>

    <?php

    if(isset($_POST['opslaan']))
    {
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $klas = $_POST['klas'];
        $mentor = $_POST['mentor'];
        $ziekbeter = $_POST['ZoB'];


        $query = "INSERT INTO studenten VALUES 
                            (0, '$voornaam', '$tussenvoegsel', '$achternaam', '$klas', '$mentor', '$ziekbeter')";
        $stm = $conn->prepare($query);
        if($stm->execute()){
            echo "<h3>student toegevoegd!</h3>";
        }else echo "mislukt";

    }




    ?>

</body>