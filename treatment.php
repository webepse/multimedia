<?php
    /* si form envoyé */
    if(isset($_POST['login']))
    {
        require "connexion.php";
        $err=0;
        if(empty($_POST['login']))
        {
            $err=1;
        }else{
            $login = htmlspecialchars($_POST['login']);
            if($login!=$don['login'])
            {
                $user = $bdd->prepare("SELECT * FROM membre WHERE login=?");
                $user->execute([$login]);
                if($donUser = $user->fetch())
                {
                    $err=2;
                }
            }
        }

        if(!empty($_POST['password']))
        {
            if($_POST['password']==$_POST['confirmPassword'])
            {
                $hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
            }
            else{
                $err=3;
            }
        }else{
            $err=4;
        }

        if(empty($_POST['email']))
        {
            $err=5;
        }else{
            $email=htmlspecialchars($_POST['email']);
        }


        if($err==0)
        {
          
                $registration = $bdd->prepare("INSERT INTO membre(login,mdp,mail,image,level) VALUES(:log,:password,:mail,null,'membre')");
                $registration->execute([
                    "log"=>$login,
                    "password"=>$hash,
                    "mail"=>$email
                ]);
                $registration->closeCursor();
                header("LOCATION:index.php?registration=succes");

            
        }else{
            header("LOCATION:index.php?action=inscription&err=".$err);
        }


    }else
    {
        header("LOCATION:index.php");
    }