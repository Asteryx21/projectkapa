<?php require_once "../controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imgs/favicon.ico" />
    <title>Project ΚαΠα</title>
    <link rel="stylesheet" href="../styles/game.css"/>
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
      <div id="game" class="justify-center flex-column hidden">
        <div id="hud">
          <div id="hud-item">
            <p id="progressText" class="hud-prefix">
              Ερώτηση
            </p>
            <div id="progressBar">
              <div id="progressBarFull"></div>
            </div>
          </div>
          <div id="hud-item">
            <p class="hud-prefix">
              Σκορ
            </p>
            <h1 class="hud-main-text" id="score">
              0
            </h1>
          </div>
        </div>
        <h2 id="question"></h2>
        <div class="choice-container">
          <p class="choice-prefix">1</p>
          <p class="choice-text" data-number="1"></p>
        </div>
        <div class="choice-container">
          <p class="choice-prefix">2</p>
          <p class="choice-text" data-number="2"></p>
        </div>
        <div class="choice-container">
          <p class="choice-prefix">3</p>
          <p class="choice-text" data-number="3"></p>
        </div>
        <div class="choice-container">
          <p class="choice-prefix">4</p>
          <p class="choice-text" data-number="4"></p>
        </div>
      </div>
    </div>
  <script src="education.js"></script>
</body>
</html>