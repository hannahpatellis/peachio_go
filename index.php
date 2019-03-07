<?php
session_start();
if(isset($_SESSION['user'])){header('Location: https://go.peachio.co/page/dashboard.php');}
else{header('Location: https://go.peachio.co/welcome.php');}
?>