<?php
require_once "../database.php";
$displayMessage = false; // Переменная для отображения сообщения

// Проверяем, была ли нажата кнопка submit
if (isset($_POST["submit"])) {
    $displayMessage = true; // Если была нажата, устанавливаем значение переменной в true
}
$message = ""; // Переменная для хранения сообщения об успешном или неудачном обновлении данных
$id = $name = $country = $date = $age = $description = $status = ""; // Инициализация переменных

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Получите остальные данные из формы и выполните их валидацию
    $name = $_POST['name'];
    $country = $_POST['country'];
    $date = $_POST['date'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Подготовьте SQL-запрос для обновления записи с использованием подготовленного запроса
    $sql = "UPDATE competitions SET name=?, country=?, date=?, age=?, description=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Привязка параметров
    $stmt->bind_param("ssssssi", $name, $country, $date, $age, $description, $status, $id);

    if ($stmt->execute()) {
        $message = "Дані про конкурс успішно оновлені.";
    } else {
        $message = "Помилка при оновленні запису: " . $stmt->error;
    }

    // Закрываем подготовленное выражение
    $stmt->close();
    header("adminPageCompetitions.php");
} else {
    $message = "Невірний запит для оновлення даних про конкурс.";

    // Получение данных о конкурсе для вывода в текстовые поля
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM competitions WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $country = $row['country'];
            $date = $row['date'];
            $age = $row['age'];
            $description = $row['description'];
            $status = $row['status'];
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оновлення даних про конкурс</title>
    <style>
        body {
            position: relative;
            font-family:'Lato', sans-serif;
            font-size: 20px;
            line-height: 1.4;
            color: #000;
            min-width: 320px;
            overflow-x: hidden;
            height: auto;
            background-image: url('../images/background.jpg');
            background-attachment: fixed; 
        }
        .container {
            max-width: 2500px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], select, textarea {
            width: 300px;
            padding: 5px;
            font-family:'Lato', sans-serif;
            font-size: 20px;
        }
        .wide-textarea {
            width: 2000px;
            font-family:'Lato', sans-serif;
            font-size: 20px;
        }
        .btn-container {
            margin-top: -10px;
            padding: 20px 26px;          
            font-weight: 500;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            font-size: 15px;
        }
        .btn-container1 {
            float: right;
            margin-top: 40px;
            margin-right: 20px;
            padding: 8px 16px;          
            font-weight: 500;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }
        .message {
            background: linear-gradient(to right, #00FF7F, #98FF98);
            color: black;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease forwards;
        }
        
 
        @keyframes slideDown {
     0% {
        transform: translateY(-50px);
        opacity: 0;
        }
   100% {
        transform: translateY(0);
        opacity: 1;
        }
    }
    </style>
</head>
<body>
<?php if ($displayMessage): ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
<button class="btn-container1" button id="btn-container" onclick="window.location.href='adminPageCompetitions.php'">Повернутися до списку конкурсів</button>
<div class="container">
    <h1>Оновлення даних про конкурс</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Назва:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
            <label for="country">Країна:</label>
            <input type="text" id="country" name="country" value="<?php echo $country; ?>">
        </div>
        <div class="form-group">
            <label for="date">Дата:</label>
            <input type="text" id="date" name="date" value="<?php echo $date; ?>">
        </div>
        <div class="form-group">
            <label for="age">Вікова категорія:</label>
            <input type="text" id="age" name="age" value="<?php echo $age; ?>">
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea id="description" name="description" rows="20" class="wide-textarea" required><?php echo $description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Статус:</label>
            <select id="status" name="status">
                <option value="active" <?php if($status == 'active') echo 'selected'; ?>>Активний</option>
                <option value="inactive" <?php if($status == 'inactive') echo 'selected'; ?>>Неактивний</option>
            </select>
        </div>
        <input type="submit" value="Зберегти" name="submit" class="btn-container">
    </form>
</div>
</body>
</html>
