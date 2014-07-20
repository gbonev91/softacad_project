<?php
require_once('include/bootstrap.php');

$user = new Users($db_connection);
$user->isLoggedIn();
$p = new Products($db_connection);
$addProductImage = new DBProductImage();
$productsImages = new ProductsImages($db_connection); 
$products = $p->getProductsAllImages($_GET['id']); // get all images for a product
$product = $p->get($_GET['id']); // get product title

if (isset($_GET['action'])) {
    switch ($_GET['action']) {  
        case 'delete':
            $getProductImage = $p->getProductImage($_GET['id'], $_GET['products_id']); // get image for the product
            unlink('../images/'. $getProductImage['image_name']);
            $productsImages->delete($getProductImage['id']);
            redirect('products_images.php?id='. $_GET['products_id'].'&action=delete_image');
        break;
        case 'add':
            $add = true;    
        break;  
        case 'delete_image':
            $delete = true;
        break;   
    }   
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['image']['tmp_name'] != '') {
        $filename = rand(1, 10000).$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
    } else {
        $fileError = true;
    }

    $addProductImage->image_name = $filename;
    $addProductImage->products_id = $_GET['id'];

    if (!$fileError) {
        $productsImages->add($addProductImage);
        redirect('products_images.php?id='.$_GET['id'].'&action=add');
    }
}

require_once('include/header.php');
?>
<div class="content">
    <h2> Добави или изтрий снимка за продукт: <em><?= $product['title']?></em> </h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>
            Качете картинка
            <input type="file" name="image">
        </label>
        <br>
        <button type="submit">Запази</button>
    </form>
    <?php $trCount = count($products); ?>
    <table>
        <tr>
            <th width="50%" colspan="<?=$trCount?>">Снимки</th>
        </tr>
        <?php 
            $limit = 0;
            for($i = 0; $i <= $trCount; $i++)  {
                $len = 3;
                $sliced = array_slice($products, $limit, $len);
                if (empty($sliced)) break;
        ?>
            <tr>
        <?php 
            foreach($sliced as $key=>$value) {
                $sliced = $products;        
        ?>
                    <td>
                        <img src="../images/<?=$value['image_name']?>" alt="" width="100">
                        <a href="products_images.php?id=<?=$value['id']?>&products_id=<?=$product['id']?>&action=delete" style="position: absolute;">[x]</a>
                        
                    </td>
        <?php } ?>
            </tr>
        <?php 
                $limit = $limit + $len;
            }
        ?>
    <br>
    <?php if ($fileError) : ?>
    <tr>
        <th colspan="<?=$trCount?>">
            <div class="errors">Не сте добавили картинка за продукта</div>
        </th>
    </tr>
    <?php  endif; ?>
    <?php if ($add) : ?>
    <tr>
        <th colspan="<?=$trCount?>">
            <div class="success">Успешно добавихте картинка за продукта</div>
        </th>
    </tr>
    <?php  endif; ?>
        <?php if ($delete) : ?>
    <tr>
        <th colspan="<?=$trCount?>">
            <div class="success">Изтриването успешно</div>
        </th>
    </tr>
    <?php  endif; ?>
    </table>
    <br>
</div>
<?php
require_once('include/footer.php');