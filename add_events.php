<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'dbconfig.php';
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUrl = $_SERVER['REQUEST_URI'];

if ($requestMethod == "POST" && $requestUrl == "/allevents_project/add_events.php/create-event") {
    $eventInput = json_decode(file_get_contents("php://input"), true);
    global $conn;
    $event_name = mysqli_real_escape_string($conn, $eventInput['event_name']);
    $start_date = mysqli_real_escape_string($conn, $eventInput['start_date']);  
    $end_date = mysqli_real_escape_string($conn, $eventInput['end_date']);  
    $location = mysqli_real_escape_string($conn, $eventInput['location']);  
    $description = mysqli_real_escape_string($conn, $eventInput['description']);  
    $category = mysqli_real_escape_string($conn, $eventInput['category']);  
    $banner_image = mysqli_real_escape_string($conn, $eventInput['banner_image']);  

    if (
        !isset($eventInput['event_name']) || 
        !isset($eventInput['start_time']) || 
        !isset($eventInput['end_time']) || 
        !isset($eventInput['location']) || 
        !isset($eventInput['description']) || 
        !isset($eventInput['category']) || 
        !isset($eventInput['banner_image'])
    ){
        exit();
    }
    else {
        $query = "INSERT INTO events (event_name, start_date, end_date, location, description, category, banner_image) VALUES ('$event_name', '$start_time', '$end_time', '$location', '$description', '$category', '$banner_image')";
        $result = mysqli_query($conn, $query);

        if($result) {
            header("HTTP/1.0 201 Created");
            echo "Event added successfully";
        }
        else {
            header("HTTP/1.0 500 Internal Server Error");
            echo "Cannot add event";
        }
    }
} else {
    echo "Invalid endpoint or request method";
}

?>
