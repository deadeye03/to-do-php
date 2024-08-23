<?php 
$conn = mysqli_connect("localhost", "root", "", "todo");
$id = intval($_GET['id']);
$newTask=$_POST['newTask'];

$sql = "UPDATE tasks SET task='$newTask' WHERE taskid=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: http://localhost/to-do");
} else {
  echo "Error updating record: " . $conn->error;
}