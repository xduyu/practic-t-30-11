<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Оставьте ваш отзыв</h1>
        <form action="save_message.php" method="POST">
            <p> Ваше имя:</p><br>
            <input type="text" id="name" name="name" required><br><br>

            <p> Ваше сообщение:</p><br>
            <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
    
            <button>Отправить</button>
        </form> 
    <hr> 
    <a href="view_messages.php">Посмотреть все отзывы</a>
    <?php
        session_start();
        if (isset($_SESSION['form_res'])) {
            $name = $_SESSION['form_res']["name"];
            $errors = $_SESSION['form_res']["errors"];
        
            if (empty($errors)) {
                echo "</br> Name: ". $name;
            } else {
                for ($i=0; $i < sizeof($errors); $i++) { 
                    echo "</br> error: " . $errors[$i];
                }
            }
        }
    ?>
</body>

</html>