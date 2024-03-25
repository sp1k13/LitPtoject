<?php
session_start()
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
        } .pop_up {
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
    .img{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 250px;
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
    <img class="img" src="images/DLIT.png" alt="Image 1">
    <h1>Привіт, друзі!</h1>
<p>Я дуже радий вітати вас на моєму веб-сайті! Якщо ви зараз читаєте ці рядки, це означає, що ви дізналися про наш проєкт. Це велике задоволення вітати вас тут і поділитися з вами деталями проекту, над яким я працював.</p>

<p>Цей веб-сайт був створений мною, студентом Дніпровського ліцею інформаційних технологій при Дніпровському національному університеті імені Олеся Гончара. Я вдячний своєму куратору Пасько, який надав мені неоціненну допомогу та підтримку протягом всього процесу розробки. Його досвід та знання були незамінними в цьому процесі.</p>

<p>Мета мого проекту полягає в створенні платформи, що збирає любителів та професіоналів комп’ютерної графіки разом для участі в захоплюючих конкурсах, обміну досвідом та навичками, а також спілкування у відкритій та дружній атмосфері.</p>

<p>У сучасному світі, де комп’ютерна графіка стає все більш важливою в сфері мистецтва, дизайну, індустрії розваг та багатьох інших сферах, розвиток власних навичок у цій області стає дедалі важливішим. Крім того, змагання та конкурси є чудовим стимулом для творчого зростання та самовдосконалення.</p>

<p>Мій проект не лише сприяє розвитку навичок учасників, але й сприяє популяризації комп’ютерної графіки серед широкої аудиторії, допомагаючи залучати нових талантів та відкриваючи двері до нових можливостей у цій захоплюючій галузі.</p>

<p>Я завжди радий спілкуватися з моїми відвідувачами. Якщо у вас є будь-які питання, пропозиції або ідеї, будь ласка, зв’яжіться з мною через нашу форму зворотного зв’язку або скористайтеся нашою контактною інформацією.</p>

<h2>Контактна інформація</h2>
<p>Email: kuzhel_d@dlit.dp.ua</p>
<p>Телефон: +380 68 923 0870</p>

<p>Я дуже сподіваюся, що ви задоволені моїм проєктом. Я працював над ним з великою пристрастю та відданістю, і я сподіваюся, що це відображається в якості та функціональності сайту. Дякую вам за відвідування мого сайту і за вашу підтримку!</p>

<h2>Гарного Дня!</h2>
<p>Я щиро сподіваюся, що ви насолоджуєтесь перебуванням на моєму сайті. Якщо у вас є будь-які питання або коментарі, не соромтеся зв’язатися зі мною. Я завжди радий отримувати відгуки від своїх відвідувачів. Гарного дня!</p>


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