<?php
require_once 'parts/header.php';
if (isset($_SESSION['order'])) { ?>
    <h2 class="cart-title">Ваш заказ под номером <? echo $_SESSION['order'] ?>
        принят</h2>
    <a href="index.php" class="back">Вернуться на главную</a>
    <?
} else if (isset($_SESSION['cart']) == 0) { ?>
    <h2 class="cart-title">Ваша корзина пуста, добавьте товар</h2>
    <a href="index.php" class="back">Вернуться на главную</a>
<? } else {
    foreach ($_SESSION['cart'] as $key => $product) {
        ?>
        <div class="cart">
            <a href="product.php?product=<? echo $product['title'] ?>">
                <img src="img/<? echo $product['img'] ?>" alt="Фото>">
            </a>
            <div class="cart-descr">
                <? echo $product['rus_name'] ?> в
                количестве <? echo $product['quantity'] ?> шт на
                сумму <? echo $product['quantity'] * $product['price'] ?> рублей
            </div>
            <form action="actions/delete.php" method="POST">
                <input type="hidden" name="delete" value="<? echo $key ?>">
                <input type="submit" value="Удалить">
            </form>
        </div>

    <? } ?>
    <hr>

    <form action="actions/mail.php" method="POST" class="order">
        <input type="text" name="username" required placeholder="Ваше имя">
        <input type="text" name="phone" required placeholder="Ваш телефон">
        <input type="email" name="email" required placeholder="Ваш email">
        <input type="submit" name="order" value="Отправить заказ">
    </form>
<? } ?>

<hr>

</body>
</html>

