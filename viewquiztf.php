<?php
//Created by Anael Aine Chia for BIC21404 Project Group 2
    include 'db_conn.php';
    $No = $_GET['id'];
    $Name = "SELECT sbjName FROM subject WHERE sbjCode = '$No'";
    $sbjname = mysqli_query($conn, $Name);
    while($data = mysqli_fetch_array($sbjname)) { 
        $sbjName = $data['sbjName'];
        }

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
    <title>Student Task</title>
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
            <input type="submit" class="btn btn-primary" name="registersbj" value="Subject List Registered">
    </form>
    <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
    <?php echo "<h3>Subject Code: ".$No."</h3>" ?>
    <div class="table-responsive" style="width: 90%">
		    <table class="table table-striped">
		    	<thead>
		       		<tr>
			   		<th>No</th>
			   		<th style="width: 35%">Question</th>
                    <th style="width: 35%">True or False</th>
                    <th>Confirm Answer</th>
					</tr>
		    	</thead>
		    <tbody>
		
        <form method="post" enctype="multipart/form-data">
        <?php    
            $records = mysqli_query($conn,"SELECT *, ROW_NUMBER() OVER(ORDER BY truefalse.Question) AS No  
                                           FROM truefalse INNER JOIN registered_subject INNER JOIN student
                                           ON truefalse.sbjCode=registered_subject.sbjCode AND registered_subject.studentId = student.studentId
                                           WHERE truefalse.sbjCode = '$No' AND student.studentName='$_SESSION[username]'");
                
                $i = 0;
                while($data = mysqli_fetch_array($records))
                {  $studentId = $data['studentId'];?>
                
                    <tr>
                    <td><?php echo "$data[No]</td>";
                                echo "<td>$data[Question]</td>"; ?>                                    
                                <td>                       
                                    <input type="radio" name="truefalse[<?php echo $i; ?>]" value="True">True</input><br><br>                                  
                                    <input type="radio" name="truefalse[<?php echo $i; ?>]" value="False">False</input>    
                                </td>
                            <?php //echo "<input type=hidden name=id value='".$data['Question']."'>"; ?>
                        <td>
                        <input type="button" class="btn btn-primary" name="confirm" value="Confirm"></td></tr>
                    
            <?php $i++; } ?>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" class="btn btn-danger" name="submit" value="Finish Quiz"></td></tr>
			</tbody></form>
		    </table>
		</div>   
                
    </body>   
    
</html>

<?php 

if(isset($_POST["submit"])){
    $query = mysqli_query($conn,"SELECT count(1) AS totalcount
                                    FROM truefalse INNER JOIN registered_subject INNER JOIN student
                                    ON truefalse.sbjCode=registered_subject.sbjCode AND registered_subject.studentId = student.studentId
                                    WHERE truefalse.sbjCode = '$No' AND student.studentName='$_SESSION[username]'");
    $qResult = mysqli_fetch_assoc($query);

    $record = mysqli_query($conn,"SELECT TrueFalse FROM truefalse INNER JOIN registered_subject INNER JOIN student
                                    ON truefalse.sbjCode=registered_subject.sbjCode AND registered_subject.studentId = student.studentId
                                    WHERE truefalse.sbjCode = '$No' AND student.studentName='$_SESSION[username]'");
    $answer = array();
    while($data1 = mysqli_fetch_array($record)){
        array_push($answer, $data1['TrueFalse']);
    }

    $j = 0;
    $fullscore = 0;
    if(isset($_POST['truefalse'])){
        while($j < $qResult['totalcount']){
            $stuAns = $_POST['truefalse'];
            if($stuAns[$j] === $answer[$j]){
                $fullscore += 2;
            }
            else {$fullscore += -2;}
            $j++;
        }
    }

    if($fullscore < 0) {
        $fullscore = 0;
    }

    echo "Thank you! Your marks are ".$fullscore."/".$qResult['totalcount']*2;
    
    $sql = "UPDATE registered_subject SET tfResult='$fullscore' WHERE sbjCode = '$No' AND studentId='$studentId'";
    if (mysqli_query($conn, $sql)) {
       exit;
        
    }mysqli_close($conn);

} ?>
