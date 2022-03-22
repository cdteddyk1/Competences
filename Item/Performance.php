<?php require_once("../auth.php");

if(!est_connecte()){
    header("Location: /Competence/");
    exit();
}
?>
<?php
require_once("../config/config.php");
require_once("../navbarre.php");


$requete = "SELECT * FROM item_performance";
$resultat = $pdo->query($requete);


?>
<div class="card_Item">
<table>
    <tr>
        <th>N_Item</th>
        <th>Libel_Item</th>
        <th>Ensemble_Item</th>

    </tr>
<?php
while($ligne= $resultat->fetch(PDO::FETCH_NUM)){
    echo "<tr>";
    foreach ($ligne as $valeur){
        echo "<td>$valeur</td>";
    }
    echo "</tr>";
}
?>
</table>
<?php
$resultat->CloseCursor();
?>