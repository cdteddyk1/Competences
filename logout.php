<?php
session_start();
unset($_SESSION['connect']);
unset($_SESSION['id']);
header("Location: /Competence/");
?>