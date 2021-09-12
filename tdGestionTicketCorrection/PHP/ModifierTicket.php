<?php
include 'cnx.php';

$sql = $cnx->prepare("select nomTicket,dateTicket from tickets where idTicket = ? ");
$sql->bindValue(1,$_GET['idTicket']);
$sql->execute();
$infos = $sql->fetch(PDO::FETCH_ASSOC);

// Il faut récupérer les infos suivantes
// Le nom et la date du ticket
echo "<form method='get' action='UpdateTicket.php'>";
echo "<input name='statut' type='text' hidden='' value='".$_GET['statut']."'>";
echo "<input name='idTicket' type='text' hidden='' value='".$_GET['idTicket']."'>";
echo "<input name='idUser' type='text' hidden='' value='".$_GET['idUser']."'>";
echo "<table class=table>";
echo "<tr>";
echo "<td><input name='nom' class='form-control' type='text' value='".$infos['nomTicket']."'></td>";
echo "<td><input name='date' class='form-control' type='date' value='".$infos['dateTicket']."'></td>";

// Les utilisateurs
if($_GET['statut'] === 'admin')
{
    $sql = $cnx->prepare("select iduser,nomuser from users");
    $sql->execute();
    echo "<td><select class='form-control' name='lstUsers'>";
    foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $ligne)
    {
        echo "<option value='".$ligne['iduser']."'>".$ligne['nomuser']."</option>";
    }
    echo "</select></td>";
}

// Les différents états
echo "<td><select class='form-control' name='lstEtats'>";
echo "<option value='Mineur'>Mineur</option>";
echo "<option value='Majeur'>Majeur</option>";
echo "<option value='Bloquant'>Bloquant</option>";
echo "</select></td>";
echo "<td><input class='btn btn-success' type='submit' value='Modifier'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";