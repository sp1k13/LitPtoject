<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сторінка конкурса</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<style>
   body {          
        position: relative;
	    font-family: 'Noto Sans', sans-serif;
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
        max-width: 2200px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .contest-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px; 
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
        .pop_up {
            width:100%;
            height:100%;
            position: fixed;
            left: 0;
            top: 0;
            background-color: transparent;
            z-index: 2;      
            transform: translateY(-44.5%) scale(0%); 
            transition: .1s ease-in-out;   
        }
        .pop_up.active{
            transform: translateY(0%) scale(100%);
            background-color: rgba(0,0,0, .8);
        }

        .pop_up_container {
            display: flex;
            width: 100%;
            height: 100%;
            
        }
        .pop_up_body {
            margin: auto;
            width: 1000px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
            padding: 100px 15px 110px 15px;
            position: relative;
        }
        .pop_up_close{
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 21px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-application{
        float: left;
        margin-top: -10px;
        padding: 8px 16px;          
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
        }
</style>
</head>
<body>
    <div class = "container">
    <button class="btn-container" button id="btn-container" onclick="window.history.back()">Назад</button>
    <button class= "btn-application" button id="btn-application" onclick="window.location.href='../application.php'">Додати свою роботу</button>
           <?php
 require_once("../database.php");

$filename = basename($_SERVER['PHP_SELF'], ".php");
$competition_id = filter_var($filename, FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM competitions WHERE id = $competition_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<td style='text-align: center;'><img src='data:image/jpeg;base64,".base64_encode($row['img'])."' width='450' style='display: block; margin-left: auto; margin-right: auto;' /></td>";
        echo "<td><h1>" . $row["name"] . "</h1></td>";
        echo "<td><p>" . $row["description"] . "</p></td>";

    }
} else {
    echo "0 results";
}
?>
        <p><span style="font-size: 20px;">Додаткову інформацю ви зможете знайти на <a href="https://italent.org.ua/nomination/2d-graphics">цьому сайті</a>.</span></p>
    </div>
    <div class="pop_up" id="pop_up">
    <div class="pop_up_container">
        <div class="pop_up_body" id="pop_up_body">  
        <?php
            if (!isset($_SESSION['user_name'])) {
                echo 'Увійдіть у профіль';
            }
            else {
                ?>
                <h2 style="margin: 10px 0;"><?= $_SESSION['user_name'] ?></h2>
                <a href="#"><?= $_SESSION['email'] ?></a>
                <?php
            }
            ?>                 
            <h3>Збережені конкурси:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Назва</th>
                    </tr>
                </thead>
                <tbody>
                    <td>Немає збережених конкурсів</td>
                </tbody>
            </table>
            <a class="signup-link" href="public/regForm.php">Ще не маєте облікового запису? Зареєструйтися тут.  </a>
            <p><a href="public/logout.php" class="btn btn-warning">Вийти</a></p>
            <div class="pop_up_close" id="pop_up_close">&#10006</div>
        </div>
    </div>
</div>
<script src="../scripts/main.js"></script>
</body>
</html>