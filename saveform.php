<?php
require 'connection.php';

$name = mysqli_real_escape_string($mysqli, $_REQUEST['name']);
$lat = mysqli_real_escape_string($mysqli, $_REQUEST['latitude']);
$lng = mysqli_real_escape_string($mysqli, $_REQUEST['longitude']);
$description = mysqli_real_escape_string($mysqli, $_REQUEST['description']);
$date = date("Y-m-d H:i:s");

// Attempt insert query execution
$sql = "INSERT INTO mapmarkers(name, lat, lng, description, date) VALUES ('$name', '$lat', '$lng', '$description', '$date')";
if (mysqli_query($mysqli, $sql)) {
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
} else {
echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}

// Close connection
mysqli_close($mysqli);