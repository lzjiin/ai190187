<?php
//Created by Anael Aine Chia for BIC21404 Project Group 2
include ("db_conn.php"); // Using database connection file here
$No = $_GET['id'];
$Name = "SELECT sbjName FROM subject WHERE sbjCode = '$No'";
$sbjname = mysqli_query($conn, $Name);
while($data = mysqli_fetch_array($sbjname)) { 
    $sbjName = $data['sbjName'];
    }

    session_start();
    if(!isset($_SESSION['username'])||$_SESSION['role']!="student"){
        header("location: index.php?error=Please login first!");
    }
    require('design/nav_admin.php');
	require('design/header.php');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
    </head>
    <style>
    input{
		border: none;
		font-family: "Times New Roman";
		font-size: medium;
		background: none;
    }
	.table-responsive{
        margin: auto;
    }
    th{
        background-color: #04AA6D;
        color: white;
    }
	td{
		width= 25%;
	}
    h3{
        padding: 15px;
    }
</style>
<body>
    <form action="sbj-list-registered.php" method="post" style="padding: 15px;">
        <input type="submit" class="btn btn-primary" name="registersbj" value="Subject List Registered">
    </form>
    <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
    <?php echo "<h3>Subject Code: ".$No."</h3>" ?>
    <div class="table-responsive" style="width: 99%">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>No</th>
			   		<th style="width: 35%">Assignment/Tutorial/Lab</th>
                    <th style="width: 35%">Your File</th>
                    <th>Download Task</th>
                    <th>Submission</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
                
                $username = $_SESSION["username"];
                $records = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY id) AS No 
                                               FROM assignment_bylecturer WHERE sbjCode = '$No'");
                while($data = mysqli_fetch_array($records)) { ?>
                        <td><?php echo $data['No'] ?></td>
                        <td><?php echo $data['fileNameLec'] ?> </td>
                        <td><?php echo $data['fileNameStu'] ?> </td>
                        <?php /* $records1 = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY viewsubmit_assignment.sbjCode) AS No 
                                                                  FROM viewsubmit_assignment INNER JOIN student
                                                                  ON viewsubmit_assignment.studentId = student.studentId
                                                                  WHERE student.studentName = '$username' AND viewsubmit_assignment.sbjCode = '$No' 
                                                                  AND viewsubmit_assignment.fileNameLec = 'Lab 1'"); 
                        while($data1 = mysqli_fetch_array($records1)) {   
                            echo $data1['fileNameStu']; } ?> </td>
                            
                        <?php echo "<input type=hidden name=id value='".$data['fileNameLec']."'>"; */?>
                        <td><a href="download.php?fileNameLec=<?php echo $data['fileNameLec']; ?>" class="btn btn-primary">Download</a></td> 
                        
                        <td><form method="post" enctype="multipart/form-data">
                            <input type="file" name="upload" accept=".png,.gif,.jpg,.webp" required/>
                            <input type="submit" name="submit" value="Upload"/>
                            </form></td>
                        </tr>  

                        <?php
                        
    // (B) SAVE IMAGE INTO DATABASE
    if (isset($_FILES["upload"])) {
        
        $id=$_GET['id'];
        try {
          // (B1) CONNECT To DATABASE
          require "db_conn.php";
        
     // (B2) READ IMAGE FILE & INSERT

        $record = mysqli_query($conn,"SELECT * FROM student WHERE studentName = '$username'"); 
            while($d = mysqli_fetch_array($record)) {   
                echo $d['studentId']; 
                
        $stmt = $conn->prepare("INSERT INTO viewsubmit_assignment (fileNameStu, studentId, sbjCode, fileContentStu) FROM student VALUES (?, $d, $id, ?)");
        $stmt->execute([$_FILES['upload']['name'], file_get_contents($_FILES['upload']['tmp_name'])]);
        echo "OK";}
    }catch (Exception $ex) { echo $ex->getMessage(); }

}
    ?>
            <?php } ?>
			</tbody>

		    </table>
		</div>   
                
    </body>   
    
</html>
