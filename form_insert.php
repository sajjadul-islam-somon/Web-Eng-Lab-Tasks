<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $licensePlate = $_POST['licensePlate'];
    $ipaddress = $_POST['ipaddress'];
    $hexcode = $_POST['hexcode'];

    $query = "INSERT INTO signupdata (username, password, licensePlate, ipaddress, hexcode) 
              VALUES ('$username', '$password', '$licensePlate', '$ipaddress', '$hexcode')";
    $run = mysqli_query($con, $query);

    if ($run) {
        $_SESSION['current_username'] = $username; // Save current username in session
        header("Location: blog_page.php");
        exit(); // important to stop script execution after redirect
    } else {
        echo "Signup failed. Please try again.";
    }
}
?>
