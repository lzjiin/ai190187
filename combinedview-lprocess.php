<?php
$id = $_GET['id'];
$sbjCode=$_GET['sbjCode'];
$sbjName=$_GET['sbjName'];
include "db_conn.php";

if (isset($_POST["delete"])) {
    $sql = "DELETE FROM assignment_bylecturer WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Deleted Successfully!")</script>'; 
            header("refresh:0.1; url=create-lprocess.php?id=$sbjCode&&sbjName=$sbjName");
            exit;
    } else {
            echo '<script>alert("Delete unsuccessfully! This data is being used at other table!")</script>';
            header("refresh:0.1; url=create-lprocess.php?id=$sbjCode&&sbjName=$sbjName");
}mysqli_close($conn);


}elseif (isset($_POST["content"])){
    $sqll = "SELECT *, ROW_NUMBER() OVER(ORDER BY assignment_bylecturer.sbjCode) AS No 
             FROM assignment_bylecturer WHERE id = $id";
    $result = $conn->query($sqll);
    while($row = $result->fetch_assoc()): ?>
        <?= $row['fileContent']; 
       endwhile;
  
       
}elseif (isset($_POST["submission"])){
    header("location: viewsubmission.php?id=$sbjCode&ID=$id");
 }
 

 ?>


