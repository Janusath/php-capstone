<?php
session_start(); // Start session
include $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/resources/views/config/db.php";

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $facebook = $_POST['facebook_link'];
    $instagram = $_POST['instagram_link'];
    $linkedin = $_POST['linkedin_link'];
    $twitter = $_POST['twitter_link'];

    // File upload
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/PHP_CAPSTONE/public/uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $originalName = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $imageName = time() . "_" . $originalName . "." . $extension;
    $imagePath = $uploadDir . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        $sql = "INSERT INTO trainer (name, subject, description, image, facebook_link, instagram_link, linkedin_link, twitter_link) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $subject, $description, $imageName, $facebook, $instagram, $linkedin, $twitter);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Trainer added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add trainer: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt); // Close statement
    } else {
        $_SESSION['error'] = "File upload failed.";
    }

    mysqli_close($conn); // Close database connection
    // header("Location: show.php"); // Redirect to the show page
    exit();
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