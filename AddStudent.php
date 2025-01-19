<?php include('dbconnect.php');

if(!isset($_SESSION['user']))
{
    //user is not logged in redirect to login page
     $_SESSION['no-login-message']="<div class='altert alert-danger'>Please login to access </div>";
     header('location:'.SITEURL.'login.php');

}
?>


<!-- AddStudent.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php SITEURL;?>Dashboard.php">Student Admin Panel</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Add Student</h2>
      
       
        <form id="addStudentForm" action="AddStudent.php" method="post">
            <div class="mb-3">
                <label for="studentName" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentName"  name="name" placeholder="Enter student name" required>
            </div>
            <div class="mb-3">
                <label for="studentEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="studentEmail" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="studentCourse" class="form-label">Course</label>
                <input type="text" class="form-control" id="studentCourse" name="course" placeholder="Enter course" required>
            </div>
            <div class="mb-3">
                <label for="studentStatus" class="form-label">Status</label>
                <select class="form-select" id="studentStatus" name="status">
                    <option value="Enrolled">Enrolled</option>
                    <option value="Graduated">Graduated</option>
                </select>
            </div>
            <button type="submit"  name="submit" class="btn btn-success">Add Student</button>
        </form>
    </div>
    <?php
if(isset($_POST['submit']))
{
    //echo "button cliked";
      $name=$_POST['name'];
      $email=$_POST['email'];
      $course=$_POST['course'];
      $status=$_POST['status'];

      //write sql to insert the data into data base
      $sql="INSERT INTO students set
      name='$name',
      email='$email',
      course='$course',
      status='$status'
      ";

      //execute the query
      $res=mysqli_query($conn,$sql);

      if($res==true){
        echo "<br><br>";
    
        echo "<div class='alert alert-success' role='alert'> Student Added Successfully</div>";
        //redirect to the dashboard.php
        header("Refresh: 3; url=" . SITEURL . "Dashboard.php");
      }
      else
      {
        echo "<br><br>";
        
        echo "<div class='alert alert-danger' role='alert'>Failed to add student.</div>";
        header("Refresh: 3; url=" . SITEURL . "Dashboard.php");
      }

}

?>

</body>
</html>