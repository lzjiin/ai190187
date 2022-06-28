<?php
include_once "db_conn.php";


    mysqli_select_db($conn, 'mysql');

    if(isset($_POST["update"])){
        $sql0 = "UPDATE users SET username='$_POST[adminName]' WHERE id='$_POST[id]'";
        $sql = "UPDATE admin SET adminName='$_POST[adminName]' WHERE adminId='$_POST[id]'";
	
    if(mysqli_query($conn, $sql))
    {
        if(mysqli_query($conn, $sql0)){
        mysqli_close($conn); // Close connection   
        echo '<script>alert("Updated Successfully!")</script>'; 
        header("refresh:0.1; url=admin.php"); // refresh page
        
        exit;}
    }else{
        echo '<script>alert("Update unsuccessfully!")</script>';
                header("refresh:0.1; url=admin.php");} 
}
    if(isset($_POST["delete"])){
        $sqll0 = "DELETE FROM users WHERE id='$_GET[id]'";
        $sqll = "DELETE FROM admin WHERE adminId='$_GET[id]'";
        if (mysqli_query($conn, $sqll)) {
            if (mysqli_query($conn, $sqll0)) {
                echo '<script>alert("Deleted Successfully!")</script>'; 
                header("refresh:0.1; url=admin.php");
                exit;}
        } else {
                echo '<script>alert("Delete unsuccessfully! Admin data is being used at other table!")</script>';
                header("refresh:0.1; url=admin.php");
        }
        mysqli_close($conn);
    }
?>


        