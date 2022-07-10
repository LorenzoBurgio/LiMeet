<?php 
include('config.php');
 ?>
<?php 
	if (isset($_POST)) {

		$id = $_POST['id'];
		
		$query = "DELETE FROM Users WHERE UserId = '$id'";
		$result = mysqli_query($db, $query);

		$sql = "DELETE FROM Interest WHERE UserId = '$id'";
		$delete = mysqli_query($db, $sql);

		$sql2 = "DELETE FROM MatchTable WHERE UserID_A = '$id' OR UserID_B = '$id'";
		$match = mysqli_query($db, $sql2);

	if($result){
		echo 'the account has been deleted';
	}
			
	}else{
		echo 'no data';
	}
 ?>