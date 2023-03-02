<?php
@include 'dbconnection.php';

$query="select * from reports limit 200"; // Fetch all the data from the table customers
$result=mysqli_query($conn,$query);
$locs= array();
    while($array = mysqli_fetch_row($result)) {
        $loc = array(
            "id" => $array['0'],
            "latitude" => $array['1'],
            "longtitude" => $array['2'],
            "description" => $array['3'],
            "image" =>$array['4'],
            "type" =>'Red'
        );
        $locs[] = $loc;
    }


$query="select * from mappoints limit 200"; // Fetch all the data from the table customers
$result=mysqli_query($conn,$query);

    while($array = mysqli_fetch_row($result)) {
        $loc = array(
            "id" => $array['0'],
            "latitude" => $array['1'],
            "longtitude" => $array['2'],
            "description" => $array['3'],
            "type" => "Green"
        );
        array_push($locs, $loc);
    }


echo json_encode($locs);
?>


