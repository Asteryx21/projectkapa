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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js"></script>

    <!-- moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Font awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/solid.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/fontawesome.min.js"></script>

    <!-- Tempus dominus -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.10/js/tempus-dominus.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.10/css/tempus-dominus.min.css" rel="stylesheet" />

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
    <script src="backbutton.js" defer></script>
    <style>
        .alert {
            display: none;
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
            <button class="btn"id='addevent'>Προσθήκη δράσης στο ημερολόγιο</button>
        <?php }?>
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
            <div class="alert alert-success text-center"></div> 
            <form id="form" action="" method="POST">
            <!-- Input for Title -->
            <div class="form-group">
                <label for="inputTitle">Τύπος</label>
                <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="πχ. Δράση, ενημέρωση, συγκέντρωση ή κάποιο άλλο event" required>
            </div>
            <!-- Input for Datepicker -->
            <div class="form-group">
                <label for="inputDate">Ημερομηνία</label>
                <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" name="inputDate" id="inputDate"  placeholder="Χρόνος-μήνας-μέρα" required readonly>
                    
                </div>
            </div>
            <!-- Input for Description -->
            <div class="form-group">
                <label for="inputDescription">Περιγραφή</label>
                <textarea class="form-control" name="inputDescription" id="inputDescription" rows="3" placeholder="Μίρκη περιγραφή" required></textarea  >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel-btn">Cancel</button>
                <input class="btn btn-primary submitBtn" name="up_event" type="submit" value="Upload" >
            </div>
            </form>
        </div>
    

        </div>
    </div>
    </div>
    <div class="overlay hidden"></div>

    <div class="chartbox ">
        <?php 
        $query = "SELECT d.title, d.description, d.start, d.url 
        FROM draseis d
        INNER JOIN interested r ON d.id = r.drasi_id
        WHERE r.user_id = $user_id";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
        ?>
        <table>
        <h3>Έχετε δηλώσει ενδιαφέρων</h3>
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