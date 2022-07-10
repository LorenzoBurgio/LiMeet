<?php
session_start();
include("function.php");
require_once('config.php');

$interest = retrieveInterest($db);

$Users = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset( $_POST['searchUser'] ))
    {
        $name = $_POST['firstname'];
        $sql = "SELECT * from Users WHERE FirstName = '$name'";

		$result = mysqli_query($db,$sql);

		while ($row = mysqli_fetch_assoc($result)) {
    		$Users[] = $row;
    	
		}


    }else{
        $interest1 = $_POST['Interest1'];
	$interest2 = $_POST['Interest2'];
	$studies = $_POST['studies'];
	$Nationality = $_POST['nationality'];

	$interests = array();

	if ($interest1 !== 'null') {
		$interests[] = $interest1;
	}
	if ($interest2 !== 'null') {
		if (!in_array($interest2, $interests)) {
			$interests[] = $interest2;
		}
	}
	if ($studies === 'Studies') {
		$studies = "null";
	}
	if ($Nationality === 'Nationality') {
		$Nationality = 'null';
	}

	
	$ageMin = $_POST['ageMin'];
	$ageMax = $_POST['ageMax'];

	$gender = $_POST['gender'];

	$research = array('interests' => $interests, 'ageMin' => $ageMin, 'ageMax' => $ageMax, 'gender' => $gender,'nationality' => $Nationality, 'studies'=> $studies);
	$Users = retrieveUser($research,$db);
    }
	
	
}else{
	$Users = retrieveUser(null,$db);
}



$user_data = check_login($db);



$studies = array('Studies','Computer Science', 'Enginering','psychologie','Sport','other');
$nationality = array('Nationality','french','American','irish','other');
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">

</head>
<body>
    <style type="text/css">

.career-form {
  background-color: #4e63d7;
  border-radius: 5px;
  padding: 0 16px;
}

.career-form .form-control {
  background-color: rgba(255, 255, 255, 0.2);
  border: 0;
  padding: 12px 15px;
  color: #fff;
}

.career-form .form-control::-webkit-input-placeholder {
  /* Chrome/Opera/Safari */
  color: #fff;
}

.career-form .form-control::-moz-placeholder {
  /* Firefox 19+ */
  color: #fff;
}

.career-form .form-control:-ms-input-placeholder {
  /* IE 10+ */
  color: #fff;
}

.career-form .form-control:-moz-placeholder {
  /* Firefox 18- */
  color: #fff;
}

.career-form .custom-select {
  background-color: rgba(255, 255, 255, 0.2);
  border: 0;
  padding: 12px 15px;
  color: #fff;
  width: 100%;
  border-radius: 5px;
  text-align: left;
  height: auto;
  background-image: none;
}

.career-form .custom-select:focus {
  -webkit-box-shadow: none;
          box-shadow: none;
}

.career-form .select-container {
  position: relative;
}

.career-form .select-container:before {
  position: absolute;
  right: 15px;
  top: calc(50% - 14px);
  font-size: 18px;
  color: #ffffff;
  content: '\F2F9';
  font-family: "Material-Design-Iconic-Font";
}

.filter-result .job-box {
  -webkit-box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
          box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
  border-radius: 10px;
  padding: 10px 35px;
}

ul {
  list-style: none; 
}

.list-disk li {
  list-style: none;
  margin-bottom: 12px;
}

.list-disk li:last-child {
  margin-bottom: 0;
}

