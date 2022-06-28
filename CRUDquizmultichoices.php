<?php
$sbjCode = $_GET['id'];
$num = $_GET['num'];
include "db_conn.php";

if (isset($_POST["add"])) {
    if (!empty($_POST["question"]) && !empty($_POST['answera']) && !empty($_POST['answerb']) && !empty($_POST['answerc']) && !empty($_POST['answerd']) && !empty($_POST['correctanswer'])) {
        $question = $_POST["question"];
        $answera = $_POST["answera"];
        $answerb = $_POST["answerb"];
        $answerc = $_POST["answerc"];
        $answerd = $_POST["answerd"];
        $correctanswer = $_POST["correctanswer"];

        $iQuery = "INSERT INTO mc_quiz(sbjCode, question, answera, answerb, answerc, answerd, correctanswer) 
                   VALUES ('$sbjCode','$question','$answera','$answerb','$answerc','$answerd','$correctanswer')";

        if (mysqli_query($conn, $iQuery)) {
            echo '<script>alert("Added Successfully!")</script>'; 
            header("refresh:0.5; url=registerstudent.php");
            exit;
        } else {
            echo '<script>alert("Add unsuccessfully!")</script>'; 
                    header("refresh:0.1; url=registerstudent.php");
    }mysqli_close($conn);
}

}elseif (isset($_POST["delete"])) {
    $dQuery = "DELETE FROM mc_quiz WHERE no = '$num'";
    if (mysqli_query($conn, $dQuery)) {
            echo '<script>alert("Deleted Successfully!")</script>'; 
            header("refresh:0.1; url=registerstudent.php");
            exit;
    } else {
        echo '<script>alert("Delete unsuccessfully! Student data is being used at other table!")</script>';
        header("refresh:0.1; url=registerstudent.php");
    }mysqli_close($conn);

}elseif (isset($_POST["update"])){
    $question1 = $_POST["question1"];
    $answera1 = $_POST["answera1"]; 
    $answerb1 = $_POST["answerb1"];
    $answerc1 = $_POST["answerc1"];
    $answerd1 = $_POST["answerd1"];
    $correctanswer1 = $_POST["correctanswer1"];
    $uQuery = "UPDATE mc_quiz SET question = '$question1', 
                                  answera = '$answera1', 
                                  answerb = '$answerb1', 
                                  answerc = '$answerc1', 
                                  answerd = '$answerd1', 
                                  correctanswer = '$correctanswer1'
                                  WHERE no='$num'";

    if(mysqli_query($conn, $uQuery))
    {
        mysqli_close($conn); // Close connection
        echo $num;
        echo $question1;
        echo '<script>alert("Updated Successfully!")</script>'; 
        header("refresh:2; url=registerworkload.php"); // refresh page
        exit;
    }
    else
    {
        echo '<script>alert("Update Unsuccessfully!")</script>';
        header("refresh:0.1; url=registerworkload.php");
    } 
    }
 ?>