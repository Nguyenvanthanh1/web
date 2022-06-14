<div class="">
    <table style="width:800px" class="table table-dark table-bordered">
        <tr>
            <td>ID</td>
            <td><?= $getOne['id'] ?></td>
        </tr>
        <tr>
            <td>Tên banner</td>
            <td><?= $getOne['name'] ?></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td><img style="width:250px;object-fit:cover" src="asset/uploads/banner/<?= $getOne['image'] ?>" alt="">

            </td>
        </tr>
        <tr>
            <td>Ngày banner</td>
            <td><?= $getOne['date'] ?></td>
        </tr>
        <tr>
            <td>Thời gian</td>
            <td><?= $getOne['created_at'] ?></td>
        </tr>
    </table>
</div>