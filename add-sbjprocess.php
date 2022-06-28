<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
    header("location: index.php?error=Please login first!");
}
require 'db_conn.php';

if(isset($_POST["add"])){
        $sbjCode = $_POST["id"];
        $sbjName = $_POST["name"];
        $adminName = $_SESSION["username"];
        $sql = "INSERT INTO subject (sbjCode, sbjName, adminName) VALUES ('$sbjCode','$sbjName','$adminName')";
        if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Added Successfully!")</script>'; 
                header("refresh:0.1; url=registersubject.php");
                exit;
        } else {
                echo '<script>alert("Add unsuccessfully!")</script>'; 
                        header("refresh:0.1; url=registersubject.php");
        }
        mysqli_close($conn);
   }

   ?>



