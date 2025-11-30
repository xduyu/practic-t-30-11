<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? "";
    $message = $_POST['message'] ?? "";

    $errors = [];
    if (empty($name)) $errors[] = "Empty name";
    if (empty($message)) $errors[] = "Empty message";

    $_SESSION['form_res'] = [
        "name" => $name,
        "errors" => $errors
    ];

    if (empty($errors)) {
        $filename = 'message.csv';
        $file = fopen($filename, 'a');

        if (filesize($filename) == 0) {
            fwrite($file, "\xEF\xBB\xBF"); // BOM для UTF-8
            fputcsv($file, ['NAME', "MESSAGE", "DATE"], ";");
        }
        fputcsv($file, [$name, $message, date('Y-m-d H-m-s')], ";");
        fclose($file);
    }
    header('Location: index.php');
    exit;

} else {
    header('Location: index.php');
    exit;
}