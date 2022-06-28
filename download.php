<?php
//Created by Anael Aine Chia for BIC21404 Project Group 2


// (A) CONNECT TO DATABASE
require "db_conn.php";

// (B) GET IMAGE FROM DATABASE
$name = $_GET['fileNameLec'];
$stmt = $conn->prepare("SELECT fileContent FROM assignment_bylecturer WHERE fileNameLec=?");
$stmt->execute([$name]);
$img = $stmt->fetch();
$img = $img['fileContent'];

// (C) OUTPUT IMAGE
$ext = pathinfo($name, PATHINFO_EXTENSION);
// if ($ext=="jpg") { $ext = "jpeg"; }
header("Content-type: text/plain");
header("Content-disposition: attachment; filename=$name");  
echo $img;


/* include "db_conn.php";
if(isset($_GET['fileNameLec'])) {
    $no = $_GET['fileNameLec'];
    $stat = $conn->prepare("SELECT * FROM assignment_bylecturer WHERE fileNameLec=?");
    $stat->bind_param('s', $no);
    $stat->execute();
    $data = $stat->fetch();

    /*$sql = "SELECT fileNameLec, 'type', fileContent FROM assignment_bylecturer WHERE fileNameLec=$no";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);*/
    

    // $file = 'process/'.$data['fileNameLec'];
    /* $file = $data['fileNameLec'];
    $content = $data['fileContent']; 

    /*if(file_exists($file)){
        
    }
    $content = base64_decode($content);

    header("Cache-Control: no-cache private");
    header("Content-Description: File Transfer");
    header("Content-disposition: attachment; filename='".$file."'");      
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");
    header('Content-Length: '. strlen($content));      
    header("Pragma: no-cache");
    header("Expires: 0");

    ob_clean();
    flush();

    echo $content;

    /*header('Content-Type: ' . $data['type']);
    header('Content-Disposition: attachment; filename="' . basename($file).'"');
    header('Content-Description: File Transfer');
    header('Content-Transfer-Encoding: binary\n');
    header('Content-length: ' . strlen($content));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    ob_clean();
    flush();
    //$content = stripslashes($content);
    @readfile($content);
    mysqli_close($conn);
    exit;
} */ ?>