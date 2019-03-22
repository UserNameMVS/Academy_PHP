<?php
require_once 'parts/header.php';
if (isset($_GET['category'])) {
    $currentCategory = $_GET['category'];
    $errCategory = 'Страница не найдена. Воспользуйтесь меню';
    if($currentCategory == 'edible' || $currentCategory == 'poisonous' || $currentCategory == 'cool') {
        $products = $connect->query("SELECT * FROM products WHERE category='$currentCategory'");
        $products = $products->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $products = $connect->query("SELECT * FROM products");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="main">
    <? if(isset($products)) {
        foreach($products as $product) { ?>
            <div class="card">
                <a href="product.php?product=<?php echo $product['title']?>">
                    <img src="img/<? echo$product['img'] ?>" alt="<? echo $product['rus_name']?>">
                </a>
                <div class="label"><? echo $product['rus_name']?> (<? echo $product['price']?> рублей)</div>
                <form action="actions/add.php" method="post">
                    <input type="hidden" name="id" value="<?=$product['id']?>">
                    <input type="submit" value="Добавить в корзину">
                </form>
            </div>
        <? }}
    else {
        echo '<p>'.$errCategory.'</p><a href="index.php" title="На главную">Вернуться на главную</a>';
    }
    ?>
</div>

</body>
</html>

