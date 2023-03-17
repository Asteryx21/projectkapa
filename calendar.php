<?php  
@include 'dbconnection.php';
@include "controllerUserData.php";
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($conn, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $user_id = $fetch_info['id'];
        $logged_user_type = $fetch_info["user_type"];
    }
}
if (isset($_POST['interested'])){
    $eventid = $_POST['eventid'];

    $result = mysqli_query($conn, "SELECT * FROM draseis WHERE id=$eventid");

    $row = mysqli_fetch_array($result);
    $n = $row['participants'];

    mysqli_query($conn, "INSERT INTO interested (user_id, drasi_id) VALUES ($user_id, $eventid)");

    mysqli_query($conn, "UPDATE draseis SET participants=$n+1 WHERE id=$eventid");
    echo $n+1;
    exit();
}

if (isset($_POST['uninterested'])) {
    $eventid = $_POST['eventid'];

    $result = mysqli_query($conn, "SELECT * FROM draseis WHERE id=$eventid");

    $row = mysqli_fetch_array($result);
    $n = $row['participants'];

    mysqli_query($conn, "DELETE FROM interested WHERE drasi_id=$eventid AND user_id=$user_id");
    mysqli_query($conn, "UPDATE draseis SET participants=$n-1 WHERE id=$eventid");
    
    echo $n-1;
    exit();
}
$draseis = mysqli_query($conn, "SELECT * FROM draseis");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
    <title>Δράσεις</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
    <link rel="stylesheet" href="styles/accordion.css">
    <link rel="stylesheet" href="styles/calendar.css">
    <link rel="stylesheet" href="styles/navbar.css" />  
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="backbutton.js" defer></script>
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
        <li><a class='active' href="calendar.php">Calendar</a></li>
        <li><a href="map_page.php">Services</a></li>
        <?php 
            if (isset($_SESSION['email'])) {
                echo '<li id="logged_in"><a href="dashboard.php">Profile</a></li>';
            } else {
                echo '<li><a href="login-user.php">Login/Register</a></li>';
            }
        ?>
        </ul>
    </nav>
    <div id='calendar'></div>
    <?php if (isset($_SESSION['email'])) { ?>
    <div id='placeholder'>
        <?php while ($row = mysqli_fetch_array($draseis)) { ?>
            <section class="modal hidden modal<?php echo $row['id']; ?>">
                <div class="flex">
                <h3 id="eventid"><?php echo$row['title'];// echo $row['id']; ?></h3>
                <button class="btn-close btn-close<?php echo $row['id']; ?>">⨉</button>
                </div>
                <div>
                    <p id="descr"><?php echo $row['description']; ?></p>
                    <p id="intr">Ενδιαφερόμενοι: <?php echo $row['participants']; ?></p>
                </div>
                <?php 
                $results = mysqli_query($conn, "SELECT * FROM interested WHERE user_id=$user_id AND drasi_id=".$row['id']."");
                if (mysqli_num_rows($results) == 1): ?>
                    <!-- user already likes post -->
                    <button type="button" class="uncf btn" data-id="<?php echo $row['id']; ?>">Remove</button>
                    <button type="button" class="cnf btn hidden" data-id="<?php echo $row['id']; ?>">Interested</button>
                <?php elseif (mysqli_num_rows($results)==0): ?>
                    <!-- user has not yet liked post -->
                    <button type="button" class="uncf btn hidden" data-id="<?php echo $row['id']; ?>">Remove</button>
                    <button type="button" class="cnf btn" data-id="<?php echo $row['id']; ?>">Interested</button>

                <?php endif ?>

            </section>
        <?php } ?>
    </div>
    <?php }else {?>
        <section class="modal hidden">
                <div class="flex">
                <h3 id="eventid"></h3>
                <button class="btn-close">⨉</button>
                </div>
                <div>
                    <p id="descr"></p>
                    <p id="intr"></p>
                </div>
        </section>

    <?php } ?>
    <div class="overlay hidden"></div>
    <section class='accordion'>
        <h1>Συμβουλές για τους ενδιαφερομενους εθελοντες!</h1>
        <ul>
            <li>
                <input type="checkbox" checked class='abc'>
                <i></i>
                <h2>Τι φέρνουμε μαζί μας</h2>
                <p>• Γάντια κήπου  (ΌΧΙ μιας χρήσης, καθώς υπάρχουν αιχμηρά αντικείμενα και γυαλιά στα σημεία αυτά) <br>
                    • Σακούλες <br>
                    • Νερό (Προτιμήστε παγούρι) <br>
                    • Τη καλή μας διάθεση</p>
            </li>
            <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>Πως δρούμε</h2>
                <p>Ακούμε τον Σπύρο και την Μαρία 😂</p>
            </li>
            <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>Κάτι εδώ;</h2>
                <p>Κάτι εδώ;</p>
            </li>
        </ul>           
    </section>
</body>
<script src="calendar.js"></script>  
</html>


