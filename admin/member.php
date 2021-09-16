<?php
    session_start();
    if(!isset($_SESSION['level']) OR $_SESSION['level']!="administrateur")
    {
        header("LOCATION:index.php");
    }
    require "../connexion.php";
    


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Admin Multimédia</title>
</head>
<body>
    <div class="container">
        <h1>Gestion des membres</h1>
        <a href="dashboard.php" class="btn btn-secondary my-2">Retour</a>
        <?php
          

            if(isset($_GET['update']))
            {
                echo "<div class='alert alert-warning'>le membre n°".$_GET['id']." a bien été modifié</div>";
            }

            if(isset($_GET['delete']))
            {
                echo "<div class='alert alert-danger'>le membre n°".$_GET['id']." a bien été supprimé</div>";
            }

        ?>
       
        <table class="table table-striped">
           <tr>
               <th>id</th>
               <th>login</th>
               <th>E-mail</th>
               <th>Level</th>
               <th class="text-center">Action</th>
           </tr>
           <?php
                $req = $bdd->query("SELECT * FROM membre");
                while($don = $req->fetch())
                {
                    echo "<tr>";
                        echo "<td>".$don['id']."</td>";
                        echo "<td>".$don['login']."</td>";
                        echo "<td>".$don['mail']."</td>";
                        echo "<td>".$don['level']."</td>";
                        echo "<td class='text-center'>";
                            echo "<a href='updateMember.php?id=".$don['id']."' class='btn btn-warning mx-2'>Modifier</a>";
                            if($_SESSION['login']!=$don['login'])
                            {
                                echo "<a href='deleteMember.php?id=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
                            }
                        echo "</td>";
                    echo "</tr>";    
                }
                $req->closeCursor();
           ?>
       </table>
    </div>
</body>
</html>