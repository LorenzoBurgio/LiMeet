	<?php
session_start();
include("function.php");
require_once('config.php');
$user_data = check_login($db);
$bd = new PDO('mysql:host=sql102.epizy.com;dbname=epiz_31248537_LiMeet', 'epiz_31248537', 'r4IVikgYxfS');
if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])) {
$msg = $bd->prepare('SELECT * FROM MessageTable WHERE id_destinataire = ?');
$msg->execute(array($_SESSION['user_id']));
$msg_nbr = $msg->rowCount();
?>
<!DOCTYPE html>
<html>
<head>
   <title>Boîte de réception</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
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
                <a href="envoie.php">Write a messsage</a><br /><br /><br />
                 <?php
                if($msg_nbr == 0) { echo "You have no messages..."; }
                while($m = $msg->fetch()) {
                    $p_exp = $bd->prepare('SELECT FirstName FROM Users WHERE UserId = ?');
                    $p_exp->execute(array($m['id_expediteur']));
                    $p_exp = $p_exp->fetch();
                    $p_exp = $p_exp['FirstName'];
                ?>
                <div class = "message">
                <?php echo $p_exp ?></b> send :
                <?= nl2br($m['message']) ?><br />
                <?php } ?>
                </div>
            </div>
</div>
</body>
</html>
<?php } ?>