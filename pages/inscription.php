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
                echo "<div class='alert'>Un problème est survenu</div>";
            }
        ?>
    </form>
</div>