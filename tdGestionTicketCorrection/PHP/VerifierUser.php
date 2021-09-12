<?php
include 'cnx.php';

$sql = $cnx->prepare("select loginUser,pwdUser from users where loginUser = ? and pwdUser = ?");
$sql->bindValue(1,$_POST['login']);
$sql->bindValue(2,$_POST['mdp']);
$sql->execute();

$data = $sql->fetchColumn(PDO::FETCH_ASSOC);
if($data == null)
{
    echo "1";
}
else
{
    echo "0";
}

