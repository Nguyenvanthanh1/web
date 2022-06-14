<div class="">
    <?php $new = $_SESSION['detailPost'] ?>
    <table style="width:600px" class="table table-dark">
        <caption>Bảng chi tiết tin tức</caption>
        <tr>
            <td>ID</td>
            <td><?= $new['id'] ?></td>
        </tr>
        <tr>
            <td>Tên tin tức</td>
            <td><?= $new['name'] ?></td>
        </tr>
        <tr>
            <td>Ngày tạo</td>
            <td><?= $new['date'] ?></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td><img style="width:100px;height:100px" class="img-thumbnail" src="asset/uploads/new/<?= $new['image'] ?>" alt=""></td>
        </tr>

        <tr>
            <td>Mô tả</td>
            <td><?= $new['description'] ?></td>
        </tr>
    </table>
</div>