<?php
include_once 'db_conn.php';

if(isset($_POST["add"])){
        $adminId = $_POST["id"];
        $adminName = $_POST["name"];
        $adminPassword = $_POST["id"];
        $adminPassword = md5($adminPassword);
        $sql0 = "INSERT INTO users (id, username, password, role) VALUES ('$adminId','$adminName','$adminPassword', 'admin')";
        $sql = "INSERT INTO admin (adminId, adminName, adminPassword) VALUES ('$adminId','$adminName','$adminPassword')";
        if (mysqli_query($conn, $sql)) {
                if (mysqli_query($conn, $sql0)) {
                        echo '<script>alert("Added Successfully!")</script>'; 
                        header("refresh:0.1; url=admin.php");
                        exit;}
        } else {
                echo '<script>alert("Add unsuccessfully!")</script>'; 
                        header("refresh:0.1; url=admin.php");
        }
        mysqli_close($conn);
   }

   ?>



