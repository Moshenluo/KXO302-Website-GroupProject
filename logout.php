<?php
session_start();
session_destroy();
echo '<script>alert("Your account has been logged out."); window.location.href="login.php";</script>';
exit;
?>