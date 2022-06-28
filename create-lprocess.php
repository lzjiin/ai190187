<?php
//Created by Anael Aine Chia for BIC21404 Project Group 2
$sbjCode=$_GET['id'];
$sbjName = $_GET['sbjName'];
    session_start();
    if(!isset($_SESSION['username'])||$_SESSION['role']!="lecturer"){
        header("location: index.php?error=Please login first!");
    }
    require('design/nav_admin.php');
	require('design/header.php');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Assignment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
    </head>
    <style>
    input{
		border: none;
		font-family: "Times New Roman";
		font-size: medium;
		background: none;
    }
	table{
		border="0";
		table-layout: fixed ;
  		width: 100% ;
	}
	td{
		width= 25%;
	}
    h3{
        padding: 15px;
    }
    </style>   

    <body>
        
            <a href="lecturer.php" style="padding: 15px;">
                <button type="button" name="listsubject" value="" class="btn btn-primary"> List Subject</button>
            </a>
            <a href="logout.php">
                <button type="button" name="logout.php" value="" class="btn btn-primary"> Log Out</button>
            </a>
        <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
        <?php echo "<h3>Subject Code: ".$sbjCode."</h3>" ?>
        <h3>Create Assignment</h3>

        <form method="post" enctype="multipart/form-data" style="padding: 15px;">
                        <label>Assignment/Tutorial/Lab :</label>
                        <input type="text" name="title"><br>
                        <label>File :</label>
                        <input type="file" name="file">
                        <input type="submit" name="submit" class="btn btn-primary">
        </form>

        <div class="table-responsive" style="width: 90%; margin: auto">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th style="width: 5%">No</th>
			   		<th style="width: 20%">Assignment/Tutorial/Lab</th>
                    <th>File Name</th>
                    <th>Modified By</th>
                    <th>Modified On</th>
                    <th style="width: 10%">View Content</th>
                    <th style="width: 10%">View Submission</th>
                    <th style="width: 10%">Delete</th>
					</tr>
                </thead>
                <tbody>
                    
                        
                    <?php
                    $sQuery = "SELECT *, ROW_NUMBER() OVER(ORDER BY assignment_bylecturer.Id) AS No
                               FROM assignment_bylecturer INNER JOIN lecturer 
                               WHERE sbjCode = '$sbjCode' AND lecturerName = '$_SESSION[username]'";

                    $result = $conn->query($sQuery);

                    while($row = $result->fetch_assoc()):
                     ?>

                    <tr>
                        <td><?= $row['No']; ?></td>
                        <td><?= $row['fileNameLec']; ?></td>
                        <td><?= basename($row['fileContent']); ?></td>
                        <td><?= $row['lecturerName']; ?></td>
                        <td><?= $row['date']; ?></td>  <?php ?>
                        <?php echo "<input type=hidden name=ID value='".$row['Id']."'>" ?>
                        <form action="combinedview-lprocess.php?id=<?php echo $row['Id']; ?>&sbjCode=<?php echo$sbjCode?>&&sbjName=<?php echo$sbjName?>" method="post">
                        <td><input type="submit" name="content" class="btn btn-primary" value="View"></td>
                        <td><input type="submit" name="submission" class="btn btn-primary" value="View"></td>
                        <td><input type="submit" name="delete" class="btn btn-danger" value="Delete"></td>
                        
                        </form></tr>

                    <?php endwhile; ?>
                   
                    
                </tbody>
            </table>    
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/
        X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>   
    </body>
</html>


<?php

include "db_conn.php";
 
if (isset($_POST["submit"])) {
    #retrieve file title
    $title = $_POST["title"];

    #file name with a random number so that similar dont get replaced
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"]; 
    $fileContent = file_get_contents($_FILES['file']['tmp_name']);

    $sQuery1 = "SELECT lecturerId FROM lecturer WHERE lecturerName = '$_SESSION[username]'";
    $result1 = $conn->query($sQuery1);
    while($row1 = $result1->fetch_assoc()){

    #sql query to insert into database
    $sql = "INSERT into assignment_bylecturer(fileNameLec,fileContent,sbjCode,lecturerId) VALUES('$title','$fileContent','$sbjCode','$row1[lecturerId]')";
    
    if(mysqli_query($conn,$sql)){
        echo '<script>alert("Uploaded successfully!")</script>'; 
        exit;
    }
    else{
        echo "Error";
    }}
} 

?>