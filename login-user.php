<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="styles/navbar.css"/>
    <link rel="stylesheet" href="styles/login.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
        </label>
        <a href= "index.php" class="logo">Project ΚαΠα <img class="logo_image" src="imgs/logo.png" > </a> 
        <ul>
        <li><a href="achivs.php">About</a></li>
        <li><a href="./quiz/education.php">Education</a></li>
        <li><a href="calendar.php">Calendar</a></li>
        <li><a href="map_page.php">Services</a></li>
        <?php 
            if (isset($_SESSION['email'])) {
                echo '<li><a href="dashboard.php">Profile</a></li>';
            } else {
                echo '<li><a class="active" href="login-user.php">Login/Register</a></li>';
            }
        ?>
        </ul>
    </nav>   
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Φόρμα σύνδεσης</h2>
                    <p class="text-center">Συνδεθείτε με το e-mail σας και τον κωδικό σας.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Ξεχάσατε τον κωδικό σας;</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Σύνδεση">
                    </div>
                    <div class="link login-link text-center">Δεν έχετε λογαριασμό; <a href="signup-user.php">Εγγραφή εδώ!</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>