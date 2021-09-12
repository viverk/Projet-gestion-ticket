<!DOCTYPE html>
<html>
    <head>
        <title>Gestion tickets</title>
        <script type="text/javascript" src="JS/lesFonctions.js"></script>
        <script type="text/javascript" src="JQuery/jquery-3.1.1.min.js"></script>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="Bootstrap/css/bootstrap-theme.css" rel="stylesheet">    
    </head>
    <body>
        <form action="index.php" method="post">
        <?php
        if(isset($_POST['btnEnvoyer']))
        {
            include 'PHP/cnx.php';
            $sql = $cnx->prepare("select idUser,loginUser,pwdUser from users where loginUser = ? and pwdUser = ?");
            $sql->bindValue(1,$_POST['txtLogin']);
            $sql->bindValue(2,$_POST['txtMdp']);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            if($data == NULL)
            {
                echo "<div id='divErreur' class='alert alert-warning'>";
                    echo "<h3>Identifiants incorrects</h3>";
                echo "</div>";
            }
            else
            {
                header('Location:PHP/GetAllTickets.php?id='.$data[0]['idUser']);
            }
        }
    ?>
        <h1>Gestion tickets ==> connexion</h1>
            <table class=".table-bordered">
                <tr>
                    <td><img alt="" src="Images/Securite.jpg"/></td>
                    <td class="col-lg-1"></td>
                    <td>
                        <label class="form-control">Login</label><br />
                        <input class="form-control" type="text" name="txtLogin"><br /><br/>
                        <label class="form-control">Mot de passe</label><br />
                        <input class="form-control" type="text" name="txtMdp"><br /><br/>
                        <input class="btn btn-success" style="width: 180px" type="submit" value="Envoyer" name="btnEnvoyer">   
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>