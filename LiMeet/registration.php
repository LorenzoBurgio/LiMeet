<?php
session_start();
include("function.php");
//require_once('config.php');
$db = mysqli_connect("sql102.epizy.com","epiz_31248537","r4IVikgYxfS","epiz_31248537_LiMeet");

if (!$db) {
    /* Use your preferred error logging method here */
    echo "Connection error:" . mysqli_connect_error();
}

if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    $query = "SELECT * FROM Users WHERE Email = '$email'";
    $result = mysqli_query($db, $query);

        if(!ctype_alpha($firstname) || !ctype_alpha($lastname)){
            echo "<script>";
            echo "alert('Firstname and lastname must not contain any number or only space');";
            echo "</script>";
        }
        else if($firstname === "" || $lastname === ""){
            echo "<script>";
            echo "alert('Firstname and lastname must not contain only space');";
            echo "</script>";
        }
    else if($result)
    {
      if($result && mysqli_num_rows($result) > 0)
      {
                echo "<script>";
                echo "alert('Email was already taken');";
                echo "</script>";
      }else{
        //save the data
      $sql = "INSERT INTO Users (Firstname, Lastname, Email, Password, Age) VALUES('$firstname','$lastname','$email','$password','$age')";

      $result = mysqli_query($db,$sql);
      if ($result) {
                echo ".";
                echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
                echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire('Successfully Registered !','you have created your account!','success')";
                echo "</script>";
      }else{
                echo "<script>";
                echo "alert('There were errors while saving the data');";
                echo "</script>";
      }
      }
    }
    else{
      //save the data
      $sql = "INSERT INTO Users (Firstname, Lastname, Email, Password, Age) VALUES('$firstname','$lastname','$email','$password','$age')";

      $result = mysqli_query($db,$sql);
      if ($result) {
                echo ".";
                echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
                echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire('Successfully Registered !','you have created your account!','success')";
                echo "</script>";
      }else{
        echo "<script>";
                echo "alert('There were errors while saving the data');";
                echo "</script>";
      }

    }
  }

?>

<!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
    
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

  <link rel="stylesheet" type="text/css" href="style.css">


    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="signin.css" rel="stylesheet">
 	<title>Sign up</title>

     <style>
     body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

     .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
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
 <body class="text-center">

 	<div class="container">
    <div class = "header">
                 <?php include_once('LoginHeader.php'); ?>
    </div>
    <main class="form-signin">
      <form action="registration.php" method ="post">
    <!--LOGO-->
    <img class="mb-4" src="pictures/Logo.png" alt="" width="200" height="200">
    <!-- end LOGO-->

        <h1 class="h3 mb-3 fw-normal">Sign up</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" required>
          <label for="floatingInput">First Name</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname">
          <label for="floatingInput">Last Name</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="email"  name="email" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="number" class="form-control" id="age"  name="age" placeholder="Age">
          <label for="floatingPassword">Age</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name ="password" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        <br>
        <input class="w-100 btn btn-lg btn-outline-success" id="register" type="submit" value="Sign up" role="button"></input>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
      </form>
    </main>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
</html>