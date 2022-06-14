<table style="width:400px" class="table table-dark table-bordered">
    <?php $user = $_SESSION['getUserId']  ?>
    <tr>
        <td>ID</td>
        <td><?= $user['id'] ?></td>
    </tr>
    <tr>
        <td>Username</td>
        <td><?= $user['username'] ?></td>
    </tr>
    <tr>
        <td>Avatar</td>
        <td><img style="width:100px;height:100px" class="img-thumbnail" src="../frontend/asset/uploads/user/<?= $user['image'] ?>" alt=""></td>
    </tr>
    <tr>
        <td>Địa chỉ</td>
        <td><?= $user['address'] ?></td>
    </tr>
    <tr>
        <td>Số điện thoại</td>
        <td><?= $user['phone'] ?></td>
    </tr>
    <tr>
        <td>Ngày tạo</td>
        <td><?= $user['created_at'] ?></td>
    </tr>
</table>