.job-box .img-holder {
  height: 65px;
  width: 65px;
  background-color: #4e63d7;
  background-image: -webkit-gradient(linear, left top, right top, from(rgba(78, 99, 215, 0.9)), to(#5a85dd));
  background-image: linear-gradient(to right, rgba(78, 99, 215, 0.9) 0%, #5a85dd 100%);
  font-family: "Open Sans", sans-serif;
  color: #fff;
  font-size: 22px;
  font-weight: 700;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  border-radius: 65px;
}

.career-title {
  background-color: #4e63d7;
  color: #fff;
  padding: 15px;
  text-align: center;
  border-radius: 10px 10px 0 0;
  background-image: -webkit-gradient(linear, left top, right top, from(rgba(78, 99, 215, 0.9)),to(#5a85dd));
  background-image: linear-gradient(to right, rgba(78, 99, 215, 0.9) 0%, #5a85dd 100%);
}

.job-overview {
  -webkit-box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
          box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
  border-radius: 10px;
}

@media (min-width: 992px) {
  .job-overview {
    position: -webkit-sticky;
    position: sticky;
    top: 70px;
  }
}

.job-overview .job-detail ul {
  margin-bottom: 28px;
}

.job-overview .job-detail ul li {
  opacity: 0.75;
  font-weight: 600;
  margin-bottom: 15px;
}

.job-overview .job-detail ul li i {
  font-size: 20px;
  position: relative;
  top: 1px;
}

.job-overview .overview-bottom,
.job-overview .overview-top {
  padding: 35px;
}

.job-content ul li {
  font-weight: 600;
  opacity: 0.75;
  border-bottom: 1px solid #ccc;
  padding: 10px 5px;
}

@media (min-width: 768px) {
  .job-content ul li {
    border-bottom: 0;
    padding: 0;
  }
}

.job-content ul li i {
  font-size: 20px;
  position: relative;
  top: 1px;
}
.mb-30 {
    margin-bottom: 30px;
}


.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}


.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels2{
    font-size: 20px;
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8


}

</style>

<?php include_once('header.php'); ?>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-9 border-right">
            <?php 
            	foreach ($Users as $key => $value) {
                    if($value['Picture'] === null)
                        $value['Picture'] = "default.jpeg";
                    if($value['Nationality'] === null || $value['Nationality'] === "")
                        $value['Nationality'] = "Nationality";
                    if($value['Studies'] === null || $value['Studies'] === "")
                        $value['Studies'] = "Studies";
            		print "
                    <form action='AdminProfile.php' method='POST'>
                    <div class='job-box d-md-flex align-items-center justify-content-between mb-30'>
                <div class='job-left my-4 d-md-flex align-items-center flex-wrap'>
                    <div class='img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex'>
                    <img alt='Profile_name' width='55' height='55' class='rounded-circle' src='pictures/".$value['Picture']."'>
                    </div>
                    <div class='job-content'>
                        <h5 class='text-center text-md-left'>".$value['FirstName']."</h5>
                        <ul class='d-md-flex flex-wrap text-capitalize ff-open-sans'>
	                        <li class='mr-md-4'>
	                            <i class='zmdi zmdi-pin mr-2'></i>".$value['Nationality']."
	                        </li>
	                        <li class='mr-md-4'>
	                            <i class='zmdi zmdi-account-box mr-2'></i> ".$value['Studies']."
	                        </li>
	                        <li class='mr-md-4'>
	                            <i class='zmdi zmdi-time mr-2'></i> ".$value['Age']."
	                        </li>
                        </ul>
                    </div>
                    <input type='hidden' name='id' value='".$value['UserId']."'>
                </div>
                <div class='job-right my-4 flex-shrink-0'>
                    <button class='btn btn-primary profile-button' type='submit' id='SaveInterest'>View Profile</button>
                </div>
            </div>
            </form>";
            	}

            	if(count($Users) === 0){
            		echo "No Users found";
            	}
             ?>

        </div>
        <div class="col-3">
            <div class="p-3 py-5">

                <form action="research.php" method="POST">
                <div class="col-md-12"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="Enter the FirstName of the user" name="firstname" value="" required></div>
                <br>
                <div class="d-flex justify-content-between align-items-center experience"><span>Search User</span>
                    <button class="btn btn-primary profile-button" type="submit" name="searchUser">Search</button></div><br>
                <br>
                </form>
                <form action="research.php" method="POST">
                
                <div class="col-md-12"><label class="labels">Interest n°1</label>
                    <select class="form-select" name="Interest1" required>
                        <option value=null>Interest n°1</option>
                                <?php 
                                    foreach ($interest as $key => $value) {
                                        print "<option value='".$value['id']."'>".$value['name']."</option>";  
                                    }
                                 ?>
                    </select>
                </div> 
                <div class="col-md-12"><label class="labels">Interest n°2</label>
                    <select class="form-select" name="Interest2" required>
                        <option value= null >Interest n°2</option>
                                <?php 
                                    foreach ($interest as $key => $value) {
                                        print "<option value='".$value['id']."'>".$value['name']."</option>";
                                    }
                                 ?>
                    </select>
                </div> 
                <div class="col-md-12"><label class="labels">Studies</label>
                    <select class="form-select" name="studies" required>
                        <?php 
                                foreach ($studies as $key => $value) {
                                    print "<option value='$value'>$value</option>";
                                        
                                }
                        ?>
                    </select>
                </div> 

                <div class="col-md-12"><label class="labels">Nationality</label>
                    <select class="form-select" name="nationality" required>
                    	<?php 
                                foreach ($nationality as $key => $value) {
                                    print "<option value='$value'>$value</option>";
                                        
                                }
                        ?>
                    </select>
                </div> <br>

                <div class="col-md-12"><label class="labels">Age min</label><input type="number" class="form-control" placeholder="enter min age" name="ageMin" value="" required></div>
                <div class="col-md-12"><label class="labels">Age max</label><input type="number" class="form-control" placeholder="enter max age" name="ageMax" value="" required></div>
                <div class="col-md-12"><label class="labels">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                <br>

                <div class="d-flex justify-content-between align-items-center experience"><span>Search Users</span>
                    <button class="btn btn-primary profile-button" type="submit" id="SaveInterest">Search</button></div><br>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>