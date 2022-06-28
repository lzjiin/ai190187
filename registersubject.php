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
    <title>Sign Up</title>
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
    </style>
<body>
    <h3>Register Subject</h3>
    <div class="table-responsive">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>Subject Code</th>
			   		<th style="width: 25%">Subject Name</th>
                    <th>Modified by</th>
                    <th>Modified on</th>
                    <th>Update</th>
                    <th style="width: 10%">Delete</th>
					</tr>
		    	</thead>
		    <tbody>
		<?php
				if ($_SESSION['role'] == "admin") {
					$query = "SELECT * FROM subject";
					}

				else {
					$role = $_SESSION['role'];
					$query = "SELECT * FROM subject WHERE role = $role";
					}

			    $result = $conn->query($query);
				if ($result->num_rows > 0) {
			    	while ($row = $result->fetch_array()) {

				?>
			    <tr><form action = "combined-sbjprocess.php?id=<?php echo $row['sbjCode']; ?>" method = "post">
                            <?php echo "<td><input type=text name=sbjCode value='".$row['sbjCode']."'</td>";
                                  echo "<td><input type=text name=sbjName value='".$row['sbjName']."'</td>";
                                  echo "<input type=hidden name=id value='".$row['sbjCode']."'>"; ?>
                        <td><?php echo $row['adminName']?></td>
                        <td><?php echo $row['created_at']?></td>
                        <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
                        <td><input type="submit" class="btn btn-danger" name="delete" value="Delete"/></td>
                        </form></tr>
		<?php   } }	   ?>  
                <form action = "add-sbjprocess.php" method="post">   
                <td><input type="text" name="id" class="form-control"></td>
                <td><input type="text" name="name" class="form-control" style="width: 70%"></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>	
                </form>			
			</tbody>
		    </table>
		</div>
    </body>   
</html>