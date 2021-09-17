<h1>Inscription</h1>
<div class="container">
    <form action="treatment.php" method="POST">
        <div class="form-group">
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" class="form-control">
        </div> 

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirmer le mot de passe</label>
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"> 
        </div>

        <div class="form-group">
            <input type="submit" value="Inscription">
        </div>

        <?php
            if(isset($_GET['err']))
            {
                if($_GET['err']=="2")
                {
                    echo "<div class='alert'>Le login existe déjà dans la base de données, veuillez en choisir un autre</div>"; 
                }elseif($_GET['err']=="3")
                {
                    echo "<div class='alert'>Les mots de passe ne correspondent pas</div>"; 
                }elseif($_GET['err']=="5")
                {
                    echo "<div class='alert'>L'adresse E-mail n'est pas valide</div>"; 
                }elseif($_GET['err']=="6")
                {
                    echo "<div class='alert'>L'adresse E-mail que vous avez utilisée est déjà enregistrée, veuillez en choisir une autre</div>"; 
                }
                else{
                    echo "<div class='alert'>Un problème est survenu</div>";
                }
            }
        ?>
    </form>
</div>