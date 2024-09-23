<?php
$servername = "localhost";
$username = "root";
$password = "dusgur3608!";
$dbname = "subway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}