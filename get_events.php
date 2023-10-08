<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_events') {
    $query = "SELECT * FROM events";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode(["error" => "Failed to fetch events"]);
        exit();
    }

    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }

    echo json_encode(["events" => $events]);
    exit();
}

?>
