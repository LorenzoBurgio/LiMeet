<?php 

function check_login($db)
{
	if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];
		$query = "select * from Users where UserId = '$id' limit 1";

		$result = mysqli_query($db,$query);

		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: homepage.php");
	die;
}

function getinfo($id,$db)
{
    $query = "select * from Users where UserId = '$id' limit 1";

	$result = mysqli_query($db,$query);

    if($result && mysqli_num_rows($result) > 0)
	{
		$other_data = mysqli_fetch_assoc($result);
		return $other_data;
	}
}

function retrieveInterest($db)
{
	$query = "select * from availableInterest";

	$result = mysqli_query($db,$query);

	$interest;

	while ($row = mysqli_fetch_assoc($result)) {
    $interest[] = array('id'=> $row['InterestId'],'name'=> $row['InterestName']);
	}
	return $interest;

}

function retrieveMyInterest($db)
{
	$id = $_SESSION['user_id'];

	$sql = "SELECT * from Interest WHERE UserId = '$id'";

	$result = mysqli_query($db,$sql);

	$MyInterest= array();
	$acc =0;

	while ($row = mysqli_fetch_assoc($result)) {
    	$MyInterest[] = $row['InterestID'];
    	//$acc+=1;
	}
	return $MyInterest;

}



function retrieveotherInterest($id,$db)
{
	$sql = "SELECT * from Interest WHERE UserId = '$id'";

	$result = mysqli_query($db,$sql);

	$MyInterest= array();
	$acc =0;

	while ($row = mysqli_fetch_assoc($result)) {
    	$MyInterest[] = $row['InterestID'];
    	//$acc+=1;
	}

	while ($acc < 4) {
		//$MyInterest[$acc] = "null";
		$acc +=1;
	}



	return $MyInterest;

}
function check_Match($MyId,$Id,$db){

    $sql = "SELECT * from LikeTable WHERE UserID = '$Id' AND Liked_UserID = '$MyId'";
    $result = mysqli_query($db,$sql);


    if($result && mysqli_num_rows($result) > 0)
	{
		//Create Match
        $sql = "INSERT INTO MatchTable (UserID_A, UserID_B) VALUES('$MyId','$Id')";

		$result = mysqli_query($db,$sql);
		
        return true;
	}
    return false;

}

function VerifyInvit($db,$MyId,$Id){
    $sql = "SELECT * from LikeTable WHERE UserID = '$MyId' AND Liked_UserID = '$Id'";
    $result = mysqli_query($db,$sql);
    if($result && mysqli_num_rows($result) > 0){
        return true;
    }
    return false;

}

function RetrievePreference($db)
{
    $Preference = array();
    $id = $_SESSION['user_id'];


    $user_data = check_login($db);
    $Seeking = $user_data['Seeking'];

    

    $sql = "SELECT * from LikeTable WHERE UserID = '$id'";
    $result = mysqli_query($db,$sql);

    $MyLike= array();
    while ($row = mysqli_fetch_assoc($result)) {
    	$MyLike[] = $row['Liked_UserID'];
	}

    $sql = "SELECT * from DislikeTable WHERE UserID = '$id'";
    $result = mysqli_query($db,$sql);

    while ($row = mysqli_fetch_assoc($result)) {
    	$MyLike[] = $row['Disliked_UserID'];
	}

    

    

    if($Seeking === "null")
    {
        $sql = "SELECT * from Users WHERE UserId <> '$id'";
    }
    else{
        $sql = "SELECT * from Users WHERE UserId <> '$id' AND Gender = '$Seeking'";
    }

    
    
    $result = mysqli_query($db,$sql);

    $Seeker= array();
    while ($row = mysqli_fetch_assoc($result)) {
        if(!in_array($row['UserId'], $MyLike))
    	    $Seeker[] = $row['UserId'];
	}


    $MyInterest = retrieveMyInterest($db);

    

    switch (count($MyInterest)) {
			case 4:
			{
                
				$sql = "SELECT UserId from Interest WHERE InterestID = '$MyInterest[0]' OR InterestID = '$MyInterest[1]' OR InterestID = '$MyInterest[2]' OR InterestID = '$MyInterest[3]'";
				$result = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($result)) {
    				if (in_array($row['UserId'], $Seeker) && !in_array($row['UserId'], $MyLike) && !in_array($row['UserId'], $Preference)) {
    					$Preference[] = $row['UserId'];
    				}
				}
				break;
			}	
				
			case 3:
			{
                
				$sql = "SELECT UserId from Interest WHERE InterestID = '$MyInterest[0]' OR InterestID = '$MyInterest[1]' OR InterestID = '$MyInterest[2]'";
				$result = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($result)) {
    				if (in_array($row['UserId'], $Seeker) && !in_array($row['UserId'], $MyLike)) {
    					$Preference[] = $row['UserId'];
    				}
				}
				break;
			}	
			case 2:
			{
				$sql = "SELECT UserId from Interest WHERE InterestID = '$MyInterest[0]' OR InterestID = '$MyInterest[1]'";
				$result = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($result)) {
    				if (in_array($row['UserId'], $Seeker) && !in_array($row['UserId'], $MyLike) && !in_array($row['UserId'], $Preference)) {
    					$Preference[] = $row['UserId'];
    				}
				}
				break;
			}
            case 1:
			{
				$sql = "SELECT UserId from Interest WHERE InterestID = '$MyInterest[0]'";
				$result = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($result)) {
    				if (in_array($row['UserId'], $Seeker) && !in_array($row['UserId'], $MyLike) && !in_array($row['UserId'], $Preference)) {
    					$Preference[] = $row['UserId'];
    				}
				}
				break;
			}
            case 0:
			{
				return $Seeker;
			}	
				
	}
    return $Preference;

}

