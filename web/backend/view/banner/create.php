<div class="">
    <form style="width:500px" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Tên banner</label>
            <input type="text" class="form-control" name="name" id="">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <input type="file" class="form-control" name="file" id="file">
            <img style="display:none;width:100px;object-fit:cover" src="" alt="" id="img">
        </div>
        <div class="form-group">
            <label for="">Ngày tạo</label>
            <input type="date" class="form-control" name="date">
        </div>
        <input class="btn btn-primary" type="submit" name="submit" value="Thêm banner">
    </form>
</div>
<script>
    var file = document.querySelector('#file');
    var img = document.querySelector('#img');

    file.addEventListener('change', () => {
        img.style.display = 'block';
        var link = URL.createObjectURL(file.files[0]);
        img.setAttribute('src', link);

    })
</script>