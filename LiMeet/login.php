<?php 

session_start();

	include("config.php");
	include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password))
		{

			//read from database
			$query = "SELECT * FROM Users WHERE Email = '$email' LIMIT 1 ";
			$result = mysqli_query($db, $query);
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);

                    if($user_data['Banned'] == '1'){
                        echo "Your account is temporarily banned";
                        return;
                    }
					
					if($user_data['Password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['UserId'];
						header("Location: index.php");
						die;
					}
				}
			}
            
			
			echo "<script>";
            echo "alert('Wrong username or password!');";
            echo "</script>";
		}else
		{
			echo "<script>";
            echo "alert('Wrong username or password!');";
            echo "</script>";
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
 	<title>Login</title>

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
      <form method ='post'>
    <!--LOGO-->
    <img class="mb-4" src="pictures/Logo.png" alt="" width="200" height="200">
    <!-- end LOGO-->

        <h1 class="h3 mb-3 fw-normal">Sign in</h1>

        <div class="form-floating">
          <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <br>
        <input class="w-100 btn btn-lg btn-outline-success" id="button" type="submit" value="Login" role="button"></input>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
      </form>
    </main>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
 
 </body>
 </html>