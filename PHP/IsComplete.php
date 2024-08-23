<?php 
$conn = mysqli_connect("localhost", "root", "", "todo");
$id = intval($_GET['id']);
$isComplete=$_POST['checkbox'];
echo $isComplete;
$sql = "UPDATE tasks SET isComplete='$isComplete' WHERE taskid=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: http://localhost/to-do");
} else {
  echo "Error updating record: " . $conn->error;
}