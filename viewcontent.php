<?php
$id = $_GET['id'];
include "db_conn.php";

if (isset($_POST["submission"])){
    $sqll = "SELECT *, ROW_NUMBER() OVER(ORDER BY assignment_bylecturer.sbjCode) AS No 
             FROM assignment_bylecturer WHERE id = $id";
    $result = $conn->query($sqll);
    while($row = $result->fetch_assoc()): ?>
        <?= $row['fileContent']; 
       endwhile;
    }
?>
  