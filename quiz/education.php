<?php require_once "../controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imgs/favicon.ico" />
    <title>Project ΚαΠα</title>
    <link rel="stylesheet" href="../styles/education.css"/>
    <link rel="stylesheet" href="../styles/navbar.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <script src="../backbutton.js" defer></script>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
        </label>
        <a href= "../index.php" class="logo">Project ΚαΠα <img class="logo_image" src="../imgs/logo.png" > </a> 
        <ul>
        <li><a href="../achivs.php">About</a></li>
        <li><a class="active"href="education.php">Education</a></li>
        <li><a href="../calendar.php">Calendar</a></li>
        <li><a href="../map_page.php">Services</a></li>
        <?php 
            if (isset($_SESSION['email'])) {
                echo '<li><a href="../dashboard.php">Profile</a></li>';
            } else {
                echo '<li><a href="../login-user.php">Login/Register</a></li>';
            }
        ?>
        </ul>
  </nav> 
  <div class="container">
      <div id="home" class="flex-center flex-column">
        <h1>Quick Quiz</h1>
        <p>Εδώ θα βρείτε ένα μικρό κουίζ, πυο αφορα 3ρ </p>
        <a class="btn" href="./game.php">Play</a>
        <a class="btn" href="/highscores.html">High Scores</a>
      </div>
  </div>
</body>
</html>