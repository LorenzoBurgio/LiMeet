<?php

session_start();
include("function.php");
require_once('config.php');

$user_data = check_login($db);
$bd = new PDO('mysql:host=sql102.epizy.com;dbname=epiz_31248537_LiMeet', 'epiz_31248537', 'r4IVikgYxfS');


$datamatch1 = array();
$userid = ($_SESSION['user_id']);



// On récupère tout le contenu de la table matchtable
$match = $bd->prepare('SELECT * FROM MatchTable');
$match->execute();
$matchtable = $match->fetchAll();


$user = $bd->prepare('SELECT * FROM Users');
$user->execute();
$user = $user->fetchAll();

foreach ($matchtable as $mt) {
  if ($mt['UserID_A'] == $userid)
  {
    array_push($datamatch1,$mt['UserID_B']);
    //echo "useridB has been pushed";
    //echo $mt['UserID_B'];
  }
  if ($mt['UserID_B'] == $userid)
  {
    //echo $mt['UserID_A'];
    array_push($datamatch1,$mt['UserID_A']);
    //echo "useridA has been pushed";
  }
}

$user = $bd->prepare('SELECT * FROM Users');
$user->execute();
$user = $user->fetchAll();


foreach($user as $user){
  for ($i = 0 ; $i < sizeof($datamatch1); $i += 1) {
    if ($user['UserId'] == $datamatch1[$i] )
    {
      unset($datamatch1[$i]);
      $datamatch1[$i] = $user['FirstName'] ;
    }
  }
}


if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])) {
  if(isset($_POST['envoi_message'])) {
    if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])) {
        
        $destinataire = htmlspecialchars($_POST['destinataire']) ;
        $message = htmlspecialchars($_POST['message']) ;

        $id_destinataire = $bd->prepare('SELECT UserId FROM Users WHERE FirstName = ?');
        $id_destinataire->execute(array($destinataire)); 
        $id_destinataire = $id_destinataire->fetch();
        $id_destinataire = $id_destinataire['UserId'] ;

        

        $ins = $bd->prepare('INSERT INTO MessageTable(id_expediteur,id_destinataire,message) VALUES (?,?,?)');
        $ins->execute(array($_SESSION['user_id'],$id_destinataire,$message));
        $error = "Votre message a bien été envoyé !";
      }   
      
      else {
        $error = "veuillez completer tout les champs";
      }

  }

  $destinataires = $bd->query('SELECT FirstName FROM Users ORDER BY FirstName');

  ?>
  <!DOCTYPE html>
    <html>
    <head>

         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
         <title>Chat</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <meta charset="utf-8" />
       
        <style type = "text/css">
            *{
                margin: 0;
                padding: 0;
                font-family: sans-serif;
                box-sizing: border-box;
            }

            body{
                height: 100vh;
                background-color: f8f8f8;
                display: flex;
                justify-content: center ;
                align-items: center ;        
                }
            .cont{
                width: 2000px;
                height: 100vh;
                display: flex;
                flex-direction: column;
                box-shadow: 2px 2px 20px seagreen;
                
            }
            .header h1{
                color: white;
                padding: 15px
            }
            .footer{
                flex: 1;
                color: white;
                background-color: seagreen;
                padding: 20px 30px ;
            }
            .message{
                background-color: mediumseagreen;
                padding: 10px;
                color: white;
                width: fit-content;
                border-radius : 10px;
                margin-bottom: 15 px ;
            }
        </style>
        
    </head>
    <body>
        
        <div class = "cont">
            <div class = "header">
                 <?php include_once('header.php'); ?>
            </div>
            <div class = "body">
            </div>
            <div class = "footer">
                <form method="POST">
                <label>Users :</label>
                <select name="destinataire">
                <?php 
                    while($d = $destinataires->fetch()){
                        if(in_array($d['FirstName'], $datamatch1)){
                            print "<option>".$d['FirstName']."</option>";
                        }
                    }
                ?>
                </select> 
                <br /><br />
                <textarea placeholder="Your message" name="message"></textarea>
                <br /><br />
                <input type="submit" value="Send" name="envoi_message" />
                <br /><br />
                <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } ?>
                 <br />
                <a href="reception.php">Your messages</a>
                </form>
            </div>
        </div>
    </body>
    </html>
<?php
}
?>