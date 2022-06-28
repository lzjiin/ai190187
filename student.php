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
    <title>Student Dashboard</title>
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
        <input type="submit" class="btn btn-primary" name="list" value="Subject List Registered">
    </form>
    <h3>Student Register Subject:</h3>
    <div class="table-responsive" style="width: 90%">
		    <table class="table  table-striped">
		    	<thead>
		       		<tr>
			   		<th>No</th>
			   		<th>Lecturer</th>
                    <th>Subject</th>
                    <th>Register</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
				include "db_conn.php"; // Using database connection file here

                $records = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY subject.sbjCode) AS No 
                                               FROM workload 
                                               INNER JOIN lecturer 
                                               INNER JOIN subject 
                                               ON workload.sbjCode = subject.sbjCode 
                                               AND workload.lecturerId = lecturer.lecturerId"); // fetch data from database

                while($data = mysqli_fetch_array($records))
                {
                    ?>
                    <tr><form action = "register-sprocess.php?id=<?php echo $data['workloadId']; ?>" method = "post">
                        <td><?php echo "$data[No]</td>";
                                  echo "<td>$data[lecturerName]</td>";
                                  echo "<td>$data[sbjName]</td>";
                                  echo "<input type=hidden name=id value='".$data['workloadId']."'>"; ?>
                        <td><input type="submit" class="btn btn-primary" name="register" value="Register"></td>
                    </form></tr>
                <?php } ?>
			</tbody>
		    </table>
		</div>           
    </body>   
</html>