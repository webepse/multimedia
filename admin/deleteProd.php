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

    if(isset($_GET['delete']))
    {
        unlink("../image/".$don['image']);
        unlink("../image/mini_".$don['image']);
        $delete = $bdd->prepare("DELETE FROM produits WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:product.php?delete=success&id=".$id);
    }

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
        <h1>Supprimer</h1>
        <div class="row">
            <div class="col-2">
                <img src="../image/<?= $don['image'] ?>" alt="image de <?= $don['nom']." ".$don['marque'] ?>" class="img-fluid">
            </div>
            <div class="col-10">
                <h4><?= $don['marque'] ?></h4>
                <h2><?= $don['nom'] ?></h2>
                <h5><?= $don['type'] ?></h5>
                <div class="col-12"><?= $don['prix'] ?>€</div>
                <div class="col-12"><?= nl2br($don['description']) ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h4>Voulez vous vraiment supprimer ce produit?</h4></div>
            <a href="product.php" class="btn btn-secondary m-2">NON</a>
            <a href="deleteProd.php?id=<?= $id ?>&delete=ok" class="btn btn-danger m-2">Oui</a>
        </div>
    </div>
</body>
</html>