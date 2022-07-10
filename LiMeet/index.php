<?php
session_start();
include("function.php");
require_once('config.php');

$user_data = check_login($db);



if(isset($_POST['Like'])){
    $MyId = $user_data['UserId'];
    $Id = $_POST['id'];
    $sql = "INSERT INTO LikeTable (UserID, Liked_UserID) VALUES('$MyId','$Id')";


	$result = mysqli_query($db,$sql);

    $send = check_Match($MyId,$Id,$db);
   
    if($send){
        //inform the users this is a Match !
        echo ".";
        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire('New Match !','You have a new match !','success')";
        echo "</script>";
    }
}
if(isset($_POST['DisLike'])){
    $MyId = $user_data['UserId'];
    $Id = $_POST['id'];
    $sql = "INSERT INTO DislikeTable (UserID, Disliked_UserID) VALUES('$MyId','$Id')";

	$result = mysqli_query($db,$sql);
}

$Preference = RetrievePreference($db);




	
?>

<!DOCTYPE html>
<html>
<head>
	<title>HomePage</title>
<!--link for Bootstrap-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<!-- header style-->
    <meta charset="utf-8">
    <title>Headers · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">

    

    <!-- Bootstrap core CSS -->


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        }
        .bu {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

</head>
<body>

<?php include_once('header.php'); ?>

<!--end header-->

<div class="row"></div>

<!--needs spacing between the two-->


<div class="container">
	<div class="text-center">
	<h2 class="pb-2 border-bottom">Profiles</h2>
	</div>

    <div class="row">
<div>
  <p></p>
</div>
    <?php 
        if(count($Preference) === 0){
            print "<h4 class='text-center'>we have no more users to offer you</h4>";
        }
        else{
            $other_data = getinfo($Preference[0],$db);
            if($other_data['Picture'] === null){
                $other_data['Picture'] = 'default.jpeg';
            }

            print "<div class='card' style='width: 18rem;'>
        <img class='card-img-top' src='pictures/".$other_data['Picture']."' alt='Card image cap'>
        <div class='card-body'>
            <h5 class='card-title'>".$other_data['FirstName']." ".$other_data['LastName']."</h5>
            <p class='card-text'>".$other_data['Description']."</p>
            <form action='userProfile.php' method='POST'>
            <input type='hidden' id='id' name='id' value='".$other_data['UserId']."'>
            <button class='btn btn-primary profile-button' type='submit' name='Profile'>View Profile</button>
            </form>
        </div>
    </div>";
        }
        
    ?>
    
	
</div>


<div>
  <p></p>
</div>

<div class="container">
<div class="col-12 d-flex justify-content-center text-center">

<!--Yes and no button to pass or keep-->

<?php 
if(count($Preference) === 0){

}
else{
    print "<form action='index.php' method='POST'>
<input type='hidden' id='id' name='id' value= '".$other_data['UserId']."'>
<button type='submit' class='btn btn-outline-danger' name='DisLike'>❌</button>



<button type='submit' class='btn btn-outline-success' name='Like'>💚</button>
</form>";
}

?>



</div>
</div>



<!--link for Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>