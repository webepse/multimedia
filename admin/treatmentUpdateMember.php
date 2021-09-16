<?php
      session_start();
      if(!isset($_SESSION['level']) OR $_SESSION['level']!="administrateur")
      {
          header("LOCATION:index.php");
      }
  
      if(isset($_GET['id']) OR !empty($_GET['id']))
      {
          $id=htmlspecialchars($_GET['id']);
      }else{
          header("LOCATION:membre.php");
      }
  
      require "../connexion.php";
      $req = $bdd->prepare("SELECT * FROM membre WHERE id=?");
      $req->execute([$id]);
      if(!$don = $req->fetch())
      {
          $req->closeCursor();
          header("LOCATION:membre.php");
      }
      $req->closeCursor();

    /* si form envoyé */
    if(isset($_POST['login']))
    {
        require "../connexion.php";
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
        }

        if(empty($_POST['level']))
        {
            $err=4;
        }else{
            $level=htmlspecialchars($_POST['level']);
        }


        if($err==0)
        {
            if(empty($_POST['password']))
            {
                $update = $bdd->prepare("UPDATE membre SET login=:log, level=:level WHERE id=:id");
                $update->execute([
                    "log"=>$login,
                    "level"=>$level,
                    "id"=>$id
                ]);
                $update->closeCursor();
                header("LOCATION:member.php?update=succes&id=".$id);
            }else{
                $update = $bdd->prepare("UPDATE membre SET login=:log, mdp=:password, level=:level WHERE id=:id");
                $update->execute([
                    "log"=>$login,
                    "password"=>$hash,
                    "level"=>$level,
                    "id"=>$id
                ]);
                $update->closeCursor();
                header("LOCATION:member.php?update=succes&id=".$id);

            }
        }else{
            header("LOCATION:updateMember.php?id=".$id."&err=".$err);
        }


    }else
    {
        header("LOCATION:member.php");
    }