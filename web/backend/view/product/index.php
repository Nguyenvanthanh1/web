<div class="table-responsive d-flex flex-column justify-content-center align-items-center ">
    <table style="width:900px" class=" table align-middle table-dark table-bordered">
        <h2>Danh sách sản phẩm</h2>
        <a href="index.php?controller=product&action=create">Thêm mới sản phẩm</a>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Price</td>
            <td>Hình ảnh</td>
            <td>Mô tả</td>
            <td></td>
        </tr>
        <?php foreach ($_SESSION['products'] as $product) : ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><img class="img-thumbnail img-fluid" src="asset/uploads/product/<?= $product['image'] ?>" alt=""></td>
                <td>
                    <?= $product['description'] ?>
                </td>
                <th>

                </th>

            </tr>
        <?php endforeach; ?>
    </table>
</div>