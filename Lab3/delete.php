<?php
include 'config.php';
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$sql = "DELETE FROM users WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: list.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();
?>