<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/resources/views/config/db.php";

// Fetch trainer details
$id = ($_GET['id']);

// Fetch the trainer's existing data from the database
$sql = "SELECT * FROM trainer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $facebook = $_POST['facebook_link'];
    $instagram = $_POST['instagram_link'];
    $linkedin = $_POST['linkedin_link'];
    $twitter = $_POST['twitter_link'];
    $imageName = $row['image'];  // Preserve existing image if no new image is uploaded

    // File upload
    if ($_FILES["image"]["name"]) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/public/uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $originalName = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $imageName = time() . "_" . $originalName . "." . $extension;
        $imagePath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            $_SESSION['error'] = "File upload failed.";
            header("Location: edit.php?id=" . $id);
            exit();
        }
    }

    // Update trainer information in the database
    $sql = "UPDATE trainer 
            SET name = ?, subject = ?, description = ?, image = ?, facebook_link = ?, instagram_link = ?, linkedin_link = ?, twitter_link = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $name, $subject, $description, $imageName, $facebook, $instagram, $linkedin, $twitter, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Trainer updated successfully!";
        // header("Location: show.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update trainer: " . mysqli_error($conn);
    }

    $stmt->close(); // Close statement
    mysqli_close($conn); // Close database connection
}
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
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" required>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" value="<?php echo $row['subject'] ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Facebook Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="facebook_link" value="<?php echo $row['facebook_link'] ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Instagram Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $row['instagram_link'] ?>" name="instagram_link">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LinkedIn Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $row['linkedin_link'] ?>" name="linkedin_link">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Twitter Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $row['twitter_link'] ?>" name="twitter_link">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px" name="description"><?php echo $row['description']; ?></textarea>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Current Image</label>
                                <div class="col-sm-10">
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="/PHP_CAPSTONE/public/uploads/<?php echo $row['image']; ?>" width="150" alt="Trainer Image">
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