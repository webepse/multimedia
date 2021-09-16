<?php
    session_start();
    if(!isset($_SESSION['level']) OR $_SESSION['level']!="administrateur")
    {
        header("LOCATION:index.php");
    }

    if(isset($_GET['deco']))
    {
        session_destroy();
        header("LOCATION:index.php");
    }
  
?>
<!DOCTYPE html>
<html lang="en">
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
       <h1>Dashboard</h1>
       <div class="row">
           <div class="col-6">
               <a href="../index.php" class="btn btn-secondary m-3" target="_blank">Retour au site</a>
               <a href="dashboard.php?deco=ok" class="btn btn-secondary m-3">Déconnexion</a>
           </div>
       </div>
       <div class="row">
           <div class="col-12">
               <a href="product.php" class="btn btn-success m-2">Mes Produits</a>
           </div>
           <div class="col-12">
               <a href="member.php" class="btn btn-success m-2">Mes membres</a>
           </div>
       </div>
    </div>
</body>
</html>