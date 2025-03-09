<?php
include $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/resources/views/config/db.php";

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $name = trim($_POST['name']);
    $subject = trim($_POST['subject']);
    $description = trim($_POST['description']);
    $facebook = trim($_POST['facebook_link']);
    $instagram = trim($_POST['instagram_link']);
    $linkedin = trim($_POST['linkedin_link']);
    $twitter = trim($_POST['twitter_link']);

    // Upload Directory
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "PHP_CAPSTONE" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle Image Upload
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        die("Error: Image file not uploaded or an error occurred.");
    }

    $imageName = time() . "_" . basename($_FILES["image"]["name"]); // Unique filename
    $imagePath = realpath($uploadDir) . DIRECTORY_SEPARATOR . $imageName;

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
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO trainer (name, subject, description, image, facebook_link, instagram_link, linkedin_link, twitter_link) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $subject, $description, $imageName, $facebook, $instagram, $linkedin, $twitter);

        if ($stmt->execute()) {
            echo "Trainer added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Could not upload the file.";
    }

    $conn->close();
}
?>


 
 
 <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Trainers</h5>

              <!-- General Form Elements -->
              <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name">
                  </div>
                </div>
             
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Subject</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="subject">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Facebook Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="facebook_link">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Instagram Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="instagram_link">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Linkdin Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="linkedin_link">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Twitter Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="twitter_link">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="description"></textarea>
                  </div>
                </div>
              
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="image">
                  </div>
                </div>
               
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->