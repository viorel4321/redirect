<?php
include 'Layer.php';
head("Redirect");
session_start();

$requested_url = $_SERVER["REQUEST_URI"];
$requested_path = parse_url($requested_url, PHP_URL_PATH);
$requested_path = ltrim($requested_path, '/');
$db = new Database();
$short_link_db = "http://la2interlude.com/" . $requested_path;
$sql = "SELECT * FROM link WHERE sort_link = '$short_link_db'";
$res = $db->connectDB()->query($sql);
$row = $res->fetch_assoc();
if (isset($row['link'])) {
    $sql = "UPDATE link SET transition = transition + 1 WHERE link = '$row[link]'";
    $db->connectDB()->query($sql);
    header('Location: ' . $row['link']);
} else {
    echo "Не существует такая ссылка";
}
?>