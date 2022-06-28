<?php
//Created by Anael Aine Chia for BIC21404 Project Group 2
    session_start();
    include_once 'db_conn.php';
    if(!isset($_SESSION['username'])||$_SESSION['role']!="student"){
        header("location: index.php?error=Please login first!");
    }




    if(isset($_POST["tview"])){ //view, download, submit task
        $No = $_GET['id'];
        header("location: task.php?id=$_GET[id]");






    } elseif(isset($_POST["qview"])){ 
        $No = $_GET['id'];
        $sql = "SELECT tfResult FROM registered_subject
                INNER JOIN student 
                ON student.studentId = registered_subject.studentId 
                WHERE registered_subject.sbjCode = '$No' AND studentName = '$_SESSION[username]'";
        $result = mysqli_query($conn, $sql);
        while($data = mysqli_fetch_array($result)){
            $No = $_GET['id'];
            if($data['tfResult']!="0" && $data['tfResult']!=NULL){
                echo '<script>alert("You took the quiz already and you are unable to take quiz again!")</script>';
                header("refresh:0.1; url=sbj-list-registered.php");             
            }else {
                echo '<script>alert("Get ready to take quiz!")</script>';
                header("refresh:0.1; url=viewquiztf.php?id=$_GET[id]");
            }}






    } elseif (isset($_POST["qsview"])){
        $No = $_GET['id'];
        $sql = "SELECT mcResult FROM registered_subject 
                INNER JOIN student 
                ON student.studentId = registered_subject.studentId 
                WHERE registered_subject.sbjCode = '$No' AND studentName = '$_SESSION[username]'";
        $result = mysqli_query($conn, $sql);
        while($data = mysqli_fetch_array($result)){
            if($data['mcResult']!="0" && $data['mcResult']!=NULL){
                echo '<script>alert("You took the quiz already and you are unable to take quiz again!")</script>';
                header("refresh:0.1; url=sbj-list-registered.php");    
            }else {
                echo '<script>alert("Get ready to take quiz!")</script>';
                header("refresh:0.1; url=viewquizsubjective.php?id=$_GET[id]");
                
            }}

    }else{
        echo "Error!";
    }

    ?>