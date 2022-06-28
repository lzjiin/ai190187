<?php
include_once "db_conn.php";

    if(isset($_POST["update"])){
        mysqli_select_db($conn, 'mysql');
        $option1 = $_POST["lecturerName"];
        $option2 = $_POST["sbjName"];
        $sql = "UPDATE workload SET workload.sbjCode = subject.sbjCode, workload.lecturerId = lecturer.lecturerId 
                INNER JOIN subject INNER JOIN lecturer ON lecturer.lecturerName = '$option1' AND subject.sbjName = '$option2'";
    if(mysqli_query($conn, $sql))
    {
        mysqli_close($conn); // Close connection
        echo '<script>alert("Updated Successfully!")</script>'; 
        header("refresh:0.1; url=registerworkload.php"); // refresh page
        exit;
    }
    else
    {
        echo '<script>alert("Update Unsuccessfully!")</script>';
        header("refresh:0.1; url=registerworkload.php");
    } 
    }
    if(isset($_POST["delete"])){

        $sqll = "DELETE FROM workload WHERE workloadId = '$_GET[id]'";
        if (mysqli_query($conn, $sqll)) {
            echo '<script>alert("Deleted Successfully!")</script>'; 
                header("refresh:0.1; url=registerworkload.php");
                exit;
        } else {
                echo '<script>alert("Delete Unsuccessfully! Data is being used at other table!")</script>';
                header("refresh:0.1; url=registerworkload.php");
        }
        mysqli_close($conn);
    }
?>