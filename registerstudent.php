<?php
    session_start();
    if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
        header("location: index.php?error=Please login first!");
    }
    include "db_conn.php";
    require('design/nav_admin.php');
	require('design/header.php');
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
</head>
<style>
    input{
		border: none;
		font-family: "Times New Roman";
		font-size: medium;
        background: none;
        
        }
    input[type='text']{
        width: 100%;
    }
	table{
		border="0";
		table-layout: fixed ;
        width: 100% ;
	    }
</style>
<body>
    
    <h3>Register Student</h3>
    <div class="table-responsive">
		<table class="table table-striped">
		    <thead>
		       	<tr>
			   		<th>Student ID</th>
			   		<th style="width:20%">Student Name</th>
                    <th style="width:20%">Student Email</th>
                    <th>Modified by</th>
                    <th>Modified on</th>
                    <th>Update</th>
                    <th>Delete</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
				if ($_SESSION['role'] == "admin") {
					$query = "SELECT * FROM student";
					}

				else {
					$role = $_SESSION['role'];
					$query = "SELECT * FROM student WHERE role = $role";
					}

			    $result = $conn->query($query);
                //print_r($result->num_rows);
				if ($result->num_rows > 0) {
			    	while ($row = $result->fetch_array()) {?>
                        <tr><form action = "combined-sprocess.php?id=<?php echo $row['studentId']; ?>" method = "post">
                        <td><?php echo "$row[studentId]</td>";
                                echo "<td><input type=text name=studentName value='".$row['studentName']."'</td>";
                                echo "<td>$row[studentEmail]</td>";
                                echo "<input type=hidden name=id value='".$row['studentId']."'>"; ?>
                        <td><?php echo $row['adminName']?></td>
                        <td><?php echo $row['created_at']?></td>
                        <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
                        <td><input type="submit" class="btn btn-danger" name="delete" value="Delete"/></td>
                            </form>
                  <?php  }  ?>
                     <tr>
                  <form action = "add-sprocess.php" method="post">   
                  <td><input type="text" name="id" class="form-control"></td>
                  <td><input type="text" name="name" class="form-control"></td>
                  <td></td>
                  <td></td>
                  <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>
                  </form></tr>
                  <?php } ?>	            			
    </tbody>
    
	    </table>
	</div>
</body>   
</html>