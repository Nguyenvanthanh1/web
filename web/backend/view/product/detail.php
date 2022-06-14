<style>
    table a i {
        padding-left: 5px;
    }
</style>
<div class="d-flex flex-column justify-content-center align-items-center">
    <h3>Danh sách sản phẩm</h3>
    <span> <a class="btn btn-primary" href="index.php?controller=product&action=create">Thêm sản phẩm</a>
    </span>
    <table style="min-width:800px;" class=" caption-top table table-dark table-bordered">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Ngày tạo</td>

        </tr>
        <tr>

            <?php foreach ($_SESSION['products'] as $products) : ?>
                <td><?= $products['id'] ?></td>
                <td><?= $products['name'] ?></td>
                <td><?= $products['created_at'] ?></td>
                <th>
                    <a href="index.php?controller=product&action=detail&id=<?= $products['id'] ?>&cate_id=<?= $products['cate_id'] ?>"><i class="fa-solid fa-eye"></i></a>
                    <a href="index.php?controller=product&action=update&id=<?= $products['id'] ?>&cate_id=<?= $products['cate_id'] ?>"><i class="fa-solid fa-pen"></i></a>
                    <a href="index.php?controller=product&action=delete&id=<?= $products['id'] ?>" onclick="return confirm('Bạn có muốn xoá sản phẩm này khônng')"><i class="fa-solid fa-xmark"></i></a>
                </th>
        </tr>
    <?php endforeach ?>
    </table>
    <?= $pages ?>
</div>