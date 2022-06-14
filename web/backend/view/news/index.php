<style>
    table a i {
        padding-left: 5px;
    }
</style>
<div class="d-flex flex-column justify-content-center align-items-center">
    <table style="width:700px" class="table table-dark table-bordered align-middle">
        <h2>Bảng tin tức</h2>
        <a class="btn btn-primary" href="index.php?controller=new&action=create">Thêm tin tức</a>
        <tr>
            <td>STT</td>
            <td>Name</td>

            <td>Ngày tạo</td>
            <td></td>
        </tr>
        <?php foreach ($_SESSION['new'] as $index => $new) : ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $new['name'] ?></td>

                <td><?= $new['created_at'] ?></td>
                <th>
                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Xem chi tiết " href="index.php?controller=new&action=detail&id=<?= $new['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sửa tin tức" href="index.php?controller=new&action=update&id=<?= $new['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Xoá tin tức" href="index.php?controller=new&action=delete&id=<?= $new['id'] ?>" onclick="return confirm('Bạn có muốn xoá tin tức này')"><i class="fa-solid fa-xmark"></i></a>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>

    <?= $pages ?>
</div>