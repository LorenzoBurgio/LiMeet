<?php
session_start();
include("function.php");
require_once('config.php');

$user_data = check_login($db);
    
?>
<?php 
	if (isset($_POST['submit'])) {
		$file = $_FILES['file'];
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		$fileExt = explode('.',$fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg','jpeg','png');

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 5000000) {
					$fileNameNew = uniqid('',true).".".$fileActualExt;
					$fileDestination = 'pictures/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$id = $user_data['UserId'];

					$sql = "UPDATE Users SET Picture = '$fileNameNew' WHERE UserId = '$id'";

					$result = mysqli_query($db,$sql);

					if ($result) {
						if ($user_data['Picture'] !== null) {
							$old = 'pictures/'.$user_data['Picture'];
							unlink($old);
						}
						header("Location: profile.php?uploadsucces");
					}else{
						echo "there was an error uploading your files on MySql";
					}

					
				}else{
					echo "Your file is to big!";
				}
				
			}else{
				echo "there was an error uploading your files!";
			}
		}else{
			echo "You cannot upload files of this type!";
		}
	}
 ?>