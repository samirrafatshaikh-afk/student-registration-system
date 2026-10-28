<?php
include "project.php";

// Agar ID set nahi hai ya khali hai, toh yahin rok do
if(!isset($_GET['id']) || empty($_GET['id'])){
    die("Error: ID nahi mili");
}

$ID = (int) $_GET['id'];

if(isset($_POST['update'])){
    $name = $_POST['student_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $sql = "UPDATE student SET Name='$name', Email='$email', Phone='$phone', Course='$course' WHERE ID=$ID";
    
    if(mysqli_query($mycon, $sql)){
        header("location:test.php");
        exit();
    }
}

$result = mysqli_query($mycon, "SELECT * FROM student WHERE ID=$ID");
$row = mysqli_fetch_assoc($result);

if(!$row){
    exit("student not found");
}
?>

<h2>Edit Student</h2>
<form method="post">
    Name: <input type="text" name="student_name" value="<?php echo $row['Name']; ?>"><br><br>
    Email: <input type="text" name="email" value="<?php echo $row['Email']; ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $row['Phone']; ?>"><br><br>
    Course: <input type="text" name="course" value="<?php echo $row['Course']; ?>"><br><br>
    <input type="submit" name="update" value="Update">
</form>