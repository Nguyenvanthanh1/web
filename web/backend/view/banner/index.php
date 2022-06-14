<div class="d-flex justify-content-center flex-column align-items-center">
    <h2>Bảng banner</h2>
    <a class="btn btn-primary" href="index.php?controller=banner&action=create">Thêm banner</a>
    <table style="width:500px;" class="table table-dark table-bordered">
        <tr>
            <td>ID</td>
            <td>Tên banner</td>
            <td>Ngày tạo</td>
            <td></td>
        </tr>
        <?php foreach ($banner as $item) : ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['created_at'] ?></td>
                <th>
                    <a href="index.php?controller=banner&action=detail&id=<?= $item['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                    <a href="index.php?controller=banner&action=update&id=<?= $item['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                    <a href="index.php?controller=banner&action=delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn có muốn xoá banner này không')"><i class="fa-solid fa-xmark"></i></a>
                </th>
            </tr>
        <?php endforeach ?>
    </table>
    <?= $pages ?>
</div>
<style>
    table a {
        margin-left: 10px;
    }
</style>