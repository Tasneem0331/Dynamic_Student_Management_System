<?php
include('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    

    </head>
    <body>
        <div class="container mt-5">
        <form class="mx-auto" method="post">
            <h4 class="text-center">Login</h4>
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Write your username">
                  <br>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Write your password">
           
            <br><br>
            <button type="submit" class="btn btn-primary" name='submit'>Login</button>
        </form>

        </div>
        

    </body>

    <?php
    //check whether the submit button is cliked or not
    if(isset($_POST['submit']))
    {
        
       //process from login
       //get data from login form
       $username=$_POST['username'];
       $password=$_POST['password'];

       //retrive user record by username
       $sql="SELECT * from adminusers where username='$username'";

       //execute the query
       $res=mysqli_query($conn,$sql);

       //count the rows whether the user is exist or not
       $count=mysqli_num_rows($res);
       if($count>0)
       {
        $row=mysqli_fetch_assoc($res);

        //verify the password
        if(password_verify($password,$row['password']))
        {  
            $_SESSION['user']=$username;
            //user exist
            echo "<br><br>";
            echo  $_SESSION['login']="<div class='alert alert-success' >Login Successfully</div>";
    
            //redirect to dashboard.php
    
            header("Refresh: 1; url=" .SITEURL."Dashboard.php");

        }
        else
        {
           //admin does not exist
           echo "<br>";
           echo $_SESSION['login']="<div class='alert alert-danger' >Invalid Password.</div>";
           
   
           //redirect to login.php
   
           header("Refresh: 2; url=" .SITEURL."login.php");
        }
       

       }
       else
       {
          //admin does not exist
          echo "<br>";
          echo $_SESSION['login']="<div class='alert alert-danger' >No user found with that username.</div>";
          
  
          //redirect to login.php
  
          header("Refresh: 2; url=" .SITEURL."login.php");
       }

     
    }
    ?>

</html>

