<?php
$sbjCode = $_GET['id'];
$sbjName = $_GET['sbjName'];
$lecturerName = $_GET['lecturerName'];
$num = $_GET['num'];
include 'db_conn.php';

if (isset($_POST["add"])) {
        $question = $_POST["question"];
        $true = $_POST["true"];
        $iQuery = "INSERT INTO truefalse (Question, TrueFalse, sbjCode) VALUES ('$question', '$true', '$sbjCode')";

        if(mysqli_query($conn, $iQuery)){  
            echo '<script>alert("Added Successfully!")</script>'; 
            header("refresh:0.1; url=quiz1.php?id=$sbjCode&&sbjName=$sbjName&&lecturerName=$lecturerName");
    } else {
            echo '<script>alert("Added unsuccessfully!")</script>'; 
            header("refresh:0.1; url=quiz1.php?id=$sbjCode&&sbjName=$sbjName&&lecturerName=$lecturerName");

    
    }mysqli_close($conn);

} elseif (isset($_POST["delete"])) {
   
    $dQuery = "DELETE FROM truefalse WHERE no = '$num'";
    if (mysqli_query($conn, $dQuery)) {
        echo '<script>alert("Deleted Successfully!")</script>'; 
            header("refresh:0.1; url=quiz1.php?id=$sbjCode&&sbjName=$sbjName&&lecturerName=$lecturerName");
            exit;
    } else {
            echo '<script>alert("Delete Unsuccessfully! Data is being used at other table!")</script>';
            header("refresh:0.1; url=quiz1.php?id=$sbjCode&&sbjName=$sbjName&&lecturerName=$lecturerName");
    }mysqli_close($conn);

}elseif(isset($_POST["update"])){
    $question = $_POST["question1"];
    $true = ucwords($_POST["true1"]);
    $uQuery = "UPDATE truefalse SET Question = '$question', TrueFalse = '$true' WHERE no = '$num'";
    if(mysqli_query($conn, $uQuery))
    {
        mysqli_close($conn); // Close connection
        echo '<script>alert("Updated Successfully!")</script>'; 
        header("refresh:0.1; url=quiz1.php?id=$sbjCode&&sbjName=$sbjName&&lecturerName=$lecturerName"); // refresh page
        exit;
    }else{
        echo '<script>alert("Update Unsuccessfully!")</script>';
        header("refresh:0.1; url=quiz1.php?id=$sbjCode&&sbjName=$sbjName&&lecturerName=$lecturerName");
    } 
}
 ?>