<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
    <title>Project ΚαΠα</title>
    <link rel="stylesheet" href="styles/home.css"/>
    <link rel="stylesheet" href="styles/navbar.css"/>
    <link rel="stylesheet" href="styles/footer.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <script src="home.js" defer></script>
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
            echo '<li><a href="login-user.php">Login/Register</a></li>';
        }
    ?>
    </ul>
  </nav>   
  <!-- xd projectkapaaa -->
  <div class="description hidden">
      <div class="desc">
        <h1>Δεν φοράνε όλοι οι ήρωες ΚαΠα</h1>
        <p>Το Project ΚαΠα είναι μια ομάδα εθελοντών που πραγματοποιεί καθαρισμούς σε δημόσιους χώρους πρασίνου, σε πάρκα και σε ακτές παραλιών της
          Πάτρας και των γύρω περιοχών.
          <br>
          <br>  
          Σκοπός της σελίδας αυτής είναι να ενημερώνουμε για τις δράσεις που κάναμε αλλά και να οργανώνουμε μαζί τις επόμενες!
          <br> 
        </p>
      </div>
      <img src="imgs/Picture1.jpg" class="img_frame">  
  </div>

  <div class="reverse hidden">
    <img src="imgs/Picture2.jpg" class="img_frame">
    <div class="desc">
      <h1>Τα σκουπίδια είναι φίλοι μας!</h1>
      <p>Η κάθε δράση είναι σημαντική ασχέτως το μέγεθός της!
Φόρα τα γάντια σου, πάρε στικάκι και σακούλες και ξεκίνα από τα πιο κοντινά και μικρά σημεία. <br>Το πάρκο της γειτονιάς σου, το απέναντι πεζοδρόμιο..αρκεί απλώς να δώσεις σημασία ακόμα και στο πιο φαινομενικά ασήμαντο σκουπίδι!</p>
    </div>
  </div>
  
  <div class="description hidden">
    <div class="desc">
      <h1>Δεν κάνει κόπο, κάνει ΚαΠα!</h1>
      <p>Μπορείς πλέον και εσύ να συνεισφέρεις στο να έχουμε μια πιο καθαρή πόλη και να γίνεις ο νέος τοπικός σούπερ ήρωας. Κάνε γρήγορα και εύκολα αναφορά μιας μολυσμένης περιοχής! <br><b>Γίνε μέλος της ομάδας μας σήμερα!</b>
      </p>
    </div>
    <img src="imgs/Picture3.jpg" class="img_frame">
  </div>

  <div class="dotted-lines">
    <div style="position: absolute; z-index:-1;">
      <svg width="210.6000213623047" height="78.00624084472656" overflow="auto" style="position: absolute; left: 38em; top: -155em; pointer-events: none;">
        <path d="M 25 25 C 89.04000854492188 24, 121.56001281738281 54.00624084472656, 186.6000213623047 54.00624084472656" stroke="#4ECE2A" stroke-dasharray="20 15" stroke-width="6" fill="transparent" pointer-events="visibleStroke"></path>
      </svg>
    </div>
    <div style="position: absolute; z-index:-1;">
      <svg width="561.8967544126957" height="434.4961498439126" overflow="auto" style="position: absolute; left: 41em; top: -120em; pointer-events: none;" class="">
      <path d="M 537.8967544126957 32.49614984391259 C 537.8967544126957 89.1961498439126, 110.68673625473673 410.4961498439126, 35.29673305039103 410.4961498439126" stroke="#4ECE2A" stroke-dasharray="20 15" stroke-width="6" fill="transparent" pointer-events="visibleStroke">
      </path>
      </svg>
    </div>
    <div style="position: absolute; z-index: -1;">
      <svg width="573.1657366071429" height="495.21632653061226" overflow="auto" style="position: absolute; left: 19em; top: -65em; pointer-events: none;">
        <path d="M 24 43.21632653061225 C 24 128.81632653061226, 426.08001708984375 471.21632653061226, 526.6000213623047 471.21632653061226" stroke="#4ECE2A" stroke-dasharray="20 15" stroke-width="6" fill="transparent" pointer-events="visibleStroke">
        </path>
      </svg>
    </div>

  </div>



  <footer class="footer">
  	 <div class="container">
  	 	<div class="row">
  	 		<div class="footer-col">
  	 			<h4>team</h4>
  	 			<ul>
  	 				<li><a href="achivs.php">about us</a></li>
  	 				<li><a href="map_page.php">our services</a></li>
  	 				<li><a href="#">privacy policy</a></li>
  	 				
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>follow us</h4>
  	 			<div class="social-links">
  	 				<a href="https://www.facebook.com/project.kapa" target="_blank"><i class="fab fa-facebook-f"></i></a>
  	 				<a href="https://www.instagram.com/project_kapa/?hl=el" target="_blank"><i class="fab fa-instagram"></i></a>
  	 			</div>
  	 		</div>
         <div class="footer-col">
  	 			<h4>powered by</h4>
  	 			<ul>
            <img class="footer_img" src="imgs/logo.png" >
            <a href="https://saveyourhood.gr/" class='nohover' target="blank"><img class="footer_img" src="imgs/save_your_hood.png"></a>
  	 			</ul>
  	 		</div> 
  	 	</div>
  	 </div>
  </footer>
</body>
</html>