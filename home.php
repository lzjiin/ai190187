<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php if ($_SESSION['role'] == 'admin') {
			  $sql = "SELECT status FROM users WHERE username='$_SESSION[username]'";
			  $result = mysqli_query($conn, $sql);
			  while($data = mysqli_fetch_array($result)){
				  if($data['status']!="1"){
					  echo '<script>alert("Please reset your password, the first time log in is detected.")</script>';
					  header("refresh:0.1; url=php/reset-password.php");
					  
				  }else {
					echo '<script>alert("Login successful!")</script>';
					header("refresh:0.1; url=admin.php");
				  }
			  }
			  	?> 
					
      	<?php }elseif ($_SESSION['role'] == 'student') {
			  $sql = "SELECT status FROM users WHERE username='$_SESSION[username]'";
			  $result = mysqli_query($conn, $sql);
			  while($data = mysqli_fetch_array($result)){
				  if($data['status']!="1"){
					  echo '<script>alert("Please reset your password, the first time log in is detected.")</script>';
					  header("refresh:0.1; url=php/reset-password.php");
					  
				  }else {
					echo '<script>alert("Login successful!")</script>';
					header("refresh:0.1; url=student.php");
				  }
			  }
			    ?> 
			   
      	<?php } elseif ($_SESSION['role'] == 'lecturer') {
			  $sql = "SELECT status FROM users WHERE username='$_SESSION[username]'";
			  $result = mysqli_query($conn, $sql);
			  while($data = mysqli_fetch_array($result)){
				  if($data['status']!="1"){
					  echo '<script>alert("Please reset your password, the first time log in is detected.")</script>';
					  header("refresh:0.1; url=php/reset-password.php");
					  
				  }else {
					echo '<script>alert("Login successful!")</script>';
					header("refresh:0.1; url=lecturer.php");
				  }
			  }
			  	?>       		
      	<?php }?>
      </div>
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>