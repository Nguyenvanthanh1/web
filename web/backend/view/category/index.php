<div style="flex-direction:column" class="d-flex justify-content-center align-items-center">
    <style>
        table a {
            color: white;
        }

        table a i {
            padding-left: 5px;
        }
    </style>
    <table style="width:600px" class="table table-striped table-dark">
        <h2>Bảng danh mục</h2>
        <a class="btn btn-primary" href="index.php?controller=category&action=create">Thêm danh mục</a>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Ngày tạo</td>
            <td></td>

        </tr>
        <?php foreach ($_SESSION['cate'] as $cate) : ?>
            <tr>
                <td><?= $cate['cate_id'] ?></td>
                <td><?= $cate['name'] ?></td>
                <td><?= $cate['created_at'] ?></td>
                <th>
                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sửa danh mục" href="index.php?controller=category&action=update&id=<?= $cate['cate_id'] ?>"><i class="fa-solid fa-pen"></i></a>
                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Xoá danh mục" href="index.php?controller=category&action=delete&cate_id=<?= $cate['cate_id'] ?>" onclick="return confirm('Bạn có muốn xoá danh mục này không')"><i class="fa-solid fa-xmark"></i></a>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>
    <?= $pages ?>
</div>