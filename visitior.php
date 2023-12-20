<?php
require_once "conn.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function insertVisitor()
{
    global $connect;
    $check = array(
        'id' => '',
        'security_name' => '',
        'no_plat' => '',
        'createAt' => '',
        'updateAt' => '',
        'tujuan' => '',
        'jadwal_satpam' => '',
        'status_visitor' => '');
    $check_match = count(array_intersect_key($_POST, $check));
    if ($check_match == count($check)) {

        $result = mysqli_query($connect, "INSERT INTO visitor SET
             id = '$_POST[id]',
             security_name = '$_POST[security_name]',
             no_plat = '$_POST[no_plat]',
             createAt = '$_POST[createAt]',
             updateAt = '$_POST[updateAt]',
             tujuan = '$_POST[tujuan]',
             jadwal_satpam = '$_POST[jadwal_satpam]',
             status_visitor = '$_POST[status_visitor]'");

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Insert Success'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Insert Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Wrong Parameter'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function updateVisitor()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
    }
    $check = array(
        'security_name' => '',
        'no_plat' => '',
        'createAt' => '',
        'updateAt' => '',
        'tujuan' => '',
        'jadwal_satpam' => '',
        'status_visitor' => '');

    $check_match = count(array_intersect_key($_POST, $check));
    if ($check_match == count($check)) {
        $result = mysqli_query($connect, "UPDATE visitor SET               
         security_name = '$_POST[security_name]',
         no_plat = '$_POST[no_plat]',
         createAt = '$_POST[createAt]',
         updateAt = '$_POST[updateAt]',
         tujuan = '$_POST[tujuan]',
         jadwal_satpam = '$_POST[jadwal_satpam]',
         status_visitor = '$_POST[status_visitor]' WHERE id = $id");

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Update Success');
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Update Failed');
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Wrong Parameter',
            'data' => $id);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function getAllVisitor()
{
    global $connect;
    $query = $connect->query("SELECT * FROM visitor");
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

function getAllVisitorById()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
    }

    $query = "SELECT * FROM visitor WHERE id= $id";
    $result = $connect->query($query);
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    if ($data) {
        $response = array(
            'status' => 1,
            'message' => 'Success',
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'No Data Found'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function deleteVisitor()
{
    global $connect;
    $id = $_GET['id'];
    $query = "DELETE FROM visitor WHERE id=" . $id;
    if (mysqli_query($connect, $query)) {
        $response = array(
            'status' => 1,
            'message' => 'Delete Success'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Delete Fail.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>