<?php
require_once "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $competition_id = $_POST['competition_id'];
    $user_id = $_POST['user_id'];

    $stmt = $conn->prepare("INSERT INTO saved_competitions (user_id, competition_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $competition_id);

    if ($stmt->execute()) {
        echo "Конкурс успешно сохранен!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    header('Location:index.php');
    $stmt->close();
}
