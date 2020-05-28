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

<br/><br/><br/>

<h2>Studenten Ziek</h2>
    <table>
    <thead>
    <tr>
        <th>sid</th>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Klas</th>
        <th>Mentor</th>
        <th>Ziek of Beter?</th>
    </tr>
    </thead>


    <?php

    $query = "SELECT * FROM studenten WHERE ziekbeter = 'ziek'";
    $stm = $conn->prepare($query);
    if($stm->execute()){

        $studenten = $stm->fetchAll(PDO::FETCH_OBJ);

        foreach($studenten as $stud){

            echo "<tr>";
            echo "<td>$stud->sid</td>";
            echo "<td>$stud->voornaam</td>";
            echo "<td>$stud->tussenvoegsel</td>";
            echo "<td>$stud->achternaam</td>";
            echo "<td>$stud->klas</td>";
            echo "<td>$stud->mentor</td>";
            echo "<td>$stud->ziekbeter</td>";
            echo "</tr>";

        }
    }
    ?></table>
<br/><br/>

<center><h3>Klik hier onder op het student nummer, om die studenten beter te melden:</h3></center>
<?php

$query = "SELECT * FROM studenten";
$project = $conn->prepare($query);

if($project->execute()){
    $res = $project->fetchAll(PDO::FETCH_OBJ);
    foreach($res as $rij)
    {
        echo "<center>";
        echo "<h2>";
        echo "<a href='StudentWijzigen.php?vnr=".$rij->sid."'>$rij->sid</a>";
        echo "</h2>";
        echo "</center>";
    }
}

?>

<h2>Studenten Beter</h2>
    <table>
        <thead>
        <tr>
            <th>sid</th>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Klas</th>
            <th>Mentor</th>
            <th>Ziek of Beter?</th>
        </tr>
        </thead>
    <?php

    $query = "SELECT * FROM studenten WHERE ziekbeter = 'beter'";
    $stm = $conn->prepare($query);
    if($stm->execute()){

        $studenten = $stm->fetchAll(PDO::FETCH_OBJ);

        foreach($studenten as $stud){

            echo "<tr>";
            echo "<td>$stud->sid</td>";
            echo "<td>$stud->voornaam</td>";
            echo "<td>$stud->tussenvoegsel</td>";
            echo "<td>$stud->achternaam</td>";
            echo "<td>$stud->klas</td>";
            echo "<td>$stud->mentor</td>";
            echo "<td>$stud->ziekbeter</td>";
            echo "</tr>";

        }
    }
    ?>
    </table>
<br/><br/>


<h2>Zieke periode</h2>
    <table>
    <thead>
    <tr>
        <th>sid</th>
        <th>Vanaf Wanneer?</th>
        <th>Tot Wanneer?</th>
        <th>Opmerking</th>
    </tr>
    </thead>
    <?php

    $query = "SELECT * FROM ziek ";
    $stm = $conn->prepare($query);
    if($stm->execute()){

        $studenten = $stm->fetchAll(PDO::FETCH_OBJ);

        foreach($studenten as $stud){

            echo "<tr>";
            echo "<td>$stud->sid</td>";
            echo "<td>$stud->VanafWanneer</td>";
            echo "<td>$stud->TotWanneer</td>";
            echo "<td>$stud->opmerking</td>";
            echo "</tr>";

        }
    }
    ?>
    </table>
<br/><br/><br/><br/><br/><br/>
</body>