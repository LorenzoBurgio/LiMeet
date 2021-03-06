<?php
session_start();
include("function.php");
require_once('config.php');

$interest = retrieveInterest($db);
$Myinterest = retrieveotherInterest($_POST['id'],$db);


$user_data = check_login($db);
$other_data = array();
if(isset($_POST['id']))
{
    $other_data = getinfo($_POST['id'],$db);
}
else{
    $other_data = getinfo($_GET['id'],$db);
}

$id = $_POST['id'];

$studies = array('Studies','Computer Science', 'Enginering','psychologie','Architect','Design','Buisness','Medicine','nurse','Sport','other');
$nationality = array('Nationality','french','American','irish','Portuguese','Italian','English','Mexican','Spanish','Swiss','German','Polish','Belgian','other');

if (isset( $_POST['Ban'] )){
    
    $sql = "UPDATE Users SET Banned = '1' WHERE UserId = '$id'";

	$result = mysqli_query($db,$sql);
   
}
if (isset( $_POST['Unban'])){
    
    $sql = "UPDATE Users SET Banned = '0' WHERE UserId = '$id'";

	$result = mysqli_query($db,$sql);
}

if(isset($_POST['id']))
{
    $other_data = getinfo($_POST['id'],$db);
}
else{
    $other_data = getinfo($_GET['id'],$db);
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>HomePage</title>
<!--link for Bootstrap-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<!-- header style-->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
    <style type="text/css">


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

</head>
<body>

<?php include_once('header.php'); ?>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                <?php 


                if ($other_data['Picture'] === null) {
                    print "<img class='rounded-circle mt-5' width='150px' src='https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg'>";
                }else{
                    $files = 'pictures/'.$other_data['Picture'];
                    print "<img class='rounded-circle mt-5' width='150px' src='".$files."'>";
                }

             ?>

                <img class="rounded-circle mt-5" width="150px" src= >
                <form action="uploadAdmin.php" method="POST" enctype="multipart/form-data">
                    <div class="mt-5 text-center"><label for="formFile" class="form-label">Load Image</label><input class="form-control" type="file" name="file" id="formFile">
                        <br>
                    <button class="btn btn-primary profile-button" type="submit" name="submit">Change Picture</button></div>
                    <input type="hidden" id="id" name="id" value=<?php echo $other_data[UserId]?>>
                </form>
                <br>

                <span class="font-weight-bold"><?php echo $other_data['FirstName']; ?></span><span class="text-black-50"><?php echo $other_data['Email']; ?></span><span> </span></div>
                
        </div>
        <div class="col-md-5 border-right">
            <form action="profile.php" method="POST">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" id="firstname" placeholder="first name" value= <?php echo $other_data['FirstName']; ?>></div>
                        <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" id="lastname" placeholder="surname" value= <?php echo $other_data['LastName']; ?>></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Age</label><input type="number" class="form-control" placeholder="enter your age" id="age" value= <?php echo $other_data['Age']; ?>></div>
                        <div class="col-md-12"><label class="labels">Nationality</label>
                            <select class="form-select" id="nationality" required>
                                <?php 
                                    foreach ($nationality as $key => $value) {
                                        if ($other_data['Nationality'] === $value) {
                                            print "<option value='$value'selected>$value</option>";
                                        } else {
                                            print "<option value='$value'>$value</option>";
                                        }
                                        
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-md-12"><label class="labels">Studies</label>
                            <select class="form-select" id="studies" required>
                                <?php 
                                    foreach ($studies as $key => $value) {
                                        if ($other_data['Studies'] === $value) {
                                            print "<option value='$value'selected>$value</option>";
                                        } else {
                                            print "<option value='$value'>$value</option>";
                                        }
                                        
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control"id="email" placeholder="enter email id" value=<?php echo $other_data['Email']; ?>></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Gender</label>
                            <select class="form-select" id="gender" required>
                                <option value="Gender">Gender</option>
                                <option value="Male" <?php if ($other_data['Gender'] === "Male") {print "selected";} ?>>Male</option>
                                <option value="Female" <?php if ($other_data['Gender'] === "Female") {print "selected";} ?>>Female</option>
                                <option value="Other" <?php if ($other_data['Gender'] === "Other") {print "selected";} ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6"><label class="labels">Seeking</label>
                            <select class="form-select" id="seeking" required>
                                <option value="Seeking">Seeking</option>
                                <option value="Male"<?php if ($other_data['Seeking'] === "Male") {print "selected";} ?>>Male</option>
                                <option value ="Female" <?php if ($other_data['Seeking'] === "Female") {print "selected";} ?>>Female</option>
                                <option value="Other" <?php if ($other_data['Seeking'] === "Other") {print "selected";} ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="md-form">
                        <label class="labels" for="description">Description</label>
                        <textarea id="description" class="md-textarea form-control" rows="3"><?php echo $other_data['Description']; ?></textarea>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit" id="SaveProfile">Save Profile</button>
                    </div>
                    <input type="hidden" id="id" name="id" value=<?php echo $other_data[UserId]?>>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <form action="profile.php" method="POST">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Interest</span>
                    <button class="btn btn-primary profile-button" type="submit" id="SaveInterest">Save Interest</button></div><br>
                <div class="col-md-12"><label class="labels">Interest n??1</label>
                    <select class="form-select" id="Interest1" required>
                        <option value=null>Interest n??1</option>
                                <?php 
                                    foreach ($interest as $key => $value) {
                                        if ($Myinterest[0] === $value['id']) {
                                            print "<option value='".$value['id']."'selected>".$value['name']."</option>";
                                        } else {
                                            print "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }
                                        
                                    }
                                 ?>
                    </select>
                </div> <br>
                <div class="col-md-12"><label class="labels">Interest n??2</label>
                    <select class="form-select" id="Interest2" required>
                        <option value= null >Interest n??2</option>
                                <?php 
                                    foreach ($interest as $key => $value) {
                                        if ($Myinterest[1] === $value['id']) {
                                            print "<option value='".$value['id']."'selected>".$value['name']."</option>";
                                        } else {
                                            print "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }
                                        
                                    }
                                 ?>
                    </select>
                </div> <br>
                <div class="col-md-12"><label class="labels">Interest n??3</label>
                    <select class="form-select" id="Interest3" required>
                        <option value=null>Interest n??3</option>
                                <?php 
                                    foreach ($interest as $key => $value) {
                                        if ($Myinterest[2] === $value['id']) {
                                            print "<option value='".$value['id']."'selected>".$value['name']."</option>";
                                        } else {
                                            print "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }
                                        
                                    }
                                 ?>
                    </select>
                </div> <br>
                <div class="col-md-12"><label class="labels">Interest n??4</label>
                    <select class="form-select" id="Interest4" required>
                        <option value=null>Interest n??4</option>
                                <?php 
                                    foreach ($interest as $key => $value) {
                                        if ($Myinterest[3] === $value['id']) {
                                            print "<option value='".$value['id']."'selected>".$value['name']."</option>";
                                        } else {
                                            print "<option value='".$value['id']."'>".$value['name']."</option>";
                                        }
                                        
                                    }
                                 ?>
                    </select>
                </div> <br>
                <input type="hidden" id="id" name="id" value=<?php echo $other_data[UserId]?>>
                </form>

                <button class="btn btn-primary profile-button" type="submit" id="Delete">Delete account</button>
                <br>
                <br>
                <form action="AdminProfile.php" method="POST">
                <?php
                    if($other_data['Banned'] === "1")
                    {
                        print "<button class='btn btn-primary profile-button' type='submit' name='Unban'>Unban account</button>";
                    }
                    else{
                        print "<button class='btn btn-primary profile-button' type='submit' name='Ban'>Ban account</button>";
                    }
                ?>
                <input type="hidden" id="id" name="id" value=<?php echo $other_data[UserId]?>>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(function(){
            $('#SaveProfile').click(function(e){

                var valide = this.form.checkValidity();
                
                if (valide) {
                    e.preventDefault();

                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var email = $('#email').val();
                    var age = $('#age').val();
                    var description = $('#description').val();
                    var gender = $('#gender').val();
                    var seeking = $('#seeking').val();
                    var nationality = $('#nationality').val();
                    var studies = $('#studies').val();
                    var id = $('#id').val();
                    
                    $.ajax({
                            type: 'POST',
                            url: 'uploadProfileAdmin.php',
                            data: {firstname: firstname, lastname: lastname, email: email, studies: studies, age:age, description: description, gender: gender, seeking: seeking, nationality: nationality,id: id},
                            success: function(data) {
                                Swal.fire(
                                 'Success',
                                 data,
                                 'success'
                                )
                                
                            },
                            error: function(data) {
                                Swal.fire(
                                'Errors',
                                'There were errors while saving the data.',
                                'error'
                                )
                            },
                        });
                }

            });

            $('#SaveInterest').click(function(e){

                var valide = this.form.checkValidity();
                
                if (valide) {
                    e.preventDefault();

                    var interest1 = $('#Interest1').val();
                    var interest2 = $('#Interest2').val();
                    var interest3 = $('#Interest3').val();
                    var interest4 = $('#Interest4').val();
                    var id = $('#id').val();
                    
                    $.ajax({
                            type: 'POST',
                            url: 'uploadInterestAdmin.php',
                            data: {interest1: interest1, interest2: interest2, interest3: interest3, interest4: interest4,id: id},
                            success: function(data) {
                                Swal.fire(
                                 data
                                )
                                
                            },
                            error: function(data) {
                                Swal.fire(
                                'Errors',
                                'There were errors while saving the data.',
                                'error'
                                )
                            },
                        });
                }

            });

            $('#Delete').click(function(e){

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $('#id').val();

                        $.ajax({
                            type: 'POST',
                            url: 'DeleteAdmin.php',
                            data: {id: id},
                            success: function(data) {
                                Swal.fire(
                                'Deleted!',
                                data,
                                'success'
                                )
                                
                            },
                            error: function(data) {
                                Swal.fire(
                                'Errors',
                                'There were errors while Deleting the account.',
                                'error'
                                )
                            },
                        });


                    }
                })

            });
    });
</script>

    
</body>
</html>