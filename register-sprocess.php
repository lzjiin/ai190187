<?php
session_start();
include_once 'db_conn.php';
if(!isset($_SESSION['username'])||$_SESSION['role']!="student"){
        header("location: index.php?error=Please login first!");
    }

if(isset($_POST["register"])){
        $username = $_SESSION['username'];

        $sql = "INSERT INTO registered_subject (sbjCode, lecturerId, studentId) 
                SELECT DISTINCT workload.sbjCode, workload.lecturerId, student.studentId 
                FROM workload INNER JOIN student
                WHERE student.studentName = '$username' 
                AND workload.workloadId = '$_GET[id]'";
                
        
        if(mysqli_query($conn, $sql)){        
                echo '<script>alert("Registered Successfully!")</script>'; 
                header("refresh:0.1; url=student.php");
        } else {
                echo '<script>alert("Registered Unsuccessfully! You already registered the subject!")</script>'; 
                header("refresh:0.1; url=student.php");
        }
    
        mysqli_close($conn);
}
   ?>