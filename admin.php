<?php
    session_start();
    if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
        header("location: index.php?error=Please login first!");
    }
	require('design/nav_admin.php');
	require('design/header.php');

    ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Dashboard Admin</title>
		<style>
			input{
				
				background: none;
			}
			.table-responsive{
				margin: auto;
			}
			th{
				background-color: #04AA6D;
				color: white;
			}
			h1 {
				text-align: center;
			}
			
			
		</style>
    </head>	
       <body>	
<?php ?>					
	<h1>Hello <?= $_SESSION['username'] ?>! You are a <?= $_SESSION['role'] ?></h1>  
    <h3>Register Admin</h3>
    <div class="table-responsive" style="width: 90%">
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
			              echo "<td><input type=text name=adminName value='".$row['adminName']."' style='border: none; font-size: large;'></td>";
			              echo "<input type=hidden name=id value='".$row['adminId']."'>"; ?>            
                <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
                <td><input type="submit" class="btn btn-primary" name="delete" value="Delete"></td>
                </form><tr>
		<?php   }  ?>  
                <form action = "add-aprocess.php" method="post">   
                <td><input type="text" name="id" class="form-control" style="border: bold"></td>
                <td><input type="text" name="name" class="form-control" style="width: 23%"></td>
                <td></td>
                <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>
                </form></tr>	
        <?php   }  ?>          	
			</tbody>
		    </table>
		</div>    
    </div>		
</body>
</html>