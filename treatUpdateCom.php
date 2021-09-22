<?php
    session_start();
    if(isset($_SESSION['id']) AND isset($_GET['id']) AND !empty($_GET['id']))
    {
        $id=htmlspecialchars($_GET['id']);
        require "connexion.php";
        $req=$bdd->prepare("SELECT * FROM commentaires WHERE id=?");
        $req->execute([$id]);
        if(!$don=$req->fetch())
        {
            $req->closeCursor();
            header("LOCATION:index.php?err=2");
        }else{
            $req->closeCursor();
            if($_SESSION['id'] == $don['id_membre'])
            {
                if(isset($_POST['com']))
                {
                    $texte = htmlspecialchars($_POST['com']);
                    $update = $bdd->prepare("UPDATE commentaires SET texte=:txt WHERE id=:id");
                    $update->execute([
                        "txt"=>$texte,
                        "id"=>$id
                    ]);
                    header("LOCATION:index.php?action=produits&id=".$don['id_produit']);
                }else{
                    header("LOCATION:index.php?err=4");
                }
            }else{
                header("LOCATION:index.php?err=3");
            }
        }
    }else{
        header("LOCATION:index.php?err=1");
    }
  

?>