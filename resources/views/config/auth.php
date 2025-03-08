<!-- without login cant go to any page  -->
<?php

// Redirect based on login status
if (!isset($_SESSION['id'])) {
    header("Location:http://localhost/php_capstone/resources/views/pages/admin/authentication/login.php");
    exit();
}?>