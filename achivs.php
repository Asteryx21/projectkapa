<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
    <title>Σχετικά με εμάς</title>
    <link rel="stylesheet" href="styles/achivs.css">
    <link rel="stylesheet" href="styles/navbar.css" />  
    <link rel="stylesheet" href="styles/slideshow.css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
</head>
<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
    </label>
    <a href= "index.php" class="logo">Project ΚαΠα <img class="logo_image" src="imgs/logo.png" > </a> 
    <ul>
    <li><a class='active' href="achivs.php">About</a></li>
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

    <div class="services" id="services">
      <h1 >Τι έχουμε καταφέρει</h1>
      <video class="video" controls autoplay> <source src="imgs/movie.mp4" type="video/mp4" data-keepplaying ></video>
      <div class="services__wrapper">
        <div class="services__card">
          <h2>TEDxPatras</h2>
          <p>Η ομάδα του Project Κα.Πα ήταν καλεσμνένοι το Σάββατο 8 Οκτωβρίου 2022 στο TEDx Patras στο συνεδριακό κέντρο του πανεπιστημίου Πατρών. 
          Εκεί είχε στειθεί ανάλογο περίπτερο της ομάδας.</p>
          <div class="services__btn"><a href="https://www.facebook.com/project.kapa/posts/538659874926221" target="_blank"><button >Περισσότερα</button></a></div>
        </div>
        <div class="services__card">
          <h2>Dixan</h2>
          <p>❤❤ Μόνο Dixan ❤❤ <br> Κάτι για εδω;</p>
          <div class="services__btn"><button>Something here</button></div>
        </div>
        <div class="services__card">
          <h2>Πρωσοπα της χρονίας</h2>
          <p>Η Εφημερίδα Πελοπόννησος  και τα Πρόσωπα της Χρονιάς έφτιαξαν μια πολύ όμορφη και φωτεινή βραδιά, στην οποία η ομάδα μας απέσπασε το βραβείο στην κατηγορία ομάδες - κοινωνία! </p>
          <div class="services__btn"><a href="https://www.facebook.com/prosopaxronias.gr/videos/256947546591682" target="_blank"><button>Βίντεο απονομής</button></a></div>
        </div>
        <div class="services__card">
          <h2>Εφημερίδα Πελοπόνησος</h2>
          <p>Κάτι για εδω; </p>
          <div class="services__btn"><button>Something here</button></div>
        </div>
      </div>
   </div>
 
  <section id="section_counter">
      <div class="container2">
        <div class="counter-grid">     
          <div class="counter-item">
          <p class='text'>Έχουν γίνει</p>
            <i class="fas fa-history counter-img"></i>
            <h1 class="counter" data-target="50">0</h1>
            <span class="text">Δράσεις</span>
          </div>
          <div class="counter-item">
          <p class='text'>Με τη βοήθεια</p>
            <i class="fa-solid fa-users counter-img"></i>
            <h1 class="counter" data-target="190">0</h1>
            <span class="text">Εθελοντών</span>
          </div>
          <div class="counter-item">
          <p class='text'>Έχουμε συλλέξει</p>
            <i class="fa-solid fa-trash counter-img"></i>
            <h1 class="counter" data-target="10000">0</h1>
            <span class="text">LT. Σκουπίδια</span>
          </div>
        </div>
      </div>
    </section>
    
    <swiper-container class="mySwiper" navigation="true">
   
      <swiper-slide><img src="imgs/slides/slide1.jpg"></swiper-slide>
      <swiper-slide><img src="imgs/slides/slide2.jpg"></swiper-slide>
      <swiper-slide><img src="imgs/slides/slide3.jpg"></swiper-slide>
      <swiper-slide><img src="imgs/slides/slide4.jpg"></swiper-slide>
      <!-- <swiper-slide><img src="imgs/slides/slide5.jpg"></swiper-slide> -->
      <swiper-slide><img src="imgs/slides/slide6.jpg"></swiper-slide>
      <swiper-slide><img src="imgs/slides/slide7.jpg"></swiper-slide>
    </swiper-container>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
    <script src="count_up.js"></script>
</body>
</html>