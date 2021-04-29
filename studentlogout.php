<?php
session_start();

session_destroy();
echo '<script> alert("You have successfully log out.")</script>';
echo '<script> window.location.href = "studentlogin.html";</script>';
?>