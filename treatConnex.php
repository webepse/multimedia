<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    if(isset($_POST['username']))
    {
      
        if(empty($_POST['username']) OR empty($_POST['password']))
        {
            header("LOCATION:index.php?action=connexion&err=1");
        }
        else{
            require "connexion.php";
            $user = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];
            $req = $bdd->prepare("SELECT * FROM membre WHERE login=?");
            $req->execute([$user]);
            if(!$don= $req->fetch())
            {
                header("LOCATION:index.php?action=connexion&err=2");
            }else{
                if(password_verify($password,$don['mdp']))
                {
                  
                    $_SESSION['login']=$don['login'];
                    $_SESSION['level']=$don['level'];
                    header("LOCATION:index.php");
                   
                }
                else{
                    header("LOCATION:index.php?action=connexion&err=3");
                }
            }

        }
    }
?>