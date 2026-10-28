<?php
include "project.php";
$mycon=mysqli_connect("localhost","root","","student");
$search = trim($_GET['search'] ?? '');
if (!empty($search)) {
    $stmt = mysqli_prepare(
        $mycon,
        "SELECT * FROM student WHERE name LIKE ? OR email LIKE ?"
    );
    $keyword = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "ss", $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($mycon, "SELECT * FROM student");
}
?>
<h2>Registered Students</h2>
<form method="GET" action="test.php"> 
    <input type="text" name="search" placeholder="Search by name or email" >
    <button type="submit">Search</button>
    <a href="test.php">Show All</a>
</form>
<table boreder="1" cellpadding="10">
    <tr>
        <th>Name:</th>
         <th>Email:</th>
          <th>Phone:</th>
           <th>ID:</th>
            <th>COURSE:</th>
            <th>ACTION</th>
</tr>

    <?php
        if($result && mysqli_num_rows($result)>0){
             while($row = mysqli_fetch_assoc($result)) {
            // Database ke capital 'ID' ko variable me liya
            $student_id = $row['ID']; 

            // Delete aur Edit buttons ko safely variables me banaya
            $delete_btn = "<a href='delete.php?id=$student_id' onclick=\"return confirm('Are you sure you want to delete?');\">Delete</a>";
            $edit_btn = "<a href='edit.php?id=$student_id'>Edit</a>";

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Name'] ?? ''). "</td>";
            echo "<td>" . htmlspecialchars($row['Email'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['Phone'] ?? ''). "</td>"; // Database ke capital 'Phone' ke mutabiq
            echo "<td>" . htmlspecialchars($row['ID'] ?? '') ."</td>";
            echo "<td>" . htmlspecialchars($row['Course'] ?? '') . "</td>";
            echo "<td>" . $delete_btn . " | " . $edit_btn . "</td>";
            echo "</tr>";
        }

        }
        else{
            echo "no record";
        }
          
?>
</table>
</body>
</html>