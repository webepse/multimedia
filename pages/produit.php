<div class="container-product">
    <h3><?= $donProd['marque'] ?></h3>
    <h1><?= $donProd['nom'] ?></h1>
    <div class="image">
        <a href="image/<?= $donProd['image'] ?>" data-caption="image de <?= $donProd['nom']." ".$donProd['marque'] ?>">
            <img src="image/mini_<?= $donProd['image'] ?>" alt="image de <?= $donProd['nom'] ?>">
        </a>
    </div>
    <h3><?= $donProd['prix'] ?>€</h3>
    <div class="text">
        <?= nl2br($donProd['description']) ?>
    </div>

</div>