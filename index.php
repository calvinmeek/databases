<?php
$servername = "web0.site.uottawa.ca:15432";
$username = "cmeek070";
$password = "R964nsm4xt";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>