<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Подання роботи</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
<style>
body{
    font-family:'Lato', sans-serif;
    padding:50px;
    font-size: 20px;
    background-image: url('images/background.jpg');
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
.close {
    position: absolute;
    top: 80px;
    right: 965px;
    font-size: 18px;
    cursor: pointer;
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
#competition_name {
    width: 300px;
    box-sizing: border-box; 
}

</style>

</head>
<body>
<div class="container">
    <button class="btn-container" button id="btn-container" onclick="window.location.href='index.php'">На головну</button>
    <form action="application.php" method="post" enctype="multipart/form-data">
        <label for="full_name">ФІО:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>
        
        <label for="birth_date">Дата Народження:</label>
        <input type="date" id="birth_date" name="birth_date" required><br><br>
        
        <label for="address">Адреса:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="competition_name">Оберіть конкурс:</label>
        <select name="competition_name" id="competition_name" required><br><br>
            <?php
            require_once "database.php";
            $sql = "SELECT name FROM competitions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["name"]. "'>" . $row["name"]. "</option>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </select><br><br>
        
        <label for="nomination">Номінація:</label>
        <input type="text" id="nomination" name="nomination" required><br><br>

        <label for="work_name">Назва Роботи:</label>
        <input type="text" id="work_name" name="work_name" required><br><br>

        <label for="file">Додати роботу</label>
        <input type="file" name="img_upload" required><br><br>

        <div class="form-btn">
            <input type="submit" value="Додати" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>

<?php
if(isset($_POST["submit"])){
    $full_name = $_POST["full_name"];
    $birth_date = $_POST["birth_date"];
    $address = $_POST["address"];
    $competition_name = $_POST['competition_name'];
    $nomination = $_POST["nomination"];
    $work_name = $_POST["work_name"];
    $img_type = substr($_FILES['img_upload']['type'], 0, 5);
    $img_size = 100*1024*1024;
    if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size)
    {
        if (!file_exists("Роботи Учнів")) {
            mkdir("Роботи Учнів", 0777, true);
        }
        if (!file_exists("Роботи Учнів/" . $full_name)) {
            mkdir("Роботи Учнів/" . $full_name, 0777, true);
        }

        move_uploaded_file($_FILES['img_upload']['tmp_name'], "Роботи учнів/" . $full_name . '/' . $_FILES['img_upload']['name']);

        $img = addslashes(file_get_contents("Роботи учнів/" . $full_name . '/' . $_FILES['img_upload']['name']));
        $size = $_FILES['img_upload']['size']/1024;
        $img_name = $_FILES['img_upload']['name'];
        $conn->query("INSERT INTO competition_forms (name, birth_date, address, competition_name, nomination, work_name, img, img_name, img_size) VALUES ('$full_name', '$birth_date', '$address', '$competition_name', '$nomination', '$work_name', '$img','$img_name', '$size')");
    }
    if ($conn->query($sql) === TRUE) {
        echo "Новий запис успішно додано!";
        header("Location: index.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>