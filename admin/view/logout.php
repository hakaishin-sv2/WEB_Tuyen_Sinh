<?php
unset($_SESSION['user']);
header('Location: index.php?act=login');
exit();
?>
