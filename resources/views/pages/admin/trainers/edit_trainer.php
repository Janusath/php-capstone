<?php
include $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/resources/views/config/db.php";

// Get trainer ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Trainer ID not provided.");
}

$id = intval($_GET['id']);

// Fetch trainer details
$sql = "SELECT * FROM trainer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$trainer = $result->fetch_assoc();

if (!$trainer) {
    die("Error: Trainer not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $subject = trim($_POST['subject']);
    $description = trim($_POST['description']);
    $facebook = trim($_POST['facebook_link']);
    $instagram = trim($_POST['instagram_link']);
    $linkedin = trim($_POST['linkedin_link']);
    $twitter = trim($_POST['twitter_link']);

    // Upload directory
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/public/uploads/";

    // Initialize $imageName to preserve old image if no new one is uploaded
    $imageName = $trainer['image'];

    // Check if a new image is uploaded
    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $imagePath = $uploadDir . $imageName;

        // Validate file type
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowedTypes)) {
            die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        // Check file size (Max: 2MB)
        if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
            die("Error: File size exceeds 2MB.");
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            die("Error: Could not upload the file.");
        }

        // Delete old image if new image uploaded
        if (!empty($trainer['image'])) {
            unlink($uploadDir . $trainer['image']);
        }
    }

    // Update trainer details in the database
    $updateSql = "UPDATE trainer SET name=?, subject=?, description=?, image=?, facebook_link=?, instagram_link=?, linkedin_link=?, twitter_link=? WHERE id=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssssi", $name, $subject, $description, $imageName, $facebook, $instagram, $linkedin, $twitter, $id);

    if ($updateStmt->execute()) {
        // Redirect to the trainers' list or display success message
        header("Location: http://localhost/php_capstone/admin/index.php?page=trainers/show_trainer");
        exit(); // Make sure to call exit after header to stop further execution
    } else {
        echo "Error: " . $updateStmt->error;
    }

    $updateStmt->close();
}

$conn->close();
?>


<!-- Edit Trainer Form -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Trainer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Trainers</li>
                <li class="breadcrumb-item active">Edit Trainer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Trainer</h5>

                        <form method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($trainer['name']) ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" value="<?= htmlspecialchars($trainer['subject']) ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Facebook Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="facebook_link" value="<?= htmlspecialchars($trainer['facebook_link']) ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Instagram Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="instagram_link" value="<?= htmlspecialchars($trainer['instagram_link']) ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LinkedIn Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="linkedin_link" value="<?= htmlspecialchars($trainer['linkedin_link']) ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Twitter Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="twitter_link" value="<?= htmlspecialchars($trainer['twitter_link']) ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px" name="description"><?= htmlspecialchars($trainer['description']) ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Current Image</label>
                                <div class="col-sm-10">
                                    <?php if (!empty($trainer['image'])): ?>
                                        <img src="/PHP_CAPSTONE/public/uploads/<?= htmlspecialchars($trainer['image']) ?>" width="150" alt="Trainer Image">
                                    <?php else: ?>
                                        <p>No image available</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Upload New Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Update Trainer</button>
                                </div>
                            </div>

                        </form><!-- End Edit Trainer Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
