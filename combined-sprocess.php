<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
    header("location: index.php?error=Please login first!");
}
require "db_conn.php";

    mysqli_select_db($conn, 'mysql');
    if(isset($_POST["update"])){
        $sql0 = "UPDATE users SET username='$_POST[studentName]' WHERE id='$_POST[id]'";
        $sql = "UPDATE student SET studentName='$_POST[studentName]', adminName='$_SESSION[username]' WHERE studentId='$_POST[id]'";
	
    if(mysqli_query($conn, $sql)){
        if(mysqli_query($conn, $sql0)){
            mysqli_close($conn); // Close connection
            echo '<script>alert("Updated Successfully!")</script>'; 
            header("refresh:0.1; url=registerstudent.php"); // refresh page
            exit;}
    }else{
        echo '<script>alert("Update unsuccessfully!")</script>';
            header("refresh:0.1; url=registerstudent.php");
    }}
    if(isset($_POST["delete"])){
        $sqll0 = "DELETE FROM users WHERE id='$_GET[id]'";
        $sqll = "DELETE FROM student WHERE studentId='$_GET[id]'";
        if (mysqli_query($conn, $sqll)) {
            if (mysqli_query($conn, $sqll0)) {
                echo '<script>alert("Deleted Successfully!")</script>'; 
                header("refresh:0.1; url=registerstudent.php");
                exit;}
        } else {
            echo '<script>alert("Delete unsuccessfully! Student data is being used at other table!")</script>';
            header("refresh:0.1; url=registerstudent.php");
        }
        mysqli_close($conn);
    }
?>