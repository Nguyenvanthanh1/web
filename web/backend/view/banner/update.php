<div class="">
    <form style="width:500px" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Tên banner</label>
            <input type="text" class="form-control" name="name" id="" value="<?= $getOne['name'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <input type="file" class="form-control" name="file" id="file">
            <img style="width:100px;height:60px;object-fit:cover" src="asset/uploads/banner/<?= $getOne['image'] ?>" alt="" id="img">
        </div>
        <div class="form-group">
            <label for="">Ngày tạo</label>
            <input type="date" class="form-control" name="date" value="<?= $getOne['date'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" name="submit" value="Sửa banner">
        <a class="btn btn-default" href="index.php?controller=banner">Trở về</a>
    </form>
</div>
<script>
    var file = document.querySelector('#file');
    var img = document.querySelector('#img');

    file.addEventListener('change', () => {
        var link = URL.createObjectURL(file.files[0]);
        img.setAttribute('src', link);

    })
</script>