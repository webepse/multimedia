<?php
    session_start();
    if(!isset($_SESSION['level']) OR $_SESSION['level']!="administrateur")
    {
        header("LOCATION:index.php");
    }
    if(isset($_GET['id']) OR !empty($_GET['id']))
    {
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:product.php");
    }

    require "../connexion.php";
    $req = $bdd->prepare("SELECT * FROM membre WHERE id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:product.php");
    }
    $req->closeCursor();

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
        <h1>Modifier <?= $don['login'] ?></h1>
        <a href="member.php" class="btn btn-secondary my-3">Retour</a>
        <div class="row">
            <form action="treatmentUpdateMember.php?id=<?= $don['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="login">Login: </label>
                    <input type="text" id="login" name="login" class="form-control" value="<?= $don['login'] ?>">
                </div> 
                
                <div class="form-group">
                    <label for="password">Mot de passe (facultatif)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirmer le mot de passe</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"> 
                </div>
               
                <div class="form-group">
                    <label for="level">Level: </label>
                    <select name="level" id="level" class="form-control">
                        <?php
                            if($don['level']=="administrateur")
                            {
                                echo '<option value="administrateur" selected>Administrateur</option>';
                                echo '<option value="membre">Membre</option>';
                            }else{
                                echo '<option value="administrateur">Administrateur</option>';
                                echo '<option value="membre" selected>Membre</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Modifier" class="btn btn-warning my-2">
                </div>

            </form>
        </div>
    </div>
</body>
</html>