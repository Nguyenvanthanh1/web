<style>
    * {

        box-sizing: border-box;

    }


    .form-group input {
        /* background-image: url('https://photo2.tinhte.vn/data/attachment-files/2021/07/5557940__LIO2844.jpg'); */
        background-position: top right;
    }
</style>
<div style="background-image:url('https://photo2.tinhte.vn/data/attachment-files/2021/07/5557940__LIO2844.jpg');height:100vh" class="d-flex justify-content-center align-items-center">
    <div style="background-image:url('https://photo2.tinhte.vn/data/attachment-files/2021/07/5557940__LIO2844.jpg');height:700px;background-position:left top;border-radius:25px" class="">
        <form style="margin-top:50px;padding:50px" action="" method="post" enctype="multipart/form-data">

            <h2>Đăng ký</h2>
            <div class="form-group">
                <label for="name" name>Tên người dùng</label>
                <input type="email" name="username" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirm">Xác nhận lại mật khẩu</label>
                <input type="password" name="password_confirm" class="form-control" id="password_confirm">
            </div>
            <div class="form-group">
                <label for="file">Hình ảnh</label>
                <input type="file" name="file" class="form-control">
            </div>


            <input type="submit" name="submit" class="form-control btn btn-primary">
            <p>Nếu có tài khoản rồi thì ấn vào <a href="index.php?controller=account&action=login">đây</a></p>

        </form>
    </div>
</div>