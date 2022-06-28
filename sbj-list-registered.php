<?php
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
    <title>Subject List Registered</title>
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
    <form action="student.php" method="post" style="padding: 15px;">
        <input type="submit" class="btn btn-primary" name="registersbj" value="Register Subject">
    </form>
    <h3>Subject List:</h3>
    <div class="table-responsive" style="width: 99%">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>No</th>
			   		<th>Lecturer</th>
                    <th>Subject</th>
                    <th style="width: 8%">Task</th>
                    <th style="width: 8%">Mark T/F</th>
                    <th style="width: 8%">Quiz T/F</th>
                    <th style="width: 8%">Mark Subjective</th>
                    <th style="width: 8%">Quiz Subjective</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
                include "db_conn.php"; // Using database connection file here
                $username = $_SESSION["username"];
                $records = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY subject.sbjCode) AS No
                                               FROM registered_subject 
                                               INNER JOIN subject 
                                               INNER JOIN lecturer 
                                               INNER JOIN student
                                               ON registered_subject.sbjCode = subject.sbjCode 
                                               AND registered_subject.lecturerId = lecturer.lecturerId
                                               AND registered_subject.studentId = student.studentId
                                               WHERE studentName = '$username'");

                while($data = mysqli_fetch_array($records)) {
                    ?>
                    <tr><form action = "view-sprocess.php?id=<?php echo $data['sbjCode']; ?>" method = "post">
                    
                        <td><?php echo "$data[No]</td>";
                                  echo "<td>$data[lecturerName]</td>";
                                  echo "<td>$data[sbjName]</td>";
                                  echo "<input type=hidden name=id value='".$data['sbjCode']."'>";
                            ?>
                        <td><input type="submit" class="btn btn-primary" name="tview" value="view"></td>
                        <td><?php echo "$data[tfResult]</td>";?></td>
                        <td><input type="submit" class="btn btn-primary" name="qview" value="view"></td>
                        <td><?php echo "$data[mcResult]</td>"; ?></td>
                        <td><input type="submit" class="btn btn-primary" name="qsview" value="view"></td>
                    
                        </form></tr>
                <?php } ?>
			</tbody>
		    </table>
		</div>           
    </body>   
</html>