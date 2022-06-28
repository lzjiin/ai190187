<?php
    session_start();
    if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
        header("location: index.php?error=Please login first!");
    }
    require_once "db_conn.php";
    require('design/nav_admin.php');
	require('design/header.php');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Workload for Lecturer</title>
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
</style>
<body>
    <h3> Register Workload Lecturer</h3>
    <div class="table-responsive">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>Assignment No</th>
			   		<th>Lecturer Name</th>
                    <th>Subject Name</th>
                    <th>Update</th>
                    <th>Delete</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
				include "db_conn.php"; // Using database connection file here
               
                $records = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY subject.sbjCode) AS No 
                                               FROM workload INNER JOIN lecturer INNER JOIN subject 
                                               ON workload.sbjCode = subject.sbjCode 
                                               AND workload.lecturerId = lecturer.lecturerId"); // fetch data from database
                $result1 = mysqli_query($conn, "SELECT * FROM lecturer");
                $result2 = mysqli_query($conn, "SELECT * FROM subject");

                $option1 = $option2 = "";
                
                while($row1 = mysqli_fetch_array($result1))
                {
                    $option1 = $option1."<option>$row1[1]</option>";
                }
                while($row2 = mysqli_fetch_array($result2))
                {
                    $option2 = $option2."<option>$row2[1]</option>";
                
                }
                while($data = mysqli_fetch_array($records)){                    
                    ?>
                    <tr><form action = "combined-wprocess.php?id=<?php echo $data['workloadId']; ?>" method = "post">
                    <td><?php echo "$data[No]";?></td>
                            <?php echo "<td><input type=text name=lecturerName value='".$data['lecturerName']."'</td>";
                                  echo "<td><input type=text name=sbjName value='".$data['sbjName']."'</td>";
                                  echo "<input type=hidden name=id value='".$data['workloadId']."'>"; ?>
                        <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
                        <td><input type="submit" class="btn btn-danger" name="delete" value="Delete"></td>
                    </form></tr>
                <?php } ?>
                    <tr><form action = "add-wprocess.php" method="post"> 
                    <td></td>  
                    <td><select class="custom-select" name="id"><?php echo $option1;?></select>                             
                    <td><select class="custom-select" name="name"><?php echo $option2;?></select></td>
                    <td></td>
                    <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>
                    </form></tr>
			</tbody>
		    </table>
		</div>           
    </body>   
</html>