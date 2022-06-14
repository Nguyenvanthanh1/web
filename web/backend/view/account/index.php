<div class="d-flex justify-content-center flex-column align-items-center">
    <label for="">Bảng người dùng</label>
    <table style="width:500px" class="table table-dark">
        <caption>Bảng người dùng</caption>
        <tr>
            <td>ID</td>
            <td>Tài khoản</td>
            <td>Ngày tạo</td>
        </tr>
        <tr>
            <?php foreach ($_SESSION['getAllUser'] as $user) : ?>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <th>
                    <a href="index.php?controller=account&action=detail&id=<?= $user['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                    <a href="index.php?controller=account&action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Bạn có muốn xoá người dùng không')"><i class="fa-solid fa-xmark"></i></a>
                </th>
        </tr>
    <?php endforeach; ?>
    </table>
</div>