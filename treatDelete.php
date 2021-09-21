<?php
    session_start();
    if(isset($_SESSION['level']) AND $_SESSION['level']=="administrateur" AND isset($_GET['id']) AND !empty($_GET['id']) AND isset($_GET['pid']) AND !empty($_GET['pid']))
    {
        require "connexion.php";
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("SELECT * FROM commentaires WHERE id=?");
        $req->execute([$id]);
        if(!$don=$req->fetch())
        {
            header("LOCATION:index.php");
        }
        $req->closeCursor();

        $delete = $bdd->prepare("DELETE FROM commentaires WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:index.php?action=produits&id=".$_GET['pid']."&deleteCom=success");


    }else{
        header("LOCATION:index.php");
    }
