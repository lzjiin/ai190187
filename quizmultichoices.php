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
    <title>Multiple Choices Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
    </head>
    <style>
    textarea{
        background: none;
        border: none;
    }
    input{
		border: none;
		font-family: "Times New Roman";
		font-size: medium;
		background: none;
        width: 100%;
        word-wrap: break-word; 
    
    }
	table{
		border="0";
		table-layout: fixed ;
  		width: 100% ;
        word-wrap: break-word; 
        margin-left: auto;
        margin-right: auto;

	}
	th, td{
		width= 25%;
        overflow-wrap: break-word; 
    
	}
    h3{
        padding: 15px;
    }
    </style>   

    <body>
        <form action="lecturer.php" method="post" style="padding: 15px;">
            <input type="submit" name="listsubject" value="List Subject" class="btn btn-primary" style="width: 10%;">
        </form>
        <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
        <?php echo "<h3>Subject Code: ".$sbjCode."</h3>" ?>
        <h3>Multiple Choices Quiz</h3>
        </div>

        <div class="table-responsive" style="word-wrap: break-word;">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th style="width: 4%">No</th>
			   		<th style="width: 30%">Question</th>
                    <th style="width: 9%">Answer A</th>
                    <th style="width: 9%">Answer B</th>
                    <th style="width: 9%">Answer C</th>
                    <th style="width: 9%">Answer D</th>
                    <th style='text-align: center; width: 9%'>Correct Answer</th>
                    <th style="width: 9%">Modified On</th>
                    <th style="width: 8%">Update</th>
                    <th style="width: 8%">Delete</th>
					</tr>
                </thead>
                <tbody>
                    
                        
                    <?php
                    $sQuery = "SELECT *, ROW_NUMBER() OVER(ORDER BY mc_quiz.question) AS No FROM mc_quiz  WHERE sbjCode = '$sbjCode'";
                    $result = $conn->query($sQuery);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_array()){
                     ?>

                    <tr><form action="CRUDquizmultichoices.php?id=<?php echo$sbjCode?>&&sbjName=<?php echo$sbjName?>&&num=<?php echo$row['no']?>" method="post">
                        <td><?= $row['No']; ?></td>
            <?php // echo "<td><input type=text name=question1 value='".$row['question']."'></td>";
                  echo "<td><textarea name=question1 rows=2 cols=55>".$row['question']."</textarea></td>";
                  echo "<td><input type=text name=answera1 value='".$row['answera']."'></td>"; 
                  echo "<td><input type=text name=answerb1 value='".$row['answerb']."'></td>";
                  echo "<td><input type=text name=answerc1 value='".$row['answerc']."'></td>";
                  echo "<td><input type=text name=answerd1 value='".$row['answerd']."'></td>";
                  echo "<td><input type=text name=correctanswer1 value='".$row['correctanswer']."' style='text-align: center'></td>";?>
                        <td><?= $row['modified on']; ?></td>
                        <?php echo "<input type=hidden name=num value='".$row['no']."'>"; ?> 
                        <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
                        <td><input type="submit" class="btn btn-danger" name="delete" value="Delete"/></td>                      
                    </tr>     
                    <?php } ?> 
                    <tr>
                        <td></td>
                        <td><input type="text" name="question" class="form-control" placeholder="Question"></td>
                        <td><input type="text" name="answera" class="form-control" placeholder="Answer A"></td>
                        <td><input type="text" name="answerb" class="form-control" placeholder="Answer B"></td>
                        <td><input type="text" name="answerc" class="form-control" placeholder="Answer C"></td>
                        <td><input type="text" name="answerd" class="form-control" placeholder="Answer D"></td>
                        <td><input type="text" name="correctanswer" class="form-control" placeholder="Correct Answer"></td>
                        <td></td>
                        <td><input type="submit" class="btn btn-primary" name="add" value="Add"></td>
                        <td>
                        </td>
                    </form></tr>
                    <?php } ?> 
                </tbody>
            </table>    
        </div>
    </body>
</html>