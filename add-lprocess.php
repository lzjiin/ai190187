<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
    header("location: index.php?error=Please login first!");
}
require 'db_conn.php';

if(isset($_POST["add"])){
        $lecturerId = $_POST["id"];
        $lecturerName = $_POST["name"];
        $adminName = $_SESSION["username"];
        $lecturerPassword = $_POST["id"];
        $lecturerPassword = md5($lecturerPassword);
        $sql0 = "INSERT INTO users (id, username, password, role) VALUES ('$lecturerId','$lecturerName','$lecturerPassword', 'lecturer')";
        $sql = "INSERT INTO lecturer (lecturerId, lecturerName, lecturerPassword, adminName) 
                VALUES ('$lecturerId','$lecturerName','$lecturerPassword','$adminName')";
        if (mysqli_query($conn, $sql)) {
                if (mysqli_query($conn, $sql0)) {
                echo '<script>alert("Added Successfully!")</script>'; 
                header("refresh:0.1; url=registerlecturer.php");
                exit;}
        } else {
                echo '<script>alert("Added unsuccessfully! Data inserted has been used already!")</script>'; 
                        header("refresh:0.1; url=registerlecturer.php");
        }
        mysqli_close($conn);
   }

   ?>



