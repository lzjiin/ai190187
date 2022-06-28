<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<style>
	.role input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
	}
	.admin{background-image:url(https://img.icons8.com/bubbles/2x/admin-settings-male.png);}
	.lecturer{background-image:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxEL9v4c3aF8K0jgciY3mzDiVEIAehFTWQfw&usqp=CAU);}
	.student{background-image:url(data:image/png;base64,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);}

	.role input:active +.usertype{opacity: .9;}
	.role input:checked +.usertype{
    	-webkit-filter: none;
       	-moz-filter: none;
    	filter: none;
	}
	.usertype{
    	cursor:pointer;
    	background-size:contain;
    	background-repeat:no-repeat;
   	 	display:inline-block;
    	width:200px;height:140px;
    	
	}
	.usertype:hover{
    	-webkit-filter: brightness(1) grayscale(0) opacity(1);
       		-moz-filter: brightness(1) grayscale(0) opacity(1);
        	    filter: brightness(1) grayscale(0) opacity(1);
	}
</style>
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
      	      action="php/check-login.php" 
      	      method="post" 
      	      style="width: 800px;">
      	      <h1 class="text-center p-3">LOGIN</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
		  <div class="mb-3">
		    <label for="username" 
		           class="form-label">User name</label>
		    <input type="text" 
		           class="form-control" 
		           name="username" 
		           id="username">
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Password</label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password">
		  </div>
		  <div class="mb-1">
		    <label class="form-label">Select User Type:</label>
			</div>
			<input type="radio" name="role" <?php if (isset($role) && $role=="admin") echo "checked";?> value="admin">
			<label class="usertype admin" for="admin"></label>
  			<input type="radio" name="role" <?php if (isset($role) && $role=="lecturer") echo "checked";?> value="lecturer">
			<label class="usertype lecturer"for="lecturer"></label>
  			<input type="radio" name="role" <?php if (isset($role) && $role=="student") echo "checked";?> value="student">
			<label class="usertype student"for="student"></label>  
		    <br><br>
		  <button type="submit" 
		          class="btn btn-primary">LOGIN</button>
		</form>
      </div>
</body>
</html>
<?php }else{
	
	header("Location: home.php");
} ?>