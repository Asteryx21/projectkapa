<?php 
@include 'dbconnection.php';
require_once 'controllerUserData.php';
@include 'logged_user.php';


$results_array = array();

$sql = "SELECT usertable.name, COUNT(*) as count FROM usertable INNER JOIN interested ON usertable.id = interested.user_id GROUP BY usertable.name";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Loop through each row and add a new object to the array with the name and count properties
    while ($row = $result->fetch_assoc()) {
        $result_object = new stdClass();
        $result_object->name = $row["name"];
        $result_object->count = $row["count"];
        array_push($results_array, $result_object);
    }
} else {
    echo "No results found.";
}

// Encode the array into JSON format and output it
$json_output = json_encode($results_array);
echo $json_output;

?>