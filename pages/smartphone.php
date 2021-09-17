<?php
      $reqcount=$bdd->query("SELECT * FROM produits WHERE type='Smartphone'");
      $count = $reqcount->rowCount();
      $nbpage=ceil($count/6); 
?>

<h1>Smartphone</h1>
<?php
    if(isset($_GET['page']))
    {
        $pg=$_GET['page'];
    }
    else
    {
        $pg=1;
    }
    $offset=($pg-1)*6;
    echo "<div id='pagination'>";
       if($pg>1)
       {
       echo "<a href='index.php?action=smartphone&page=".($pg-1)."' title='Page précédente'><</a>&nbsp;";
       }
       echo "Page ".$pg;
       if($pg!=$nbpage)
       {
       echo " <a href='index.php?action=smartphone&page=".($pg+1)."' title='Page suivante'>></a>";
       }            
    echo "</div>";
?>
<div class="container">
    <?php
        $req = $bdd->prepare("SELECT * FROM produits WHERE type='Smartphone' ORDER BY prix DESC LIMIT :offset,6");
        $req->bindParam(':offset',$offset, PDO::PARAM_INT);
        $req->execute();
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
        $req->closeCursor();
        /*
        $don = $req->fetchAll();
        var_dump($don);
        */
    ?>
</div>