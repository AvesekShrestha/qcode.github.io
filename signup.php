<?php include 'partials/header.php';?>
<?php
include "partials/dbconnect.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $cPassword = $_POST['cPassword'];
    $userName = $_POST['username'];
    
    $existSql = "SELECT * FROM `qlogin` WHERE email = '$userEmail'";
    $existResult = mysqli_query($connect, $existSql);
    $existRow = mysqli_num_rows($existResult);
    
    if($userPassword != $cPassword){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong me-1>Note!  </strong> Invalid Credentials.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        
    }
    else{
        if($existRow > 0){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong me-1>Note!  </strong> Your Email has already been used.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else{
            
                    $passwordHash = password_hash($userPassword,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `qlogin` (`email`, `password`, `c_password`,`user_name`) VALUES ('$userEmail', '$passwordHash', '$passwordHash','$userName')";
                    $result = mysqli_query($connect, $sql);
                    if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong me-1>Note!   </strong> Your account has been created sucessfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
                    else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong me-1>Note!  </strong>Sorry Your account cannot be created due to some technical problems.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            }

        }
    }
?>
<h2 class="text-center mt-5">QCode - Sign Up</h2>

<div class="container-fluid d-flex flex-column justify-content-center align-items-center " style="height:70vh">
    <form class=" g-3" action= "signup.php" method="post" >

        <div class="col ">
            <div class="col mt-5 mb-5">
                <label for="validationDefault02" class="form-label fs-4 fw-bold">Username</label>
                <input type="text" class="form-control" id="validationDefault02" name="username" required>
            </div>

            <label for="validationDefaultUsername" class="form-label fs-4 fw-bold">Email address</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="email" class="form-control" id="validationDefaultUsername"
                    aria-describedby="inputGroupPrepend2" style="width:40vw" ; name="userEmail" required>
            </div>
        </div>
        

        <div class="col mt-5 ">
            <label for="validationDefault01" class="form-label fs-4 fw-bold">Password</label>
            <input type="password" class="form-control" id="validationDefault01" name="userPassword" required>
        </div>
        <div class="col mt-5">
            <label for="validationDefault02" class="form-label fs-4 fw-bold">Confirm Password</label>
            <input type="password" class="form-control" id="validationDefault02" name="cPassword" required>
        </div>

        <div class="col-12 mt-5">
            <button class="btn btn-primary" type="submit">Sign Up</button>
        </div>
    </form>
</div>
<?php include"partials/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
</body>

</html>