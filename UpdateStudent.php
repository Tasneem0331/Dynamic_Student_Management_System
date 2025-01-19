<?php include('dbconnect.php');
if(!isset($_SESSION['user']))
{
    //user is not logged in redirect to login page
     $_SESSION['no-login-message']="<div class='altert alert-danger'>Please login to access </div>";
     header('location:'.SITEURL.'login.php');

}
;
?>


<!-- UpdateStudent.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php SITEURL;?>Dashboard.php">Student Admin Panel</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Update Student</h2>

        <?php
        //check whether the id is set or not
        //echo getting the data
        if(isset($_GET['id']))
        {
            //get the id and all other data
            $id=$_GET['id'];

            //write sql to get all the data
            $sql2="SELECT * from students where id=$id";

            //execute the sql
            $result =mysqli_query($conn,$sql2);

            //count the rows whether the id is valid or not 
            $count=mysqli_num_rows($result);

            if($count==1)
            {
                //get all the data
                $row=mysqli_fetch_assoc($result);
                $current_name=$row['name'];
                $current_eamil=$row['email'];
                $current_course=$row['course'];
                $current_status=$row['status'];

            }
            else
            {
                $_SESSION['no_student_found']="No student Found.";

                //redirect to dashboard
                header('location:'.SITEURL.'Dashboard.php');
            }


        }
        else
        {
            //redirect to dashbord 
            header('location:'.SITEURL.'Dashboard.php');
        
        }


        ?>
        <form method="post">
            <label>Student ID:</label>
            <input type="text" class="form-control" placeholder="update ID" name="stdId" value="<?php echo $id;?>">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Update Name" name="name" value="<?php echo $current_name;?>">
            <label>Email:</label>
            <input type="email" class="form-control" placeholder="Update Email" name="email" value="<?php echo $current_eamil;?>">
            <label>Course:</label>
            <input type="text" class="form-control" placeholder="Update Course" name="course" value="<?php echo $current_course;?>">

            <label>Status:</label>
            <select name="status" id="" class="form-control">
                <option  <?php if($current_status=='Enrolled'){echo "selected";}?> value="Enrolled">Enrolled</option>
                <option <?php if($current_status=='Graduated'){echo "selected";}?> value="Graduated">Graduated</option>
            </select>
            
            <button class="btn btn-primary mt-3" name="submit"> Update Student</button>
        </form>
    </div>
    <?php
        //get the selected id of the student 
   

    //check if the submit button is cliked 
    if(isset($_POST['submit']))
    {    
        //echo "submit button cliked";
        $std_id=$_POST['stdId'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $course=$_POST['course'];
        $status=$_POST['status'];

        //update in the database 
        //write query 
        $sql="UPDATE students SET
        id=$std_id,
        name='$name',
        email='$email',
        course='$course',
        status='$status'

        where id=$id

        ";

        //execute the query 
        $res=mysqli_query($conn,$sql);
        if($res==true){
            echo "<br><br>";
            echo "<div class='alert alert-success' role='alert'> Student Updated Successfully</div>";
            header("Refresh: 3; url=" . SITEURL . "Dashboard.php");
        }
        else
        {
            echo "<br><br>";
          echo "<div class='alert alert-danger'>Failed to update student.</div>";
          header("Refresh: 3; url=" . SITEURL . "Dashboard.php");
        }
    }


?>

</body>
</html>