function retrieveUser($research,$db)
{
	$users = array();

	if ($research === null) {
		$sql = "SELECT * from Users";

		$result = mysqli_query($db,$sql);

		while ($row = mysqli_fetch_assoc($result)) {
    		$users[] = $row;
    	
		}
	} else {

		$inte = array();
		$interest = $research['interests'];
		switch (count($research['interests'])) {
			case 2:
			{
                
				$sql = "SELECT UserId from Interest WHERE InterestID = '$interest[0]' OR InterestID = '$interest[1]'";
				$result = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($result)) {
    				if (!in_array($row['UserId'], $inte)) {
    					$inte[] = $row['UserId'];
    				}
				}
				break;
			}	
				
			case 1:
			{
                
				$sql = "SELECT UserId from Interest WHERE InterestID = '$interest[0]'";
				$result = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($result)) {
    				if (!in_array($row['UserId'], $inte)) {
    					$inte[] = $row['UserId'];
    				}
				}
				break;
			}	
			case 0:
			{
				$inte = null;
			}	
				break;
		}        
		$studies = $research['studies'];
		$nationality = $research['nationality'];
		$ageMin = $research['ageMin'];
		$ageMax = $research['ageMax'];
		$gender = $research['gender'];

        if($studies === "null")
        {
            if($nationality === "null"){

                $sql = "SELECT * FROM Users WHERE Gender = '$gender' AND Age > '$ageMin' AND Age < '$ageMax'";
                $result = mysqli_query($db,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if (in_array($row['UserId'], $inte) || $inte === null) {
                        $users[] = $row;
                    }
                }

            }else{

                $sql = "SELECT * FROM Users WHERE Studies = '$studies' AND Gender = '$gender' AND Age > '$ageMin' AND Age < '$ageMax'";
                $result = mysqli_query($db,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if (in_array($row['UserId'], $inte) || $inte === null) {
                        $users[] = $row;
                    }
                }

            }
        }
        elseif($nationality === "null")
        {
            $sql = "SELECT * FROM Users WHERE Studies = '$studies' AND Gender = '$gender' AND Age > '$ageMin' AND Age < '$ageMax'";
            $result = mysqli_query($db,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if (in_array($row['UserId'], $inte) || $inte === null) {
                    $users[] = $row;
                }
            }
        }
        else{
            $sql = "SELECT * FROM Users WHERE Studies = '$studies' AND Nationality = '$nationality' AND Gender = '$gender' AND Age > '$ageMin' AND Age < '$ageMax'";
            $result = mysqli_query($db,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if (in_array($row['UserId'], $inte) || $inte === null) {
                    $users[] = $row;
                }
            }
        }
	}
	

	return $users;
}

 ?>