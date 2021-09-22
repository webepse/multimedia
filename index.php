<?php
    session_start();
    require "connexion.php";
    if(isset($_GET['action']))
    {
        $menu = [
            "home" => "home.php",
            "smartphone" => "smartphone.php",
            "jeux"=> "jeux.php",
            "produits"=>"produit.php",
            "inscription"=>"inscription.php",
            "connexion"=>"connex.php",
            "deconnexion"=>"deco",
            "user"=>"user.php",
            "update"=>"updateCom.php"
        ];
        if(array_key_exists($_GET['action'],$menu))
        {
            if($_GET['action']=="produits")
            {
                if(isset($_GET['id']) AND !empty($_GET['id']))
                {
                    $id = htmlspecialchars($_GET['id']);
                    $produit = $bdd->prepare("SELECT * FROM produits WHERE id=?");
                    $produit->execute([$id]);
                    if(!$donProd = $produit->fetch())
                    {
                        header("HTTP/1.1 404 Not Found");
                        $action = "404.php"; 
                    }else{
                        $action = $menu['produits']; 
                    }
                    $produit->closeCursor();
                }else{
                    header("HTTP/1.1 404 Not Found");
                    $action = "404.php"; 
                }
            }elseif($_GET['action']=="user"){
                if(isset($_GET['id']) AND !empty($_GET['id']))
                {
                    $id = htmlspecialchars($_GET['id']);
                    $user = $bdd->prepare("SELECT * FROM membre WHERE id=?");
                    $user->execute([$id]);
                    if(!$donUser = $user->fetch())
                    {
                        header("HTTP/1.1 404 Not Found");
                        $action = "404.php"; 
                    }else{
                        $action = $menu['user']; 
                    }
                    $user->closeCursor();
                }else{
                    header("HTTP/1.1 404 Not Found");
                    $action = "404.php"; 
                }
            }
            elseif($_GET['action']=="deconnexion"){
                session_destroy();
                header("LOCATION:index.php");
            }
            elseif($_GET['action']=="update"){
                if(isset($_GET['id']) AND !empty($_GET['id']))
                {
                    $comId=htmlspecialchars($_GET['id']);
                    $reqCom = $bdd->prepare("SELECT * FROM commentaires WHERE id=?");
                    $reqCom->execute([$comId]);
                    if(!$donIdCom = $reqCom->fetch())
                    {
                        header("HTTP/1.1 404 Not Found");
                        $action = "404.php";
                    }else{
                        if($_SESSION['id']==$donIdCom['id_membre'])
                        {
                            $action= $menu['update'];
                        }else{
                            header("HTTP/1.1 404 Not Found");
                            $action = "404.php";
                        }
                    }
                }else{
                    header("HTTP/1.1 404 Not Found");
                    $action = "404.php";
                }
            }else{
                $action = $menu[$_GET['action']]; 
            }
        }else{
            header("HTTP/1.1 404 Not Found");
            $action = "404.php";
        }

    }else{
        $action="home.php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/baguetteBox.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- https://github.com/feimosi/baguetteBox.js -->
    <script src="assets/baguetteBox.min.js"></script>
    <title>Multimédia</title>
    <script>
        window.addEventListener("load",()=>{
            baguetteBox.run('.image')
        })
    </script>
</head>
<body>
    <header>
        <div id="logo">Multimedia</div>
        <form action="#">
            <div class="form-group">
                <input type="text" id="search" name="search" placeholder="Votre recherche">
                <input type="submit" value="Rechercher">
            </div>
        </form>
        <div id="connexion">
            <?php
                if(!isset($_SESSION['login']))
                {
            ?>
                <a href="index.php?action=inscription">Inscription</a>
                <a href="index.php?action=connexion">Connexion</a>

            <?php    
                }else{
            ?>
                <a href="index.php?action=deconnexion">Déconnexion</a>
            <?php
                }
            ?>    
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?action=jeux">Jeux Vidéo</a></li>
                <li><a href="index.php?action=smartphone" >Smartphone</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
            include("pages/".$action);
        ?>

    </main>
    <footer>
        <p>&copy; Copyright EPSE 2021</p>
    </footer>
</body>
</html>