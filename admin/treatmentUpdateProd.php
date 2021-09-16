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
    $req = $bdd->prepare("SELECT * FROM produits WHERE id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:product.php");
    }
    $req->closeCursor();

    if(isset($_POST['nom']))
    {
        $err=0;
        if(empty($_POST['nom']))
        {
            $err=1;
        }else{
            $nom=htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['marque']))
        {
            $err=2;
        }else{
            $marque=htmlspecialchars($_POST['marque']);
        }

        if(empty($_POST['prix']))
        {
            $err=3;
        }else{
            if(is_numeric($_POST['prix']))
            {
                $prix=htmlspecialchars($_POST['prix']);
            }else{
                $err=4;
            }
        }

        if(empty($_POST['type']))
        {
            $err=5;
        }else{
            $type=htmlspecialchars($_POST['type']);
        }

        if(empty($_POST['description']))
        {
            $err=6;
        }else{
            $description=htmlspecialchars($_POST['description']);
        }

        if($err==0)
        {
            if(empty($_FILES['image']['tmp_name']))
            {
                require "../connexion.php";
                $update=$bdd->prepare("UPDATE produits SET nom=:no, prix=:pri ,description=:desci ,type=:typ ,marque=:marq WHERE id=:id");
                $update->execute(array(
                    "no"=>$nom,
                    "pri"=>$prix,
                    "desci"=>$description,
                    "typ"=>$type,
                    "marq"=>$marque,
                    "id"=>$id
                ));
                $update->closeCursor();
                header("LOCATION:product.php?update=".$id);
            }
            else{
                unlink("../image/".$don['image']);
                unlink("../image/mini_".$don['image']);

                $dossier = '../image/';
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 2000000;
                $taille = filesize($_FILES['image']['tmp_name']);
                $extensions = array('.png','.jpg','.jpeg');
                $extension = strrchr($_FILES['image']['name'], '.');
                
                if(!in_array($extension, $extensions)) // on test si l'extension du fichier uploadé correspond aux extensions autorisées
                {
                    $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg';
                }
                if($taille>$taille_maxi)		// on test la taille de notre fichier 
                {
                    $erreur = 'Le fichier dépasse la taille autorisée';
                }
                
                if(!isset($erreur)) // Si tout les tests sont OK on passe à l'étape de l'upload sur notre serveur
                {
                    //On formate le nom du fichier, strtr remplace tout les KK speciaux en normaux suivant notre liste 
                    $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); // preg_replace remplace tout ce qui n'est pas un KK normal en tiret 
                    $fichiercptl=rand().$fichier;
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichiercptl)) // la fonction renvoie True si l'upload à été realisé 
                    {
                        require "../connexion.php";
                        $update=$bdd->prepare("UPDATE produits SET nom=:no, prix=:pri ,description=:desci ,type=:typ ,marque=:marq ,image=:ima WHERE id=:id");
                        $update->execute(array(
                            "no"=>$nom,
                            "pri"=>$prix,
                            "desci"=>$description,
                            "typ"=>$type,
                            "marq"=>$marque,
                            "ima"=>$fichiercptl,
                            "id"=>$id
                        ));
                        $update->closeCursor();
                            
                        
                            
                            if($extension==".png")
                            {
                                header("LOCATION:redimpng.php?update=".$id."&image=".$fichiercptl);
                            }
                            else
                            {
                                header("LOCATION:redim.php?update=".$id."&image=".$fichiercptl);
                            }
                            
                    }
                    else //Sinon (la fonction renvoie FALSE).
                    {
                        header("LOCATION:updateProd.php?id=".$id."error=7&upload=echec");
                    }
                }
                else
                {
                    header("LOCATION:updateProd.php?id=".$id."&error=7&fich=".$erreur);
                }
            }
        }else{
            header("LOCATION:updateProd.php?id=".$id."&error=".$err);
        }
    


    }else{
        header("LOCATION:addProd.php");
    }