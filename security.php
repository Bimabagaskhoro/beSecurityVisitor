<?php
require_once "conn.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function loginSecurity()
{
    global $connect;
    if (!empty($_GET["email"]) && !empty($_GET["passwd"])) {
        $email = $_GET["email"];
        $passwd = $_GET["passwd"];
    }

    $query = "SELECT * FROM user WHERE 
            email = '$email' AND 
            passwd = '$passwd'";
    $result = $connect->query($query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'get data succeed',
            'data' => $data);
    } else {
        $response = array(
            'status' => 0,
            'message' => 'no data found'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function getAllSecurity()
{
    global $connect;
    $query = $connect->query("SELECT * FROM user");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Success',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>