<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'dbconfig.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUrl = $_SERVER['REQUEST_URI'];

if ($requestMethod == "GET" && $requestUrl == "/allevents_project/getfilteredevents.php/get-filtered-events") {
    $city = isset($_GET['city']) ? mysqli_real_escape_string($conn, $_GET['city']) : '';
    $category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
    $date = isset($_GET['date']) ? mysqli_real_escape_string($conn, $_GET['date']) : '';

    $query = "SELECT * FROM events";

    if (!empty($city)) {
        $query .= " AND location = '$city'";
    }

    if (!empty($category)) {
        $query .= " AND category = '$category'";
    }

    if (!empty($date)) {
        $dateParts = explode('/', $date);
        if (count($dateParts) == 3) {
            $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
            $query .= " AND start_time >= '$formattedDate'";
        }
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        $events = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }

        echo json_encode(["events" => $events]);
    } else {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Failed to fetch events";
    }
}

?>
