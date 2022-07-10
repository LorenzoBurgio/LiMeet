<?php
session_start();
include("function.php");
require_once('config.php');

$user_data = check_login($db);
    
?>
<?php 
	if (isset($_POST)) {

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$age = $_POST['age'];
		$description = $_POST['description'];
		$gender = $_POST['gender'];
		if ($gender === "Gender") {
			$gender = null;
		}
		$seeking = $_POST['seeking'];
		if ($seeking === "Seeking") {
			$seeking = null;
		}
		$nationality = $_POST['nationality'];
		if ($nationality === "Nationality") {
			$nationality = null;
		}
		$studies = $_POST['studies'];
		if ($studies === "Studies") {
			$studies = null;
		}

		$id = $_POST['id'];

		$sql = "UPDATE Users SET FirstName = '$firstname', LastName = '$lastname', Email = '$email', Age = '$age', Description = '$description', Gender = '$gender', Seeking = '$seeking', Nationality = '$nationality', Studies = '$studies' WHERE UserId = '$id'";

		$result = mysqli_query($db,$sql);
		
		if ($result) {
			echo "Profile was Update!";
		} else {
			echo "There was an error!";
		}
		

	}else{
		echo 'no data';
	}
 ?>