<?php
    session_start();
    if(!isset($_SESSION['level']) OR $_SESSION['level']!="administrateur")
    {
        header("LOCATION:index.php");
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
        <h1>Ajouter un produit à la base de données</h1>
        <a href="product.php" class="btn btn-secondary my-3">Retour</a>
        <div class="row">
            <form action="treatmentAddProd.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Nom: </label>
                    <input type="text" id="nom" name="nom" class="form-control">
                </div>   
                <div class="form-group">
                    <label for="marque">Marque: </label>
                    <input type="text" id="marque" name="marque" class="form-control">
                </div>   
                <div class="form-group">
                    <label for="prix">Prix: </label>
                    <input type="number" step="0.01" id="prix" name="prix" class="form-control">
                </div>   
                <div class="form-group">
                    <label for="type">Type: </label>
                    <select name="type" id="type" class="form-control">
                        <option value="Smartphone">Smartphone</option>
                        <option value="Jeux vidéo">Jeux vidéo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image de couverture: </label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>   
                <div class="form-group">
                    <input type="submit" value="Ajouter" class="btn btn-success my-2">
                </div>

            </form>
        </div>
    </div>
</body>
</html>