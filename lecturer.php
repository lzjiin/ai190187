<?php
//Created by Anael Aine Chia for BIC21404 Project Group 2
    session_start();
    if(!isset($_SESSION['username'])||$_SESSION['role']!="lecturer"){
        header("location: index.php");
    }
    require('design/nav_admin.php');
	require('design/header.php');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Subject List</title>
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
    <h3>Subject List</h3>
    <div class="table-responsive">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th style="width: 8%;">No</th>
			   		<th style="width: 30%;">Subject</th>
                    <th>Create Assignment/Tutorial</th>
                    <th>Quiz True/False</th>
                    <th>Quiz Objective</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
				include "db_conn.php"; // Using database connection file here

                $records = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY subject.sbjCode) AS No 
                                               FROM  subject INNER JOIN workload INNER JOIN lecturer 
                                               ON workload.sbjCode = subject.sbjCode AND workload.lecturerId = lecturer.lecturerId
                                               WHERE lecturer.lecturerName = '$_SESSION[username]'"); // fetch data from database        
                
                while($data = mysqli_fetch_array($records))
                {
                    ?>
                    <tr><form action = "combined-wprocess.php?id=<?php echo $data['workloadId']; ?>" method = "post">
                        <td><?php echo "$data[No]" ?></td>
                            <?php echo "<td><input type=text name=sbjName value='".$data['sbjName']."'</td>";
                                  echo "<input type=hidden name=id value='".$data['sbjCode']."'>"; ?>
                        <td>
                            <a href="create-lprocess.php?id=<?php echo $data['sbjCode']; ?>&&sbjName=<?php echo $data['sbjName']; ?>&&lecturerName=<?php echo $_SESSION['username']?>">
                                <button type="button" name="createassign" value="" class="btn btn-primary"> Create</button>
                            </a></td>
                        <td>
                            <a href="trueresult.php?id=<?php echo $data['sbjCode']; ?>&&sbjName=<?php echo $data['sbjName']; ?>&&lecturerName=<?php echo $_SESSION['username']?>">
                                <button type="button" name="trueresult" value="" class="btn btn-primary"> Result</button>
                            </a>
                            <a href="quiz1.php?id=<?php echo $data['sbjCode']; ?>&&sbjName=<?php echo $data['sbjName']; ?>&&lecturerName=<?php echo $_SESSION['username']?>">
                                <button type="button" name="create/view quiz" value="" class="btn btn-primary"> Create/View Quiz</button>
                            </a>
                        </td>
                        <td>
                            <a href="objresult.php?id=<?php echo $data['sbjCode']; ?>&&sbjName=<?php echo $data['sbjName']; ?>&&lecturerName=<?php echo $_SESSION['username']?>">
                                <button type="button" name="objresult" value="" class="btn btn-primary"> Result</button>
                            </a>
                            <a href="quizmultichoices.php?id=<?php echo $data['sbjCode']; ?>&&sbjName=<?php echo $data['sbjName']; ?>&&lecturerName=<?php echo $_SESSION['username']?>">
                                <button type="button" name="create/view quiz" value="" class="btn btn-primary"> Create/View Quiz</button>
                            </a>
                        </td>
                    </form></tr>
                <?php } ?>
			</tbody>
		    </table>
		</div>           
    </body>   
</html>