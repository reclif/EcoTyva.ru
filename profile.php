<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

echo "Привет, " . htmlspecialchars($_SESSION['user_name']) . "!<br>";
echo "<a href='logout.php'>Выйти</a>";
?>