<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Создайте ваш профиль</h1>
    <!-- ОБРАТИТЕ ВНИМАНИЕ: enctype ОБЯЗАТЕЛЕН для загрузки файлов -->
    <form action="save_profile.php" method="POST" enctype="multipart/form-data">
        <p>Имя пользователя:</p><br>
        <input type="text" id="username" name="username" required><br><br>

        <p> Загрузите аватар (только JPG, PNG):</p><br>
        <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png" required><br><br>

       	<button>Создать профиль</button>
    </form>
    <?php
    session_start();
    if (isset($_SESSION['form_data'])) {
        print_r($_SESSION['form_data']);
        $avatar = $_SESSION['form_data']['image'];
        echo "<img src='$avatar' alt=''>" . $_SESSION['form_data']['name'];
    }
    ?>
</body>

</html>