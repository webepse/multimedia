<div class="container">

            <div id="connex">
                <h1>Administration Multimédia</h1>
                <form action="treatConnex.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="username" name="username" placeholder="Login" class="form-control my-3">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control my-3">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Connexion" class="btn btn-primary">
                    </div>
                </form>
                <?php
                    if(isset($err))
                    {
                        echo '<div class="alert alert-danger">'.$err.'</div>';
                    }

                ?>
            </div>
       
    </div>