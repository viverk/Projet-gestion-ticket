<?php

include 'cnx.php';

// On vérifie le statut du user
// S'il est ADMIN on affiche tous les tickets
// Sinon on affiche que les tickets de l'utilisateur

$sql = $cnx->prepare("select nomuser, statutuser from users where idUser = ? ");
$sql->bindValue(1,$_GET['id']);
$sql->execute();
$infos = $sql->fetch(PDO::FETCH_ASSOC);

if($infos['statutuser'] === "admin")
{
    $sql = $cnx->prepare("select idTicket,nomTicket,dateTicket,niveauTicket,nomUser,prenomUser from tickets, users where tickets.idUser = users.idUser order by tickets.idTicket");
}
else
{
    $sql = $cnx->prepare("select idTicket,nomTicket,dateTicket,niveauTicket from tickets, users where tickets.idUser = users.idUser and tickets.idUser=? order by tickets.idTicket");
    $sql->bindValue(1,$_GET['id']);
}
$sql->execute();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Les tickets</title>
        <script src="../JQuery/jquery-3.1.1.min.js"></script>
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
        <script src="../Bootstrap/js/bootstrap.js"></script>
        <script src="../JS/lesFonctions.js"></script>
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        if($infos['statutuser'] === "admin")
        {
        ?>
            <p class="h1 text-danger text-center">Liste de tous les tickets</p>
        <?php
        }
        else
        {
        ?>
            <p class="h1 text-danger text-center">Liste des tickets de <?php echo $infos['nomuser']; ?></p>
        <?php
        }
        ?>
        <table class=table>
        <?php
            foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $ligne)
            {
                if($infos['statutuser'] === "admin")
                {
        ?>
                <tr>
                    <td><?php echo $ligne['nomTicket']; ?></td>
                    <td><?php echo $ligne['dateTicket']; ?></td>
                    <td><?php echo $ligne['niveauTicket']; ?></td>
                    <td><?php echo $ligne['nomUser']; ?></td>
                    <td><?php echo $ligne['prenomUser']; ?></td>
                    <td><?php echo "<input class='btn btn-success' type='button' value='Modifier' onclick=ModifierTicket(".$ligne['idTicket'].",'".$infos['statutuser']."',".$_GET['id'].")>" ?></td>
                </tr>
                <?php
                }
                else
                {
                ?>
                <tr>
                    <td><?php echo $ligne['nomTicket']; ?></td>
                    <td><?php echo $ligne['dateTicket']; ?></td>
                    <td><?php echo $ligne['niveauTicket']; ?></td>
                    <td><?php echo "<input class='btn btn-success' type='button' value='Modifier' onclick=ModifierTicket(".$ligne['idTicket'].",'".$infos['statutuser']."',".$_GET['id'].")>" ?></td>
                </tr>
                
        <?php
                }
            }
        ?>
        </table>
        <div id="divModificationTicket">
        </div>
    </body>
</html>
