<?php include('dbconnect.php');
if(!isset($_SESSION['user']))
{
    //user is not logged in redirect to login page
     $_SESSION['no-login-message']="<div class='altert alert-danger'>Please login to access </div>";
     header('location:'.SITEURL.'login.php');

}
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete']; // Display the message
    sleep(3); // Wait for 3 seconds
    unset($_SESSION['delete']); // Unset the session variable
}

?>
<!-- Dashboard.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php SITEURL;?>Dashboard.php">Student Admin Panel</a>
            <a class="btn btn-secondary" href="<?php SITEURL;?>logout.php">Logout</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Student Dashboard</h2>
        <a href="AddStudent.php" class="btn btn-primary">Add Student</a>
        <br>
        <br>
        <table class="table table-bordered">
         
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
          </thead>
            <?php
            
 //write sql to get the data from student table
 $sql="SELECT * from students";

 //execute the query 
 $res=mysqli_query($conn,$sql);
  
 //count the number of student
 $count = mysqli_num_rows($res);
 
 
 if($count>0)
 {
    //studen exist
    //echo "Student found";
    while($row=mysqli_fetch_assoc($res))
    {
        $id=$row['id'];
        $name=$row['name'];
        $email=$row['email'];
        $course=$row['course'];
        $status=$row['status'];
        ?>
            
    <tbody>
    <tr>
      
      <td><?php echo $id;?></td>
      <td><?php echo $name;?></td>
      <td><?php echo $email;?></td>
      <td><?php echo $course;?></td>
      <td><?php echo $status;?></td>
      <td> <a href="<?php SITEURL;?>UpdateStudent.php?id=<?php echo $id;?>" class="btn btn-warning btn-sm">Update</a>
      <a href="<?php SITEURL;?>deleteStudent.php?id=<?php echo $id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this student?')">Delete</a></td>
    </tr>
    </tbody>

<?php
    }   
 }
 else
 {
    //echo "No student Found";
    
 }
 ?>
                
           
        </table>
    </div>
</body>
</html>