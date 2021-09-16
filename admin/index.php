<?php
    session_start();
    if(isset($_SESSION['level']) AND $_SESSION['level']=="administrateur")
    {
        header("LOCATION:dashboard.php");
    }

    if(isset($_POST['username']))
    {
      
        if(empty($_POST['username']) OR empty($_POST['password']))
        {
            $err="Veuillez remplir correctement le formulaire";
        }
        else{
            require "../connexion.php";
            $user = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];
            $req = $bdd->prepare("SELECT * FROM membre WHERE login=?");
            $req->execute([$user]);
            if(!$don= $req->fetch())
            {
                $err="Votre login n'est pas correct";
            }else{
                if(password_verify($password,$don['mdp']))
                {
                    if($don['level']!="administrateur")
                    {
                        $err="Vous n'avez pas le niveau";
                    }else{
                        $_SESSION['login']=$don['login'];
                        $_SESSION['level']=$don['level'];
                        header("LOCATION:dashboard.php");
                    }
                }
                else{
                    $err="Votre mot de passe n'est pas correct";
                }
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
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
        <div class="row my-5">
            <div class="col-4 offset-4">
                <h1>Administration Multimédia</h1>
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="username" name="username" placeholder="Login" class="form-control my-3">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control my-3">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Connexion" class="btn btn-primary">
                    </div>
                </form>
                <?php
                    if(isset($err))
                    {
                        echo '<div class="alert alert-danger">'.$err.'</div>';
                    }

                ?>
            </div>
        </div>
    </div>
</body>
</html>