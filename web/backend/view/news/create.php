<div class="d-flex justify-content-center">
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Thêm tin tức</h2>
        <div class="form-group">
            <label for="">Tên tin tức</label>
            <textarea name="name" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">Ngày tin tức</label>
            <input class="form-control" type="date" name="date">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <input class="form-control" type="file" name="file" id="file">
            <img style="width:100px;height:100px;object-fit:cover;display:none" src="" alt="" id="img">
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="form-control" name="des"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Thêm tin tức">
        <a class="btn btn-default" href="index.php?controller=new">Trở về</a>

    </form>
</div>
<script>
    var file = document.querySelector('#file');
    var img = document.querySelector('#img');
    file.onchange = function(e) {
        img.style.display = 'block';

        img.setAttribute('src', URL.createObjectURL(e.target.files[0]));
    }
</script>