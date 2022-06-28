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
    <title>Sign Up admin</title>
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
                width: 90%
	            }
            td{
		        width: 25%;
	            }
        </style>
<body>
    <h3>Register Admin</h3>
    <div class="table-responsive">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>Admin ID</th>
			   		<th style="width:60%">Admin Name</th>
                    <th>Update</th>
                    <th>Delete</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
				if ($_SESSION['role'] == "admin") {
					$query = "SELECT * FROM admin";
					}

				else {
					$role = $_SESSION['role'];
					$query = "SELECT * FROM admin WHERE role = $role";
					}

			    $result = $conn->query($query);
				if ($result->num_rows > 0) {
			    	while ($row = $result->fetch_array()) {

				?>
				<tr><form action = "combined-aprocess.php?id=<?php echo $row['adminId']; ?>" method = "post">
  	            <td><?php echo "$row[adminId]</td>";
			              echo "<td><input type=text name=adminName value='".$row['adminName']."'</td>";
			              echo "<input type=hidden name=id value='".$row['adminId']."'>"; ?>            
                <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
                <td><input type="submit" class="btn btn-danger" name="delete" value="Delete"></td>
                </form><tr>
		<?php   }  ?>  
                <form action = "add-aprocess.php" method="post">   
                <td><input type="text" name="id" class="form-control" placeholder="Enter ID"></td>
                <td><input type="text" name="name" class="form-control" placeholder="Enter Name" style="width: 23%"></td>
                <td></td>
                <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>
                </form></tr>	
        <?php   }  ?>          	
			</tbody>
		    </table>
		</div>   
		<script src="design/sweetalert.min.js"></script>

    </body>   
</html>