<?php
session_start();

// Подключение к базе данных
$host = 'localhost';
$dbname = 'user_auth';
$username = 'root'; // Замените на ваш логин
$password = 'root';     // Замените на ваш пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получение данных из формы
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Поиск пользователя по почте
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Успешная авторизация
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        echo "Добро пожаловать, " . htmlspecialchars($user['name']) . "! <a href='profile.php'>Профиль</a>";
    } else {
        echo "Неверная почта или пароль. <a href='login.html'>Попробовать снова</a>";
    }
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>