<?php
session_start();
require_once '../db/db.php';
if(isset($_POST['order'])){
    $user_name = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $connect->query("INSERT INTO `order` (`user_name`,`phone`,`email`) VALUES ('$user_name','$phone','$email')");
    $lastId = $connect->query("SELECT MAX(id) FROM `order` WHERE email='$email'");
    $lastId = $lastId->fetch(PDO::FETCH_ASSOC);
    $lastId = $lastId['Max(id)'];
    $message = htmlspecialchars("<h2>Ваш заказ по номером $lastId принят</h2>");
    $message .= "<h2>Состав заказа:</h2>";
    foreach ($_SESSION['cart'] as $product) {
        $message .= htmlspecialchars("{$product['rus_name']} в колличестве {$product['quantity']} <br>");
    }
    $message .= htmlspecialchars("<p>Cумма заказа: {$_SESSION['totalPrice']} рублей</p>");
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charser=utf-8' . "\r\n";
    $subject = htmlspecialchars("Ваш заказ принят $lastId");
    mail($email,$subject,$message,$headers);
    unset($_SESSION['totalQuantity']);
    unset($_SESSION['totalPrice']);
    unset($_SESSION['cart']);
    $_SESSION['order'] = $lastId;

//    echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
//
}
header ("Location: ".$_SERVER['HTTP_REFERER']);
