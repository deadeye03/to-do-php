
<?php
$conn = mysqli_connect("localhost", "root", "", "todo");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_GET['date']; // Get date from the query parameter

$sql = "SELECT * FROM tasks WHERE createdAt='$date'";
$result = $conn->query($sql);

$tasks = array();
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}
echo json_encode($tasks);
?>
