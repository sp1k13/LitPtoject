<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    $_SESSION['message1'] = 'Увійдіть у свій профіль або зареєструйтеся, щоб мати можливість зберігати і взаємодіяти з конкурсами.';
}
    

if ($_SESSION['role'] == 'admin') {
    $_SESSION['message2'] = 'Вітаю Адмін!';
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна Сторінка</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
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
        .profile-btn {
            float: right;
            margin-top: -10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;          
            font-weight: 500;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .profile-btn:hover {
            background-color: #45a049;
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
        .add-competition-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 15px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1;
        }
        .add-competition-btn:hover {
            background-color: #3e9641; 
        }
        .signup-link:hover {
            text-decoration: underline;
        }
        .signin-link{
            text-decoration: underline;
        }
        .message1 {
            background: linear-gradient(to right, #00FF7F, #98FF98);
            color: black;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease forwards;
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
        .adminPage-btn{
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1;
        }
        .adminPage-btn:hover {
            background-color: #3e9641; 
        }
       .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0px 0;
            font-size: 18px;
            color: #000000; 
            background-color: rgba(255, 255, 255, 0.9); 
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            text-align: left;
        }
        .btn:hover {
            background-color: rgba(255, 255, 255, 0.9); 
        }
        
        .save-btn {
            position: fixed;
            font-size: 30px;
            top: 5px;
            right: 5px; 
            width: 50px;
            height: 50px;
            cursor: pointer;
            z-index: 1;
        }

        @media (max-width:768px){
            .container{
                padding:20px;
                width: 100%; /* При малих розмірах екрану блоки займають всю ширину */
            }
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
       .message2 {
            background: linear-gradient(to right, #00FF7F, #98FF98);
            color: black;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease forwards;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px; /* Добавлен отступ снизу */
        }
        .info-section {
            width: 48%; /* Задаємо ширину для двох блоків у кожному рядку */
            margin-bottom: 20px;
        }
        .info-section img {
            width: 155px;
        }
        h1 {
            text-align: center;
        }
        hr {
            border: none;
            border-top: 2px solid black; 
            margin: 50px 50px; 
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

<?php
if (isset($_SESSION['message1'])) {
    echo '<div class="message1">' . $_SESSION['message1'] . '</div>';
    unset($_SESSION['message1']); 
}
?>
<?php
if (isset($_SESSION['message2'])) {
    echo '<div class="message2">' . $_SESSION['message2'] . '</div>';
    unset($_SESSION['message2']); 
}
?>
<div class="container">
<div class="site-description">
<h2>Ласкаво просимо до Сайту Конкурсів з Комп'ютерної Графіки!</h2>
        <p>Вітаємо вас на сайті, присвяченому захоплюючому світу конкурсів з комп'ютерної графіки! Тут ви знайдете захоплюючі змагання, які стимулюють та надихають нашу творчу спільноту.</p>
        <p>Наш сайт пропонує вам можливість ознайомитися з різноманітними конкурсами, що охоплюють усі аспекти комп'ютерної графіки. Ви зможете не лише дізнатися про поточні та майбутні події, але й взяти участь у них, демонструючи ваші навички та творчі здібності.
        Наші конкурси розраховані на широке коло учасників, незалежно від рівня досвіду та вікових обмежень. Тут кожен знайде щось для себе: від початківців до професіоналів.
        Будьте частиною нашої спільноти та відкрийте для себе нові можливості у світі комп'ютерної графіки! Долучайтеся до наших заходів, спілкуйтеся з однодумцями та розвивайте свої таланти разом з нами.</p>
        <p>Зареєструйтеся вже зараз та долучайтеся до нашої творчої спільноти!</p>
        <hr style="border-top: 2px solid white;">

        <h2>Поточні Конкурси</h2>
        <div style="text-align: center; margin-bottom: 20px;">
</div>




<div class="box-container">
<?php
require_once "database.php";
$today = date("Y-m-d");
$sql = "SELECT id, name, country, date, age, status FROM competitions";
$result = mysqli_query($conn, $sql);
$counter = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['status'] === 'active') { // Перевіряємо статус конкурсу
            echo "<div class='box' id='box" . $row['id'] . "'>"; // Добавлен уникальный идентификатор для каждого бокса
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>" . $row['country'] . "</p>";
            echo "<p>Початок конкурсу: " . $row['date'] . "</p>";
            echo "<p>Вік: " . $row['age'] . "</p>";
            
            // Добавление ссылок для первых двух элементов
            $competition_id = $row['id'];
            $competition_page_url = "competitionPages/competition$competition_id.php";
            echo "<a href='$competition_page_url' class='btn'>Дізнатись більше</a>";

            echo "</div>";

            $counter++;
        }
    }
    if ($counter === 0) {
        echo "<p>Немає активних конкурсів</p>";
    }
} else {
    echo "<p>Немає активних конкурсів</p>";
}
?>
</div>
<hr>
<div class="row">
<p><h1>ЧОМУ УЧАСТЬ В ОЛІМПІАДАХ ВАЖЛИВА</h1></p>


    <div class="row">
        <div class="info-section">
            <img src="images/why1.jpg" alt="Image 1">
            <div>
                <h2>ЦЕ ПІЗНАВАЛЬНО</h2>
                <p>Для виконання олімпіадних і конкурсних завдань необхідно добре опанувати сучасні WEB-технології, що додає вам необхідних знань, стимулює творче самовдосконалення</p>
            </div>
        </div>

        <div class="info-section">
            <img src="images/why2.jpg" alt="Image 2">
            <div>
                <h2>ЦЕ КОРИСНО</h2>
                <p>Олімпіади - це особливе випробування, яке не просто тестує знання, а й ґартує зібраність та самостійність. Змагання допомагають вірно оцінити свої навички та знання, порівняти свої можливості з вміннями конкурентів</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="info-section">
            <img src="images/why3.jpg" alt="Image 3">
            <div>
                <h2>ЦЕ ЦІКАВО</h2>
                <p>Олімпіалні змагання - прекрасна нагода поспілкуватися з однодумцями, знайти нових друзів, вічути атмосферу науки, познайомитися з нестандартними алгоритмами та оригінальними підходами</p>
            </div>
        </div>

        <div class="info-section">
            <img src="images/why4.jpg" alt="Image 4">
            <div>
                <h2>ЦЕ НОВИЙ ДОСВІД</h2>
                <p>Можливість реалізації своїх здібностей, можливість набути досвід змагань, шанс отримати суспільне визнання своїх талантів. Учатсь в олімпіаді дозволяє долучитись до більш глибоких пластів науки</p>
            </div>
        </div>
    </div>
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
                <p><h2 style="margin: 10px 0;"><?= $_SESSION['user_name'] ?></h2></p>
                <p><a href="#"><?= $_SESSION['email'] ?></a></p>
                <?php
            }
            ?>
            <p><a class="signup-link" href="public/regForm.php">Ще не маєте облікового запису? Зареєструйтися тут.  </a></p>
            <p><a href="public/logout.php" class="signin-link">Вийти</a></p>
            <div class="pop_up_close" id="pop_up_close">&#10006</div>
        </div>
    </div>
</div>

<script src="/scripts/main.js"></script>
</body>
</html>