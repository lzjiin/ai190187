<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
    header("location: index.php?error=Please login first!");
}
require 'db_conn.php';

    mysqli_select_db($conn, 'mysql');

    if(isset($_POST["update"])){
    $sql = "UPDATE subject SET sbjCode='$_POST[sbjCode]',sbjName='$_POST[sbjName]',adminName='$_SESSION[username]' WHERE sbjCode='$_POST[id]'";
	
    if(mysqli_query($conn, $sql))
    {
        mysqli_close($conn); // Close connection
        echo '<script>alert("Updated Successfully!")</script>'; 
        header("refresh:0.1; url=registersubject.php"); // refresh page
        exit;
    }else{
        echo '<script>alert("Update unsuccessfully!")</script>';
                header("refresh:0.1; url=registersubject.php");
    } 
    }
    if(isset($_POST["delete"])){

        $sqll = "DELETE FROM subject WHERE sbjCode='$_GET[id]'";
        if (mysqli_query($conn, $sqll)) {
            echo '<script>alert("Deleted Successfully!")</script>'; 
                header("refresh:0.1; url=registersubject.php");
                exit;
        } else {
            echo '<script>alert("Delete unsuccessfully! Subject data is being used at other table!")</script>';
            header("refresh:0.1; url=registersubject.php");
        }
        mysqli_close($conn);
    }
?>

