<div class="d-flex justify-content-center mt-4">

    <form style="width:700px" class="border rounded p-5" action="" method="post" enctype="multipart/form-data">
        <h2>Tạo sản phẩm</h2>
        <select class="form-select" name="cate" id="">
            <option disabled selected>Chọn danh mục sản phẩm</option>
            <option selected value="<?= $_SESSION['getOneCate']['cate_id'] ?>"><?= $_SESSION['getOneCate']['name'] ?></option>
        </select>
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input class="form-control" type="text" name="name" id="name" value="<?= $_SESSION['getOneProduct']['name'] ?>">
        </div>
        <div class="form-group">
            <label for="price">Giá sản phẩm</label>
            <input class="form-control" type="text" name="price" id="price" value="<?= $_SESSION['getOneProduct']['price'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <input class="form-control" id="file" type="file" name="file">
            <br />
            <img style="width:100px;height:100px;object-fit:cover" id="image" src="asset/uploads/product/<?= $_SESSION['getOneProduct']['image'] ?>" alt="">
        </div>
        <div class="form-group">
            <label for="des">Mô tả sản phẩm</label>
            <textarea style="height:70px" class="form-control" name="description" id="des"><?= $_SESSION['getOneProduct']['description'] ?></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Thêm mới">
        <a class="btn btn-default" href="index.php?controller=product">Trở về</a>

    </form>
</div>
<script>
    var file = document.querySelector('#file');
    var img = document.querySelector('#image');
    file.onchange = function(e) {
        img.setAttribute('src', URL.createObjectURL(e.target.files[0]));
    }
</script>