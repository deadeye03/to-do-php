<?php 
$conn = mysqli_connect("localhost", "root", "", "todo");
$id = intval($_GET['id']);

// Perform necessary validation and authorization checks before deletion
// Delete the record from the database
$query = "DELETE FROM tasks WHERE taskid = $id";
if (mysqli_query($conn, $query)===TRUE) {
    header("Location: http://localhost/to-do");
}

