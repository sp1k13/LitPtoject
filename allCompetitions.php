<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Про нас</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="libs/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="libs/bootstrap-grid.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

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
            background-image: url('images/background.jpg');
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
        .navbar ul{
            list-style-type: none;
            background-color: none;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar a{
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
            text-align: center;
        }
        .navbar a:hover{
            background-color: rgba(0, 0, 0, 0.1);
        }
        .navbar li{
            float: left;
        }
        .container .box-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap:30px;
            margin-top: 40px;
        }
        .container .box-container .box{
            box-shadow: 0 5px 10px rgba(0,0,0,.2);
            border-radius: 5px;
            background: #fff;
            text-align: center;
            padding:30px 20px;
        }
        .container .box-container .box img{
            height: 150px;
            width: 100%;
            object-fit: cover;
            object-position: center;
        }
        .container .box-container .box h3{
            color:#444;
            font-size: 22px;
            padding:10px 0;
        }
        .container .box-container .box p{
            color:#777;
            font-size: 15px;
            line-height: 1.8;
        }
        .container .box-container .box .btn{
            margin-top: 10px;
            display: inline-block;
            background:#333;
            color:#fff;
            font-size: 17px;
            border-radius: 5px;
            padding: 8px 25px;
        }
        .container .box-container .box .btn:hover{
            letter-spacing: 1px;
        }  
        .container .box-container .box:hover{
            box-shadow: 0 10px 15px rgba(0,0,0,.3);
            transform: scale(1.03);
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
        .dropdown {
            float: left;
            overflow: hidden;
        }

       .dropdown .dropbtn {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
            text-align: center;
        }
    
        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: rgba(0, 0, 0, 0.1);
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        transition-delay: 0.5s; /* Задержка перед исчезновением */
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .dropdown:hover .dropdown-content {
        display: block;
        transition-delay: 0.5s; /* Задержка перед исчезновением */
    }

    </style>
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="index.php">Переглянути конкурси</a></li>
        <li><a href="allCompetitions.php">Усі конкурси</a></li>
        <li><a href="about.php">Про нас</a></li>
        <li><a href="#" id="open_pop_up">Мій профіль</a></li>
        <?php
        if ($_SESSION['role'] == 'admin') {
        ?>
        <li class="dropdown">
            <a href="#" class="dropbtn">Панель керування</a>
            <div class="dropdown-content">
                <a href="admin/adminPageWorks.php" id="adminPage-btn">Роботи учнів</a>
                <a href="admin/adminPageCompetitions.php" id="add-competition-btn">Редагувати конкурси</a>
            </div>
        </li>
        <?php
        }
        ?>
    </ul>
</nav>
    <div class="container">
    <div class="site-description">
    <h2>Список Усіх Конкурсів </h2>
    <p>На цій сторінці міститься інформація про всі конкурси, які коли-небудь проходили на нашому сайті.</p>
    <p>Вітаємо вас у світі захоплюючих змагань з комп'ютерної графіки! Тут ви знайдете оглядову інформацію про всі події, що відбувалися та проходять на нашому порталі. Це включає опис конкурсів, їх тематику, умови участі, та інші важливі деталі.</p>
    <p>Долучайтеся до нашої творчої спільноти, де кожен знайде щось цікаве для себе незалежно від рівня досвіду та вікових обмежень. Зареєструйтеся прямо зараз, щоб бути в курсі найновіших подій та можливостей у світі комп'ютерної графіки!</p>
    </div>
    <div class="box-container">
    <?php
require_once "database.php";
$sql = "SELECT id, name, country, date, age, status FROM competitions";
$result = mysqli_query($conn, $sql);
$counter = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='box'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>" . $row['country'] . "</p>";
        echo "<p>Початок регістрації: " . $row['date'] . "</p>";
        echo "<p>Вік: " . $row['age'] . "</p>";
        
        // Вивід тексту "Активний" або "Неактивний" замість значення "active" або "inactive"
        $status_text = ($row['status'] == 'active') ? 'Активний' : 'Неактивний';
        echo "<p>Статус: $status_text</p>";
        
        $competition_id = $row['id'];
        $competition_page_url = "competitionPages/competition$competition_id.php";
        echo "<a href='$competition_page_url' class='btn'>Дізнатись більше</a>";
        
        echo "</div>";
        $counter++;
    }
} else {
    echo "<p>Немає активних конкурсів</p>";
}
?>
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
            <a class="signup-link" href="public/regForm.php">Ще не маєте облікового запису? Зареєструйтися тут.  </a>
            <p><a href="public/logout.php" class="btn btn-warning">Вийти</a></p>
            <div class="pop_up_close" id="pop_up_close">&#10006</div>
        </div>
    </div>
</div>
<script src="/scripts/main.js"></script>
</body>
</html>