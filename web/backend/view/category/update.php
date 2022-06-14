<div class="d-flex justify-content-center">
    <form action="" method="post">
        <h2>Sửa danh mục</h2>
        <div class="form-group">
            <label for="">Tên danh mục</label>
            <input class="form-control" type="text" name="name" value="<?= $_SESSION['getCateUpdate']['name'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" name="submit" value="Sửa danh mục">
    </form>
</div>