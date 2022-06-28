<?php
include_once 'db_conn.php';

if(isset($_POST["add"])){
        $option1 = $_POST["id"];
        $option2 = $_POST["name"];

        $sql = "INSERT INTO workload (sbjCode, lecturerId) 
                SELECT DISTINCT subject.sbjCode, lecturer.lecturerId 
                FROM subject INNER JOIN lecturer 
                ON lecturer.lecturerName = '$option1' AND subject.sbjName = '$option2'";
        
        if(mysqli_query($conn, $sql)){
                echo '<script>alert("Added Successfully!")</script>'; 
                header("refresh:0.1; url=registerworkload.php");
        
        } else {
                echo '<script>alert("Added unsuccessfully!")</script>'; 
                header("refresh:0.1; url=registerworkload.php");
        }
    
        mysqli_close($conn);
    }
   ?>




