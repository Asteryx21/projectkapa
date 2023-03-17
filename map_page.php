<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
    <title>Χάρτες</title>
    <link rel="stylesheet" href="styles/map_page_css.css" />
    <link rel="stylesheet" href="styles/navbar.css"/>
    <link rel="stylesheet" href="styles/upload_form.css"/>
    <link rel="stylesheet" href="L.Control.Sidebar.css"/>
    <link rel="stylesheet" href="L.Control.Sidebar.scss"/>
    <link rel="stylesheet" href="L.Control.Locate.min.css"/>
    <link rel ="stylesheet" href ="styles/MarkerCluster.Default.css"/>
    <link rel ="stylesheet" href ="styles/MarkerCluster.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.min.css"/>
   
    <script src="backbutton.js" defer></script>
    <style>
    .leaflet-bar button {
        height: 4em !important; /* easyButton's height default */
        width: 4.3em !important;  /*  easyButton's width default */
    }
    </style>
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
        <li><a class='active' href="map_page.php">Services</a></li>
        <?php 
            if (isset($_SESSION['email'])) {
                echo '<li id="logged_in"><a href="dashboard.php">Profile</a></li>';
            } else {
                echo '<li><a href="login-user.php">Login/Register</a></li>';
            }
        ?>
        </ul>
    </nav>   
   
    <div id="map"></div><div id="sidebar"></div>
    <button class="fa-regular fa-circle-question" onclick= "Tips()" id="tips"></button>
    <div class="center hideform">    
        <button id="close" style="float: right;">X</button>
        <form id="form" action="reportup.php" method="post" enctype="multipart/form-data">
            <label for="fname">Συντεταγμένες:</label>
            <input type="text" id="coords" name="coords" placeholder="Click on the map!" required readonly >
            <label for="subject">Περιγραφή:</label>
            <textarea id="subject" name="subject" placeholder="Γράψτε εδώ..." style="height:200px" required></textarea>
            <br>
            <input id="uploadImage" type="file" accept="image/*" name="image" />
            <input class="btn btn-success submitBtn" type="submit" value="Upload" >
            
            <!-- Progress bar -->
            <div class="progress">
                <div class="progress-bar"></div>
            </div>
            <div class="statusMsg"></div>
        </form>
    </div>
    <div class="modal hideform">     
        <img id='enlarged_img' src="">
        <button class="btn-close">⨉</button> 
    </div>
    <section class="modalTips hideform">
        <div class="flex">
            <h3>Οδηγίες αναφοράς μίας περιοχή με σκουπίδια!</h3>
        </div>
        <div>
            <p id="descr">
            <b>Βήμα 1:</b> Βρείτε προσσεγιστικά στο χάρτη το σημείο που θέλετε να αναφέρετε.<br>
            <b>Βήμα 2:</b> Πατήστε στο επιθυμητό σημείο για να τοποθετήσετε μια μπλε "πινέζα". <br>
            <b>Βήμα 3:</b> Πατήστε πάνω στη μπλε πινέζα που τοποθετήσατε για να εμφανηστεί η φόρμα αναφοράς.<br>
            <b>Βήμα 4:</b> Συμπληρώστε τη φόρμα που θα εμφανηστεί.<br>
            <b>-</b> Στο πεδίο της περιγγραφής μπορείτε για παράδειγμα να γράψετε: <u>Τι είδους σκουπίδια βρήκατε ή που ακριβώς είναι το μέρος που εντοπίσατε!</u>.<br>
            <b>-(προαιρετικό)</b> Ανεβάστε μια φωτογραφία από το μέρος που βρήκατε τα σκουπίδια πατώντας το κουμπί "Choose File".<br>
            <b>Βήμα 5:</b> Τέλος πατήστε το κουμπί "Upload" για να μας στείλετε τις πληροφορίες που μώλις συμπληρώσατε!<br>
            <b>Βήμα 6 (ΥΠΟΧΡΕΟΤΙΚΟΤΑΤΟ):</b> Ελάτε μαζί μας στην δράση 💚!<br> 
            </p>
        </div>
        <button type="button" class="tips_btn">OK</button>
    </section>

    <div class="modalLogin hideform">
        <h3>Πρώτα πρέπει να συνδεθείτε με το λογαριασμό σας.</h3>
        <button type="button" class="ok_btn">OK</button>
    </div>

    <div class="overlay hideform"></div> 

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.min.js"></script>
    <script src="L.Control.Locate.min.js"></script>
    <script src="leaflet.markercluster.js"></script>
    <script src="L.Control.Sidebar.js"></script>
    <script src="map.js"></script>
    <script src="report.js"></script>   
</body>
</html>

