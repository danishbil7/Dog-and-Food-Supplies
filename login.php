<?php  

 include_once 'database.php';
 session_start();
 if(isset($_SESSION["staffid"]))  
      {  
        header("location:index.php");
      }

 try  
 {  
       $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["staffid"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM tbl_staffs_a189016_pt2 WHERE fld_staff_id = :staffid AND fld_staff_password = :password";  
                $stmt = $conn->prepare($query);  
                $stmt->execute(  
                     array(  
                          'staffid'     =>     $_POST["staffid"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $stmt->rowCount();  
                if($count > 0)  
                {  
                	
                    $_SESSION["staffid"] = $_POST["staffid"];  
                   
                  

                     header("location:login_success.php");  
                }  
                else  
                {  
                     $message = '<label>Wrong Password</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?> 

  
 <!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
      background-image: url("background.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container img.logo {
      display: block;
      margin: 0 auto 20px;
      max-width: 100%;
      height: auto;
    }

    .container label {
      font-size: 16px;
      font-weight: bold;
    }

    .container input[type="text"],
    .container input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .container input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .container .text-danger {
      color: #ff0000;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <br>
  <div class="container">
    <?php
    if (isset($message)) {
      echo '<label class="text-danger">' . $message . '</label>';
    }
    ?>

    <img src="logo.png" alt="Logo" class="logo">

    <form method="post">
      <label>Username</label>
      <input type="text" name="staffid" class="form-control">
      <br>
      <label>Password</label>
      <input type="password" name="password" class="form-control">
      <br>
      <input type="submit" name="login" class="btn btn-info" value="Log in">
    </form>
  </div>
  <br>
</body>
</html>
