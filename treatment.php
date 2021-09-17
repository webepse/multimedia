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
       
            $user = $bdd->prepare("SELECT login FROM membre WHERE login=?");
            $user->execute([$login]);
            if($donUser = $user->fetch())
            {
                $err=2;
            }
            $user->closeCursor();
           
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

        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,6}$#", $_POST['email']))
        {
            $email=htmlspecialchars($_POST['email']);
            $reqEmail = $bdd->prepare("SELECT * FROM membre WHERE mail=?");
            $reqEmail->execute([$email]);
            if($donMail = $reqEmail->fetch())
            {
                $err=6;
            }
            $reqEmail->closeCursor();
        }else{
            $err=5;
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