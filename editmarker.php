<?php
require 'connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$lat = $_POST['latitude'];
$lng = $_POST['longitude'];
$date = date("Y-m-d H:i:s");

if (isset($_POST['delete']) && $_POST['delete'] == 'delete') {
    $delete = "DELETE FROM mapmarkers WHERE id = '$id'";

    if ($mysqli->query($delete) === TRUE) {
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
} elseif (isset($_POST['update']) && $_POST['update'] == 'update') {
    $update = "UPDATE mapmarkers SET name = '$name', lat = '$lat', lng = '$lng', description = '$description', date = '$date'  WHERE id = '$id'";

    if ($mysqli->query($update) === TRUE) {
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}