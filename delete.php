<?php
$server="localhost";
$username="root";
$password="";
$dbname="student";
$mycon=mysqli_connect($server,$username,$password,$dbname);
if(!$mycon){
    die("connection failed".mysqli_connect_error());
}
if(isset($_GET['id'])){
    $ID = $_GET['id'];

    $sql="delete from student where id =$ID";
    if(mysqli_query($mycon,$sql)){
        header("location: project.php");
        exit();
    }
    else{
        echo "error deleting record" .mysqli_error($mycon);
    }
}
?>