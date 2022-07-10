<?php
session_start();
include("function.php");
require_once('config.php');

$user_data = check_login($db);
    
?>
<?php 
	if (isset($_POST)) {

		$Myinterest[] = $_POST['interest1'];
		$Myinterest[] = $_POST['interest2'];
		$Myinterest[] = $_POST['interest3'];
		$Myinterest[] = $_POST['interest4'];
		

		$id = $user_data['UserId'];


		$interest = retrieveMyInterest($db);

		$already = array();
		foreach ($interest as $key => $value) {

			$sql = "DELETE FROM Interest WHERE UserId= '$id'";
			mysqli_query($db,$sql);
		}

		foreach ($Myinterest as $key => $value) {
			if (!in_array($value, $already)) {
				if ($value === "null") {
					
				}else{
					$sql = "INSERT INTO Interest (InterestID, UserId) VALUES('$value','$id')";

					$result = mysqli_query($db,$sql);
					$already[] = $value;
					if (!$result) {
						echo "There was an error!";
						break;
					}
				}
			}
		}
		
		echo "Interest Save!";
		
		

	}else{
		echo 'no data';
	}
 ?>