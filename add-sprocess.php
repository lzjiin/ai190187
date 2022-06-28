<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
    header("location: index.php?error=Please login first!");
}
require 'db_conn.php';

if(isset($_POST["add"])){
        $studentEmail = strtolower($_POST["id"])."@siswa.uthm.edu.my";

        $studentId = $_POST["id"];
        $studentName = $_POST["name"];
        
        $adminName = $_SESSION["username"];
        $studentPassword = $_POST["id"];
        $studentPassword = md5($studentPassword);
        $sql0 = "INSERT INTO users (id, username, password, role) VALUES ('$studentId','$studentName','$studentPassword', 'student')";
        $sql = "INSERT INTO student (studentId, studentName, studentPassword, studentEmail, adminName) 
                VALUES ('$studentId','$studentName','$studentPassword','$studentEmail', '$adminName')";
        if (mysqli_query($conn, $sql)) {
                if (mysqli_query($conn, $sql0)) {
                echo '<script>alert("Added Successfully!")</script>'; 
                header("refresh:0.5; url=registerstudent.php");
                exit;}
        } else {
                echo '<script>alert("Add unsuccessfully!")</script>'; 
                        header("refresh:0.1; url=registerstudent.php");
        }
        mysqli_close($conn);
   }

   ?>



