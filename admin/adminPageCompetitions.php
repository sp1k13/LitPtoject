<?php
require_once "../database.php";

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM competitions WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $filename = "competitionPages/competition$id.php";
        
        if (file_exists($filename)) {
            if (unlink($filename)) {
                echo "Файл $filename успешно удален.";
            } else {
                echo "Ошибка при удалении файла $filename.";
            }
        } else {
            echo "Файл $filename не существует.";
        }
    } else {
        echo "Помилка при видаленні записа: " . $conn->error;
    }
}

$sql = "SELECT * FROM competitions";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування конкурсів</title>
    <style>

    body{
    font-family: 'Poppins', sans-serif;
    padding:50px;
    font-size: 20px;
    background-image: url('../images/background.jpg');
    background-attachment: fixed; 
    }
    .container{
    max-width: 2000px;
    background-color: rgba(255, 255, 255, 0.9);
    margin:0 auto;
    padding:50px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
    }
    .form-group{
    margin-bottom:30px;
    }table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    }
    th, td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align:justify;
    }
    th {
    background-color: #f2f2f2;
    }
    .btn-container {
        float: right;
        margin-top: -10px;
        padding: 8px 16px;          
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
    }
    .btn-add {
        background-color: #4CAF50;
        color: #ffffff;
        float: left;
        margin-top: 10px;
        padding: 8px 16px;          
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
    }
    .btn-edit{        
        
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
        
    }
    .btn-delete{  
        background-color: #ff0000; 
        color: #ffffff;
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
    }
    .btn-save {  
        background-color: #008CBA; 
        color: #ffffff;
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
    }

    </style>
</head>
<!-- HTML -->
<body>
    <div class="container">
    <button class="btn-container" button id="btn-container" onclick="window.location.href='../index.php'">На головну</button>
        <h2>Список усіх конкурсів</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Країна</th>
                    <th>Дата</th>
                    <th>Вікова категорія</th>
                    <th>Опис</th>
                    <th>Логотип</th>
                    <th>Статус</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
            <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["country"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["age"]."</td>";
        echo "<td>".$row["description"]."</td>";
        echo "<td><img src='data:image/jpeg;base64,".base64_encode($row['img'])."' width='200' /></td>";

        // Вывод статуса конкурса в виде "Активний" или "Неактивний"
        echo "<td>";
        if ($row["status"] === "active") {
            echo "Активний";
        } else {
            echo "Неактивний";
        }
        echo "</td>";

        // Добавление кнопок редактирования и удаления
        echo "<td>
                <button class='btn-edit' onclick=\"window.location.href='updateCompetition.php?id=".$row["id"]."'\">Редагувати</button>
                <button class='btn-delete' onclick=\"if(confirm('Ви впевнені що хочете видалити цей конкурс?')){window.location.href='?delete=true&id=".$row["id"]."'}\">Видалити</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Нема данних про конкурси.</td></tr>";
}
?>

            </tbody>
        </table>
        <button class="btn-add" onclick="window.location.href='addCompetition.php'">Додати новий конкурс</button>
    </div>
    
</body>
</html>
