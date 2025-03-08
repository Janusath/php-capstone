<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Mentor Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../public/website/assets/img/favicon.png" rel="icon">
  <link href="../public/website/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../public/website/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/website/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/website/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../public/website/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../public/website/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../public/website/assets/css/main.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

       <!-- Dynamic Page Load -->
       <?php

// Include header, page, and footer
include "../resources/views/includes/website/header.php";


$page = 'home/home'; // Default page

// Check if the 'page' parameter exists in the URL
if (isset($_GET['page'])) {
    $page = $_GET['page']; // Override the default if 'page' is provided
  }

  // Restrict pages to the 'admin' folder
  $page = 'website/' . $page;
  // Construct the page path
  $pagePath = "../resources/views/pages/" . $page . ".php";
  if (file_exists($pagePath)) {
    include $pagePath;
  } else {
    echo "<h3>Page not found: " . $pagePath . "</h3>";
  }
    include "../resources/views/includes/website/footer.php";
?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../public/website/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../public/website/assets/vendor/php-email-form/validate.js"></script>
  <script src="../public/website/assets/vendor/aos/aos.js"></script>
  <script src="../public/website/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../public/website/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../public/website/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../public/website/assets/js/main.js"></script>

</body>

</html>