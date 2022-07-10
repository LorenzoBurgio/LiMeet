<?php 
include('config.php');
 ?>
<?php 
	if (isset($_POST)) {

		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$email = $_POST['email'];
		$password = $_POST['password'];
		$age = $_POST['age'];

		$query = "SELECT * FROM Users WHERE Email = '$email'";
		$result = mysqli_query($db, $query);
        echo $result;

        if(!ctype_alpha($firstname) || !ctype_alpha($lastname)){
            echo "Firstname and lastname must not contain any number or only space";
        }
        else if($firstname === "" || $lastname === ""){
            echo "Firstname and lastname must not contain only space";
        }
		else if($result)
		{
			if($result && mysqli_num_rows($result) > 0)
			{
				echo 'Email was already taken';
			}else{
				//save the data
			$sql = "INSERT INTO Users (Firstname, Lastname, Email, Password, Age) VALUES('$firstname','$lastname','$email','$password','$age')";

			$result = mysqli_query($db,$sql);
			if ($result) {
				print 'Successfully Registered <a href="login.php">Sign In</a>';
			}else{
				echo 'There were errors while saving the data';
			}
			}
		}
		else{
			//save the data
			$sql = "INSERT INTO Users (Firstname, Lastname, Email, Password, Age) VALUES('$firstname','$lastname','$email','$password','$age')";

			$result = mysqli_query($db,$sql);
			if ($result) {
				print '<a href="login.php">SignIn</a>';
			}else{
				echo 'There were errors while saving the data';
			}

		}
		
			
	}else{
		echo 'no data';
	}
 ?>