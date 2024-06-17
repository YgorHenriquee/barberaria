<?php
session_start();
session_unset();
session_destroy();
header("Location: /barber2/index.php");
exit;
?>
