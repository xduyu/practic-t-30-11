<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? "";
    $user_avatar = $_POST['avatar'] ?? "";

    $error = [];
    $maxsize = 1024 * 1024 * 2; // 2MB
    if (!($_FILES['avatar']['error'] === UPLOAD_ERR_OK)){
        $error[] = $_FILES['avatar']['error'];
    }
    if (empty($username)){
        $error[] = 'Username err';
    }
    if ($_FILES['avatar']['type'] !== ('image/jpeg' || 'image/png')){
        $error[] = "file type doesn't support"; 
    }
    if ($_FILES['avatar']['size'] > $maxsize){
        $error[] = "file is too large"; 
    }

    $uploadPath = 'uploads/';
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath);
    }

    $fileName = $_FILES['avatar']['name'];
    $path = $uploadPath . $fileName;
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
        echo "File ". htmlspecialchars($fileName). " succesfully uploaded avatar for user: " . $username . ".";
        $jsonData = [
            "name" => $username,
            "avatar" => $path
        ];
        $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
        $file_path_json = 'data.json';
        $resultJson = file_put_contents($file_path_json, $jsonString);
    }
    $_SESSION['form_data'] = [
        "name" => $username,
        "image" => $path,
        "errors" => $error,
    ];
    header('Location: index.php');
    exit;
} else {
    header('Location: index.php');
    exit;
}