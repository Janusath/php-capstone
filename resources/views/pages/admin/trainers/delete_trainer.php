<?php
// Enable error reporting for debugging

// Include database connection
include $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/resources/views/config/db.php";

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Trainer ID is missing.");
}

$id = $_GET['id'];

// Fetch trainer data to get the image name
$sql = "SELECT image FROM trainer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$trainer = $result->fetch_assoc();


// Delete image from server if it exists
$imagePath = $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/public/uploads/" . $trainer['image'];
if (file_exists($imagePath) && !empty($trainer['image'])) {
    unlink($imagePath); // Delete the file
}

// Delete trainer from database
$sql = "DELETE FROM trainer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Trainer deleted successfully.</p>";
} else {
    echo "<p style='color:red;'>Error deleting trainer: " . $stmt->error . "</p>";
}

// Close connection
$conn->close();

// Redirect back to the trainer list page

exit();
?>
