<div class="container-product">
    <?php
        if(isset($_GET['deleteCom']))
        {
            echo '<div class="alert">Un commentaire a été supprimé</div>';
        }
    ?>
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
    <div class="commentaires">
    <h1>Les avis</h1>
   
    <?php 
            if(isset($_SESSION['id']))
            {
        ?>
             <h3>Ajouter votre avis: </h3>
            <div class="form-com">
                <form action="treatCom.php?id=<?= $id ?>" method="POST">
                    <div class="form-log"><?= $_SESSION['login'] ?></div>
                    <div class="form-group">
                        <textarea name="com" id="com" cols="30" rows="10"></textarea>
                    </div>
                    <?php
                        if(isset($_GET['err']))
                        {
                            echo "<div class='alert'>Veuillez remplir correctement le formulaire avant d'envoyer</div>";
                        }
                    ?>
                    <div class="form-group">
                        <input type="submit" value="Envoyer">
                    </div>
                </form>
            </div>
        <?php
            echo "<h3>Les autres avis: </h3>";
            }

        ?>
      
        <?php 
            $coms = $bdd->prepare("SELECT commentaires.texte AS cTexte, DATE_FORMAT(commentaires.date, '%d/%m/%Y %Hh:%i') AS myDate, commentaires.id_membre AS Mid, membre.login AS mLogin, commentaires.id AS Cid FROM commentaires INNER JOIN membre ON commentaires.id_membre = membre.id WHERE commentaires.id_produit=? ORDER BY commentaires.date DESC");
            $coms->execute([$id]);
            while($donComs = $coms->fetch())
            {
                echo "<div class='coms'>";
                    echo "<div class='comsInfo'>";
                    echo "<a href='index.php?action=user&id=".$donComs['Mid']."' class='author'>".$donComs['mLogin']."</a>";
                    echo "<div class='date'>".$donComs['myDate']."</div>";
                    if(isset($_SESSION['level']))
                    {
                        if($_SESSION['level']=="administrateur")
                        {
                            echo "<a href='treatDelete.php?id=".$donComs['Cid']."&pid=".$id."'>Supprimer</a>";
                        }
                        
                        if($_SESSION['id']==$donComs['Mid'])
                        {
                            echo "<a href=''>Modif</a>";
                        }
                    }
                    echo "</div>";
                    echo "<div class='comTxt'>".nl2br($donComs['cTexte'])."</div>";
                echo "</div>";
            }
            $coms->closeCursor();
        ?>
  

    </div>

</div>