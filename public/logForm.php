<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "../database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION['user_name'] = $user["login"];
                    $_SESSION['id'] = $user["id"];
                    $_SESSION['email'] = $user["email"];
                    $_SESSION['role'] = $user["role"]; 
                    header("Location: ../index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Пароль невірний</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Такої пошти немає</div>";
            }
        }
        ?>
      <form action="logForm.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="Введіть пошту:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Введіть пароль:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Увійти" name="login" class="btn btn-primary">
        </div>
      </form>
     <div><p>Ще не зареєстровані? <a href="regForm.php">Зареєструйтеся тут.</a></p></div>
    </div>
</body>
</html>