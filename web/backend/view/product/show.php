<div class="d-flex justify-content-center align-items-center flex-column">
    <table style="width:700px;font-size:0.9rem" class=" caption-top table table-dark">
        <caption>Bảng chi tiết sản phẩm</caption>
        <?php $product = $_SESSION['getOneById'] ?>
        <a href="index.php?controller=product">Về trang danh sách</a>

        <tr>
            <td>Danh mục</td>
            <td><?= $_SESSION['getCateFor']['name'] ?></td>
        </tr>
        <tr>

            <td>Tên</td>
            <td><?= $product['name'] ?></td>
        </tr>
        <tr>
            <td>Giá</td>
            <td><?= $product['price'] ?></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td><img style="width:100px;height:100px;object-fit:cover" src="asset/uploads/product/<?= $product['image'] ?>" alt=""></td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td><?= $product['description'] ?></td>
        </tr>
    </table>
</div>