<?php 

session_start();

	include("config.php");
	include("function.php");


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
 	<title>Login</title>

     <style>

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
    <main>
    <div class="container">
      <div class="text-center">
      <img src="homepage.png" alt="logo" width="1000" height="750">
      </div>
    </div>
  </main>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
 
 </body>
 </html>