<div class="d-flex justify-content-center">
    <?php $new = $_SESSION['getOneNew'] ?>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Thêm tin tức</h2>

        <div class="form-group">
            <label for="">Tên tin tức</label>
            <textarea name="name" class="form-control"><?= $new['name'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="">Ngày tin tức</label>
            <input class="form-control" type="date" name="date" value="<?= $new['date'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <input class="form-control" type="file" name="file" id="file">
            <img class="img-thumbnail img-fluid" style="width:100px;height:100px;object-fit:cover" src="asset/uploads/new/<?= $new['image'] ?>" alt="" id="img">
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="form-control" name="des"><?= $new['description'] ?></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Thêm tin tức">
        <a class="btn btn-default" href="index.php?controller=new">Trở về</a>

    </form>
</div>
<script>
    var file = document.querySelector('#file');
    var img = document.querySelector('#img');
    file.onchange = function(e) {
        img.setAttribute('src', URL.createObjectURL(e.target.files[0]));
    }
</script>