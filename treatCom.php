<?php 
    session_start();
    if(isset($_SESSION['id']))
    {
        if(isset($_GET['id']))
        {
            $id=htmlspecialchars($_GET['id']);
        }else{
            header("LOCATION:index.ph?err=2");
        }

        require "connexion.php";
        $produit = $bdd->prepare("SELECT * FROM produits WHERE id=?");
        $produit->execute([$id]);
        if(!$don=$produit->fetch())
        {
            header("LOCATION:index.php?err=3");
        }

        if(isset($_POST['com']))
        {
            $err=0;
            if(empty($_POST['com']))
            {
                $err=1;
            }else{
                $com = htmlspecialchars($_POST['com']);
            }

            if($err==0)
            {
                
                $insert=$bdd->prepare("INSERT INTO commentaires(id_membre,id_produit,texte,date) VALUES(:membre, :produit, :txt, NOW())");
                $insert->execute([
                    "membre"=>$_SESSION['id'],
                    "produit"=>$id,
                    "txt"=>$com
                ]);
                $insert->closeCursor();
                header("LOCATION:index.php?action=produits&id=".$id);

            }else{
                header("LOCATION:index.php?action=produits&id=".$id."&err=".$err);
            }

        }else{
            header("LOCATION:index.php?err=4");
        }

    }else{
        header("LOCATION:index.php?err=1");
    }


?>