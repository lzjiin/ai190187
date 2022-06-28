<?php
$sbjCode = $_GET['id'];
$sbjName = $_GET['sbjName'];
session_start();
if(!isset($_SESSION['username'])||$_SESSION['role']!="lecturer"){
    header("location: index.php?error=Please login first!");
}
require('design/nav_admin.php');
require('design/header.php');
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create True/False Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
    </head>
    <style>
    input{
		border: none;
		font-family: "Times New Roman";
		font-size: medium;
		background: none;
        width: 100%;
    }
	table{
		border="0";
		table-layout: fixed ;
  		width: 100% ;
	}
	td{
		width: 25%;
	}
    h3{
        padding: 15px;
    }
    </style>   

    <body>
        <form action="lecturer.php" method="post" style="padding: 15px;">
            <input type="submit" class="btn btn-primary" name="registersbj" value="List Subject" style="width: 10%">
        </form>
        <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
        <?php echo "<h3>Subject Code: ".$sbjCode."</h3>" ?>
        <h3>Quiz True/False</h3>
        </div>

        <div class="table-responsive">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th style="width: 3%">No</th>
			   		<th style="width: 50%; word-wrap: break-word;">Question</th>
                    <th style="width: 8%">True or False</th>
                    <th style="width: 8%">Modified On</th>
                    <th style="width: 6%">Update</th>
                    <th style="width: 6%">Delete</th>
					</tr>
                </thead>
                <tbody>      
                    <?php
                
                    $sQuery = "SELECT *, ROW_NUMBER() OVER(ORDER BY Question) AS No FROM truefalse WHERE sbjCode = '$sbjCode'";
                    $result = $conn->query($sQuery);

                    while($row = $result->fetch_array()):
                     ?>

                    <tr><form action = "CRUDquiz1.php?id=<?php echo$sbjCode?>&&sbjName=<?php echo$sbjName?>&&lecturerName=<?php echo$_SESSION['username']?>&&num=<?php echo$row['no']?>" method = "post">
                        <td><?= $row['No']; ?></td>
            <?php echo "<td><input type=text name='question1' value='".$row['Question']."'></td>";
                  echo "<td><input type=text name='true1'     value='".$row['TrueFalse']."'></td>"; ?>                 
                        <td><?= $row['Modified on']; ?></td> 
                        <?php echo "<input type=hidden name='num' value='".$row['no']."'>"; ?>
                        <td><input type="submit" class="btn btn-primary" name="update" value="Update" style="width: 100%"></td>
                        <td><input type="submit" class="btn btn-danger" name="delete" value="Delete" style="width: 100%"></td>
                    </tr>

                   
                    <?php endwhile; ?>
                    <tr>
                        <td></td>
                        <td><input type="text" name="question" class="form-control" placeholder="Question"></td>
                        <td><input type="text" name="true" class="form-control" placeholder="True or False"></td>
                        <td></td>
                        <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>
                        <td>
                        </td></form>
                    </tr>
                   
                </tbody>
            </table>    
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/
        X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    </body>
</html>