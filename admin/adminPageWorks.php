<?php
require_once("../database.php");
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM competition_forms WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Помилка при видаленні записа: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Роботи учнів</title>
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
    text-align: left;
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
    .btn-delete{  
        background-color: #ff0000; 
        color: #ffffff;
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    </style>
</head>
<body>
<div class="container">
    
    <h2>Усі подані анкети</h2>
    <input type="text" id="myInputName" onkeyup="filterTable('myInputName', 1)" placeholder="Фільтр за ім'ям..">
    <input type="text" id="myInputAddress" onkeyup="filterTable('myInputAddress', 3)" placeholder="Фільтр за адресою..">
    <?php

$sql = "SELECT name FROM competitions";
$result = $conn->query($sql);

echo "<select id='competitionFilter' onchange=\"filterTable('competitionFilter', 4)\">";
echo "<option value=''>Всі конкурси</option>"; 

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
    }
}
echo "</select>";

?>
    <button class="btn-container" button id="btn-container" onclick="window.location.href='../index.php'">На головну</button>
    <table id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Дата Народження</th>
                <th>Адресса</th>
                <th>Конкурс</th>
                <th>Номінація</th>
                <th>Назва роботи</th>
                <th>Робота</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php
           

            $sql = "SELECT id, name, birth_date, address, competition_name, nomination, work_name, img, img_name, img_size FROM competition_forms";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["birth_date"]."</td>";
                    echo "<td>".$row["address"]."</td>";
                    echo "<td>".$row["competition_name"]."</td>";
                    echo "<td>".$row["nomination"]."</td>";
                    echo "<td>".$row["work_name"]."</td>";
                    echo "<td><img src='data:image/jpeg;base64,".base64_encode($row['img'])."' width='450' /></td>";
                    echo "<td>
                    <button class='btn-delete' onclick=\"if(confirm('Ви впевнені що хочете видалити цю роботу?')){window.location.href='?delete=true&id=".$row["id"]."'}\">Видалити</button>
                        </td>";
                   echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }
            $conn->close();
            ?>
        </div>
        </tbody>
    </table>
    <script>
    function filterTable(filterId, column) {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById(filterId);
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[column];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}

</script>
і
</body>і
</html>і