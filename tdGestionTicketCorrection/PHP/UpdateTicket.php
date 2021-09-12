<?php
include 'cnx.php';
if($_GET['statut'] === "admin")
{
    $sql = $cnx->prepare("update tickets set nomTicket ='".$_GET['nom']."',dateTicket = '".$_GET['date']."', niveauTicket = '".$_GET['lstEtats']."', idUser = ".$_GET['lstUsers']." where idTicket =".$_GET['idTicket']);
//    $sql = $cnx->prepare("update tickets set nomTicket = ? , dateTicket = ? , niveauTicket = ? , idUser = ? where idTicket = ?");
//    $sql->bindValue(1,$_GET['nom'], PDO::PARAM_STR);
//    $sql->bindValue(2,$_GET['date'], PDO::PARAM_STR);
//    $sql->bindValue(3,$_GET['lstEtats'], PDO::PARAM_INT);
//    $sql->bindValue(4,$_GET['lstUsers'], PDO::PARAM_INT);
//    $sql->bindValue(5,$_GET['id'], PDO::PARAM_INT);
}
else
{
      $sql = $cnx->prepare("update tickets set nomTicket ='".$_GET['nom']."', dateTicket = '".$_GET['date']."', niveauTicket = '".$_GET['lstEtats']."' where idTicket =".$_GET['idTicket']);
//    $sql = $cnx->prepare("update tickets set nomTicket = ? , dateTicket = ? , niveauTicket = ? where idTicket = ?");
//    $sql->bindValue(1,$_GET['nom'], PDO::PARAM_STR);
//    $sql->bindValue(2,$_GET['date'], PDO::PARAM_STR);
//    $sql->bindValue(3,$_GET['lstEtats'], PDO::PARAM_INT);
//    $sql->bindValue(4,$_GET['id'], PDO::PARAM_INT);
}
$sql->execute();

header('Location:GetAllTickets.php?id='.$_GET['idUser']);