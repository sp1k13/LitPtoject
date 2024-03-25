<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $login = $_POST["name"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($login) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"Заповніть усі поля");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Введіть пошту");
           }
           if (strlen($password)<8) {
            array_push($errors,"Пароль має бути не менше 8 символів");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Пароль не співпадає");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Така пошта вже є!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (login, email, password, role) VALUES ( ?, ?, ?, 'user' )";
            $_SESSION['id'] = $user["id"];
            $_SESSION['user_name'] = $login;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'user';
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$login, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'> Ви успішно зареєструвалися. </div>";
                sleep(3);
                header('Location: ../index.php');
            }else{
                die("Щось пішло не так");
            }
           }
          

        }
        ?>
        <form action="regForm.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Ім'я:">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="Пошта:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Пароль:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Повторіть пороль:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Зареєструватися" name="submit">
            </div>
        </form>
        <div>
        <div><p>Вже зареєстровані? <a href="logForm.php">Увідіть у профіль.</a></p></div>
      </div>
    </div>
</body>
</html>