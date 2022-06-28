<?php
    include 'db_conn.php';
    $id=$_GET['ID'];
    $sbjCode=$_GET['id'];
    $Name = "SELECT sbjName, fileNameLec FROM subject INNER JOIN assignment_bylecturer 
             WHERE assignment_bylecturer.sbjCode = '$sbjCode' AND assignment_bylecturer.id=$id";
        $display = mysqli_query($conn, $Name);
        while($data = mysqli_fetch_array($display)) { 
            $sbjName = $data['sbjName'];
            $fileNameLec = $data['fileNameLec'];
            }
    session_start();
    if(!isset($_SESSION['username'])||$_SESSION['role']!="lecturer"){
        header("location: index.php");
    }
    require('design/nav_admin.php');
	require('design/header.php');
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>View Submission</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <style>
        h3{
        padding: 15px;
    }
    </style>

    <body>
        <form action="lecturer.php" method="post" style="padding: 15px;">
            <input type="submit" class="btn btn-primary" name="registersbj" value="List Subject">
        </form>
        <?php echo "<h3>Subject Name: ".$sbjName."</h3>"; ?>
        <?php echo "<h3>Subject Code: ".$sbjCode."</h3>" ?>
        <?php echo "<h3>Assignment  : ".$fileNameLec."</h3>" ?>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>STUDENT NAME</th>
                        <th>STUDENT ID</th>
                        <th>File Name</th>
                        <th>View Content</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include "db_conn.php";
                    $sql = mysqli_query($conn, "SELECT *, ROW_NUMBER() OVER(ORDER BY viewsubmit_assignment.sbjCode) AS No 
                                            FROM viewsubmit_assignment 
                                            INNER JOIN student
                                            ON student.studentId = viewsubmit_assignment.studentId
                                            WHERE viewsubmit_assignment.sbjCode = '$sbjCode'" );
                    
                    while($row = mysqli_fetch_array($sql)){
                    ?>
                    <tr> 
                        <td><?php echo $row['No'] ?></td>
                        <td><?php echo $row['studentName'] ?></td>
                        <td><?php echo $row['studentId'] ?></td>
                        <td><?php echo $row['fileNameStu'] ?></td>
                        <?php echo "<input type=hidden name=studentId value='".$row['studentId']."'>"; ?>
                        <td><form action = "viewcontent.php?id=<?php echo $id; ?>" method="post">   
                                <input type="submit" class="btn btn-primary" name="submission" value="View">                       
                        </td></form>
                    </tr>
                    <?php
                    }
                     ?>
                </tbody>
            </table>
        </div>
    </body>
</html>