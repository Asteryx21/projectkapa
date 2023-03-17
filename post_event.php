<?php
require "dbconnection.php";

$errors = array();
$event_title = $_POST['inputTitle'];
$event_date = $_POST['inputDate'];
$event_descr = $_POST['inputDescription'];
$event_url = 'https://www.facebook.com/';
$event_participants = 0;

$insert = $conn->query("INSERT draseis (title,description,start,url,participants) VALUES ('".$event_title."','".$event_descr."','".$event_date."','".$event_url."','".$event_participants."')");
if($insert){
    echo "ez pz";
}else{
    $errors['db-error'] = "Failed while inserting data into database!";
}

?>