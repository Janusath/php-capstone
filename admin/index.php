<?php

session_start();
include("../resources/views/config/db.php");
include("../resources/views/config/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - NiceAdmin Bootstrap Template</title>

  <!-- Favicons -->
  <link href="../public/admin/assets/img/favicon.png" rel="icon">
  <link href="../public/admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../public/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../public/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../public/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../public/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../public/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../public/admin/assets/css/style.css" rel="stylesheet">
</head>

<body>

        <!-- Dynamic Page Load -->
        <?php

        // Include header, page, and footer
        include "../resources/views/includes/admin/header.php";
        include "../resources/views/includes/admin/sidebar.php";


      $page = 'dashboard/dashboard'; // Default page

      // Check if the 'page' parameter exists in the URL
      if (isset($_GET['page'])) {
            $page = $_GET['page']; // Override the default if 'page' is provided
          }

          // Restrict pages to the 'admin' folder
          $page = 'admin/' . $page;
          // Construct the page path
          $pagePath = "../resources/views/pages/" . $page . ".php";
          if (file_exists($pagePath)) {
            include $pagePath;
          } else {
            echo "<h3>Page not found: " . $pagePath . "</h3>";
          }
            include "../resources/views/includes/admin/footer.php";
        ?>


  <!-- Back to Top -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../public/admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../public/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../public/admin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../public/admin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../public/admin/assets/vendor/quill/quill.js"></script>
  <script src="../public/admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../public/admin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../public/admin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../public/admin/assets/js/main.js"></script>

</body>

</html>