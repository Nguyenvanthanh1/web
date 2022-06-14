                <div class="d-flex justify-content-center mt-4">
                    <form style="border:1px solid #ccc;border-radius:20px;padding:30px;width:700px" class="" action="" method="post" enctype="multipart/form-data">

                        <h2>Tạo sản phẩm</h2>
                        <select class="form-select" name="cate" id="">
                            <option disabled selected>Chọn danh mục sản phẩm</option>
                            <?php foreach ($_SESSION['Cate'] as $cate) : ?>
                                <option value="<?= $cate['cate_id'] ?>"><?= $cate['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Giá sản phẩm</label>
                            <input class="form-control" type="text" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input id="file" type="file" name="file">
                            <br />
                            <img style="width:100px;height:100px;display:none;object-fit:cover" id="img" src="" alt="">
                        </div>
                        <div class="form-group">
                            <label for="des">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" id="des"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Thêm mới">
                        <a class="btn btn-default" href="index.php?controller=product">Trở về</a>
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