<?php
// Error reporting on karne ke liye
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$mycon = mysqli_connect($server, $username, $password, $dbname);
$submitted=false;
$student_name=$email=$phone=$ID=$course="";

if (!$mycon) {
    die("Connection failed: " . mysqli_connect_error());
}
$student_name="";
$email="";
$phone="";
$ID="";
$course="";

if(isset($_POST['Register'])){
    $student_name=$_POST['student_name'] ?? '';
      $email=$_POST['email'] ?? '';
      $phone=$_POST['phone'] ?? '';
      $ID=$_POST['ID'] ?? '';
      $course=$_POST['Course'] ?? '';

      if(!empty($student_name) && !empty($email)){
        $sql="insert into student(Name,Email,Phone,ID,Course)values(?,?,?,?,?)";
        $ps=$mycon->prepare($sql);
        $ps->bind_param("ssiis",$student_name,$email,$phone,$ID,$course);
        $ps->execute();
        echo "insert";
      }
      $submitted=true;
}
?>
<!DOCTYPE html>
<html>  
<head>
    <style>
        body{
            font-family:arial;
            background-color:white;
            margin:0;
            padding:30px;
        }

        h2{
            text-align:center;
            color:#1e293b;
        }

        table{
            width:100px
            border-collpase:collpase;
            margin-top:20px;
            margin:auto;
            padding:10px;
            background-color:white;
        }

        th,td{
            border:1px solid #ddd;
            padding:12px;
            text-align:left;
        }

        th{
            background-color:#2563eb;
            color:white;
        }
         
        button{
            padding:8px 20px;
            background-color:lightgreen;
            cursor:pointer;
        }
        </style>
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration Form</h2>
    <form action="project.php" method="POST">
        <table border=1>
            <tr>
        <th>Name:</th>
        <td><input type="text" name="student_name" placeholder="Enter your name" required></td>
</tr>
     
            <tr>
        <th>Email:</th>
        <td><input type="email" name="email" placeholder="Enter your email" required></td>
</tr>
         <tr>
        <th>Phone:</th>
        <td><input type="tel" name="phone" placeholder="Enter your phone no" required></td>
</tr>
<tr>
    <th>ID:</th>
    <td><input type="text" name="ID" placeholder="Enter your ID" required></td>
</tr>
<tr>
    <th>Course:</th>
    <td><select name="Course">
        <option>BCA</option>
        <option>BSC IT</option>
        <option>BCOM</option>
        <input type="submit" name="Register" value="Submit">
</td>
</tr>
</table>
    </form>
    <br><hr></br>
   <!-- Success message print karne ka seedha tareeqa -->
    <?php 
    if ($submitted == true) {
        echo '
        <div style="background-color: #d4edda; color: #155724; padding: 20px; border: 2px solid #28a745; width: 400px; margin: 20px auto;">
            <h2> Registration Successful!</h2>
            <p><b>Name:</b> ' . htmlspecialchars($_POST['student_name']) . '</p>
            <p><b>Email:</b> ' . htmlspecialchars($_POST['email']) . '</p>
            <p><b>Phone:</b> ' . htmlspecialchars($_POST['phone']) . '</p>
            <p><b>ID:</b> ' . htmlspecialchars($_POST['ID']) . '</p>
            <p><b>Course:</b> ' . htmlspecialchars($_POST['Course']) . '</p>
        </div>';
    }
    ?>