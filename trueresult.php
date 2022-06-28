<?php
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
    <title>True/False Result</title>
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
        <form action="lecturer.php" method="post" style="padding: 15px;">
            <input type="submit" class="btn btn-primary" name="registersbj" value="List Subject">
        </form>
        <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
        <?php echo "<h3>Subject Code: ".$sbjCode."</h3>" ?>
        <h3>True/False Quiz Result</h3>
        </div>

        <div class="table-responsive">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>No</th>
			   		<th>Student Name</th>
                    <th>Student ID</th>
                    <th>Result Quiz True/False</th>
					</tr>
                </thead>
                <tbody> 
                    <?php
            
                    $sQuery = "SELECT *, ROW_NUMBER() OVER(ORDER BY student.studentId) AS No 
                               FROM student INNER JOIN registered_subject 
                               ON student.studentId = registered_subject.studentId 
                               WHERE registered_subject.sbjCode = '$sbjCode'";
                    $result = $conn->query($sQuery);

                    while($row = $result->fetch_assoc()):
                     ?>

                    <tr>
                        <td><?= $row['No']; ?></td>
                        <td><?= $row['studentName']; ?></td>
                        <td><?= $row['studentId']; ?></td>
                        <td><?= $row['tfResult']; ?></td>
                    </tr>

                   
                    <?php endwhile; ?>

                   
                
                </tbody>
            </table>    
        </div>
        
    <?php
            $SQL = "SELECT count(*) AS Total FROM registered_subject WHERE tfResult='0' AND sbjCode = '$sbjCode'";
            $SQQ = "SELECT count(*) AS Total FROM registered_subject WHERE tfResult!='0' AND sbjCode = '$sbjCode'";
            $displayy = mysqli_query($conn, $SQL);
            $displayyy = mysqli_query($conn, $SQQ);
            while($dat = mysqli_fetch_array($displayy)) { 
                while($dat1 = mysqli_fetch_array($displayyy)) { 
                    $fail = $dat['Total'];
                    $pass = $dat1['Total'];
                    echo "<h3>Number of student pass: ".$pass."</h3>"; 
                    echo "<h3>Number of student fail: ".$fail."</h3>";    
            }}?>
    </body>
</html>