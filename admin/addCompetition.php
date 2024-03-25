<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Додавання конкурса</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
<style>
body{
    font-family:'Lato', sans-serif;
    padding:50px;
    font-size: 20px;
    background-image: url('../images/background.jpg');
    background-attachment: fixed; 
}
.container{
    max-width: 1000px;
    background-color: rgba(255, 255, 255, 0.9);
    margin:0 auto;
    padding:50px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
}
.form-group{
    margin-bottom:30px;
}
.btn-container {
    float: right;
    margin-top: -10px;
    padding: 8px 16px;          
    font-weight: 500;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.wide-textarea {
    width: 600px;
}


</style>

</head>
<body>
<div class="container">
<button class="btn-container" button id="btn-container" onclick="window.location.href='adminPageCompetitions.php'">Повернутися до списку конкурсів</button>
<form action="addCompetition.php" method="post" enctype="multipart/form-data">
                <label for="competition_name">Назва конкурсу:</label>
                <input type="text" id="competition_name" name="competition_name" required><br><br>
                
                <label for="competition_country">Країна:</label>
                <input type="text" id="competition_country" name="competition_country" required><br><br>
                
                <label for="competition_date">Дата конкурсу:</label>
                <input type="date" id="competition_date" name="competition_date" required><br><br>
                
                <label for="competition_age">Вікова категорія:</label>
                <input type="text" id="competition_age" name="competition_age" required><br><br>

                <label for="competition_description">Опис конкурсу:</label>
                <textarea id="competition_description" name="competition_description" rows="10" class="wide-textarea" required></textarea><br><br>
                
                <label for="competition_status">Статус конкурсу:</label>
<select id="competition_status" name="competition_status" required>
    <option value="active">Активний</option>
    <option value="inactive">Неактивний</option>
</select><br><br>

                <label for="file">Додати Логотип</label>
                <input type="file" name="img_upload"required><br><br>

            <div class="form-btn">
                <input type="submit" value="Додати" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>

<?php
require_once "../database.php";

if (isset($_POST["submit"])) {
    $competition_name = $_POST["competition_name"];
    $competition_country = $_POST["competition_country"];
    $competition_date = $_POST["competition_date"];
    $competition_age = $_POST["competition_age"];
    $competition_description = $_POST["competition_description"]; 
    $competition_status = $_POST["competition_status"];
    $img_type = substr($_FILES['img_upload']['type'], 0, 5);
    $img_size = 100*1024*1024;
    if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size)
    {
        $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
        $size = $_FILES['img_upload']['size']/1024;
        $img_name = $_FILES['img_upload']['name'];
        
        $conn->query("INSERT INTO competitions (name, country, date, age, description, status, img, img_name, img_size) VALUES ('$competition_name', '$competition_country', '$competition_date', '$competition_age', '$competition_description', '$competition_status', '$img', '$img_name', '$size')");     
    }


        $competition_id = $conn->insert_id;
        $files = glob('../competitionPages/competition*.php');
        
         $new_file_number = count($files) + 1;
        
         $new_file_path = '../competitionPages/competition' . $new_file_number . '.php';
         
         $new_file_content = '<?php session_start(); ?>' . "\n" .
          '<!DOCTYPE html>' .
        '<html lang="en">' .
        '<head>' .
        '    <meta charset="UTF-8">' .
        '    <meta name="viewport" content="width=device-width, initial-scale=1.0">' .
        '    <title>Сторінка конкурса</title>' .
        '    <link rel="preconnect" href="https://fonts.googleapis.com">' .
        '    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' .
        '    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">' .
        '<style>' .
        '   body {          ' .
        '        position: relative;' .
        '	    font-family: \'Noto Sans\', sans-serif;' .
        '	    font-size: 20px;' .
        '	    line-height: 1.4;' .
        '	    color: #000;' .
        '	    min-width: 320px;' .
        '	    overflow-x: hidden;' .
        '	    height: auto;' .
        '       background-image: url(\'../images/background.jpg\');' .
        '       background-attachment: fixed; ' .
        '    }' .
        '    .container {' .
        '        max-width: 2200px;' .
        '        margin: 50px auto;' .
        '        padding: 20px;' .
        '        background-color: rgba(255, 255, 255, 0.9);' .
        '        border-radius: 8px;' .
        '        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);' .
        '    }' .
        '    .contest-logo {' .
        '        display: flex;' .
        '        justify-content: center;' .
        '        align-items: center;' .
        '        margin-bottom: 20px; ' .
        '    }' .
        '    .btn-container {' .
        '        float: right;' .
        '        margin-top: -10px;' .
        '        padding: 8px 16px; ' .
        '        font-weight: 500;' .
        '        border: none;' .
        '        border-radius: 4px;' .
        '        cursor: pointer;' .
        '    }' .
        '        .pop_up {' .
        '            width:100%;' .
        '            height:100%;' .
        '            position: fixed;' .
        '            left: 0;' .
        '            top: 0;' .
        '            background-color: transparent;' .
        '            z-index: 2;     ' .
        '            transform: translateY(-44.5%) scale(0%); ' .
        '            transition: .1s ease-in-out;   ' .
        '        }' .
        '        .pop_up.active {' .
        '            transform: translateY(0%) scale(100%);' .
        '            background-color: rgba(0,0,0, .8);' .
        '        }' .
        '        .pop_up_container {' .
        '            display: flex;' .
        '            width: 100%;' .
        '            height: 100%;' .
        '        }' .
        '        .pop_up_body {' .
        '            margin: auto;' .
        '            width: 1000px;' .
        '            background-color: #fff;' .
        '            border-radius: 10px;' .
        '            text-align: center;' .
        '            padding: 100px 15px 110px 15px;' .
        '            position: relative;' .
        '        }' .
        '        .pop_up_close {' .
        '            position: absolute;' .
        '            top: 15px;' .
        '            right: 15px;' .
        '            font-size: 21px;' .
        '            cursor: pointer;' .
        '        }' .
        '        table {' .
        '            width: 100%;' .
        '            border-collapse: collapse;' .
        '            margin-top: 20px;' .
        '        }' .
        '        th, td {' .
        '            border: 1px solid #dddddd;' .
        '            padding: 8px;' .
        '            text-align: left;' .
        '        }' .
        '        th {' .
        '            background-color: #f2f2f2;' .
        '        }' .
        '        .btn-application{' .
        '        float: left;' .
        '        margin-top: -10px;' .
        '        padding: 8px 16px;          ' .
        '        font-weight: 500;' .
        '        border: none;' .
        '        border-radius: 4px;' .
        '        cursor: pointer;' .
        '        }' .
        '</style>' .
        '</head>' .
        '<body>' .
        '    <div class = "container">' .
        '    <button class="btn-container" button id="btn-container" onclick="window.location.href=\'../index.php\'">На головну</button>' .
        '    <button class="btn-application" button id="btn-application" onclick="window.location.href=\'../application.php\'">Додати свою роботу</button>' .         
        
        
        $new_file_content .= '<?php' . "\n" .
        ' require_once("../database.php");' . "\n" .
        '$filename = basename($_SERVER[\'PHP_SELF\'], ".php");' . "\n" .
        '$competition_id = filter_var($filename, FILTER_SANITIZE_NUMBER_INT);' . "\n" .
        '$sql = "SELECT * FROM competitions WHERE id = $competition_id";' . "\n" .
        '$result = $conn->query($sql);' . "\n" .
        'if ($result->num_rows > 0) {' . "\n" .
        '    while($row = $result->fetch_assoc()) {' . "\n" .
        '        echo "<td style=\'text-align: center;\'><img src=\'data:image/jpeg;base64,".base64_encode($row[\'img\'])."\' width=\'450\' style=\'display: block; margin-left: auto; margin-right: auto;\' /></td>";' . "\n" .
        '        echo "<h1>" . $row["name"] . "</h1>";' . "\n" .
        '        echo "<p>" . $row["description"] . "</p>";' . "\n" .
        '    }' . "\n" .
        '} else {' . "\n" .
        '    echo "0 results";' . "\n" .
        '}' . "\n" .
        '?>' . "\n" .
        '<p><span style="font-size: 20px;">Додаткову інформацю ви зможете знайти на <a href="https://italent.org.ua/nomination/2d-graphics">цьому сайті</a>.</span></p>' .
        '    </div>' .
        '    <div class="pop_up" id="pop_up">' .
        '    <div class="pop_up_container">' .
        '        <div class="pop_up_body" id="pop_up_body">  ' .
        '            <?php' . "\n" .
        '    if (!isset($_SESSION[\'user_name\'])) {' . "\n" .
        '        echo \'Увійдіть у профіль\';' . "\n" .
        '    } else {' . "\n" .
        '    ?>' . "\n" .
        '    <h2 style="margin: 10px 0;"><?= $_SESSION[\'user_name\'] ?></h2>' . "\n" .
        '    <a href="#"><?= $_SESSION[\'email\'] ?></a>' . "\n" .
        '    <?php' . "\n" .
        '    }' . "\n" .
        '    ?>' . "\n" .
        '            <h3>Збережені конкурси:</h3>' .
        '            <table>' .
        '                <thead>' .
        '                    <tr>' .
        '                        <th>Назва</th>' .
        '                    </tr>' .
        '                </thead>' .
        '                <tbody>' .
        '                    <td>Немає збережених конкурсів</td>' .
        '                </tbody>' .
        '            </table>' .
        '            <a class="signup-link" href="public/regForm.php">Ще не маєте облікового запису? Зареєструйтися тут.  </a>' .
        '            <p><a href="public/logout.php" class="btn btn-warning">Вийти</a></p>' .
        '            <div class="pop_up_close" id="pop_up_close">&#10006</div>' .
        '        </div>' .
        '    </div>' .
        '</div>' .
        '<script src="../scripts/main.js"></script>' .
        '</body>' .
        '</html>';

        file_put_contents($new_file_path, $new_file_content);
        
        header("Location: ../index.php");
        exit;
    } else {
        echo $sql . "<br>" . $conn->error;
    }
?>