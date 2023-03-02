<?php
@include 'dbconnection.php';
require_once "controllerUserData.php";

$query="select * from draseis limit 200"; // Fetch all the data from the table customers
$result=mysqli_query($conn,$query);
$events= array();
    while($array = mysqli_fetch_row($result)) {
        $event = array(
            "id" => $array['0'],
            "title" => $array['1'],
            "description" => $array['2'],
            "start" => $array['3'],
            "url" =>$array['4'],
            "participants" => $array['5'],
            
        );
        $events[] = $event;
    }
echo json_encode($events);
?>


