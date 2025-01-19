<?php
   include('dbconnect.php');
       //get id from dashbord
       $id=$_GET['id'];
       
        //write sql to delete the stuent

        $sql="DELETE  from students where id=$id";

        //execute the query
        $result=mysqli_query($conn,$sql);


        if($result==true)
        { 
           
            $_SESSION['delete']="<div class='alert alert-success'> Deleted Successfully</div>";

            //redirect to dashboard

             header('location:'.SITEURL.'Dashboard.php');
        }
       
       else
       {
        echo "<br> <br>";
        $_SESSION['delete']= "<div class='alert alert-danger'>Failed to delete.Incorrect Student ID</div>";

        //redirect to dashboard
        header('location:'.SITEURL.'Dashboard.php');

       }

 
    ?>