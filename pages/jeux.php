<h1>Jeux vidéo</h1>
<div class="container">
    <?php
        $req = $bdd->query("SELECT * FROM produits WHERE type='Jeux vidéo'");
        while($don = $req->fetch()){
    ?>
        <div class="card">
            <div class="card-img">
                <img src="image/mini_<?= $don['image'] ?>" alt="<?= $don['nom'] ?>">
            </div>
            <div class="card-body">
            <div class="model"><a href="index.php?action=produits&id=<?= $don['id'] ?>"><?= $don['nom'] ?></a></div>
                <div class="mark"><?= $don['marque'] ?></div>
                <div class="price"><?= $don['prix'] ?>€</div>
            </div>
        </div>

    <?php
        }   
        /*
        $don = $req->fetchAll();
        var_dump($don);
        */
    ?>
</div>