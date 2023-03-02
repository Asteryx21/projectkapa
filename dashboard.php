<?php require_once "controllerUserData.php"; ?>
<?php require_once "logged_user.php"; ?>
<?php require_once("dbconnection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
    <title><?php echo $fetch_info['name'] ?> | Dashboard</title>
    <link rel="stylesheet" href="styles/navbar.css"/>
    <link rel="stylesheet" href="styles/dashboard.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
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
                echo '<li><a class="active" href="dashboard.php">Profile</a></li>';
            } else {
                echo '<li><a href="login-user.php">Login/Register</a></li>';
            }
        ?>
        </ul>
    </nav>    
    <div class="box">
        <h1>Welcome <?php echo $fetch_info['name'];?></h1>
        <a href="logout-user.php">Logout</a>
        <?php if($logged_user_type=='Admin'){?>
            <p></p>
        <?php }?>
    </div>
    <div class="chartbox">
        <?php 
        $query = "SELECT d.title, d.description, d.start, d.url 
        FROM draseis d
        INNER JOIN interested r ON d.id = r.drasi_id
        WHERE r.user_id = $user_id";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
        ?>
        <table>
        <caption>Προσεχώμενα events που ενδιαφέρεστε!</caption>
        <thead>
            <tr>
            <th scope="col">Τυπος</th>
            <th scope="col">Περιγραφη</th>
            <th scope="col">Ημερομηνεια</th>
            <th scope="col">Αναρτηση Facebook</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            while($row = $result->fetch_assoc()) 
            { 
                $drasi_title = $row['title'];
                $drasi_description = $row['description'];
                $drasi_date = $row['start'];
                $drasi_url = $row['url'];
            ?> 
            <tr>
            <td data-label="Τυπος"><?php echo $drasi_title ?></td>

            <td scope="row" data-label="Περιγραφη"><?php echo $drasi_description?></td>

            <td scope="row" data-label="Ημερομηνεια"><?php echo $drasi_date ?></td>

            <td scope="row" data-label="Αναρτηση"><a target="blank"href="<?php echo $drasi_url ?>">Πάτα με!</a></td>
            </tr>
            <?php 
               } 
            } else echo "Δέν έχετε δηλώσει ακόμα ενδιαφέρων";
          ?> 
        </tbody>
        </table>
    </div>
    <div class='chartbox'>
        <canvas id="myChart"></canvas>  
    </div>
    
    <script src="dashboard.js"></script>
</body>
</html>