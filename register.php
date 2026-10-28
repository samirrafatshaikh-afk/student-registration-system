<?php
include "project.php";

$name = trim($_POST['student_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$course = $_POST['course'] ?? '';

if ($name === '' || $email === '' ||
    $phone === '' || $course === '') {
    exit("Please fill all fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email.");
}

if (!preg_match('/^[0-9]{10}$/', $phone)) {
    exit("Phone number must be 10 digits.");
}

if (!in_array($course, ['BCA', 'BSc IT', 'BCom'], true)) {
    exit("Please select a valid course.");
}

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO students (name, email, phone, course)
     VALUES (?, ?, ?, ?)"
);

mysqli_stmt_bind_param(
    $stmt, "ssss", $name, $email, $phone, $course
);

if (mysqli_stmt_execute($stmt)) {
    echo "Student Registered Successfully!";
    echo '<br><a href="students.php">View Students</a>';
} else {
    echo "Registration failed. Please try again.";
}
?>
