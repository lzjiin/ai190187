<?php
include("db_conn.php");
if (isset($_POST['download'])) { 
    $sql = "SELECT * FROM assignment_bylecturer WHERE fileNameLec = $_GET[id]";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            if ($row = mysqli_fetch_assoc($result)) { ?>
                <a href="<?php echo $row['fileContent']; ?>" download="<?php echo $row['fileNameLec']; ?>" class="download_link"></a?
   <?php }}} ?>
 
?>