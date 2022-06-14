<?php
require_once 'controller/Controller.php';
require_once 'model/Account.php';
require_once 'helper/Helper.php';

class UserController extends Controller
{
    public function login()
    {
        if (isset($_SESSION['user'])) {
            header('Location:index.php?controller=home');
            exit();
        }
        if (isset($_POST['submit'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $model_account = new Account();
            $user = $model_account->getUser($username);
            if (empty($username) && empty($password)) {
                $this->error = "Phải nhập tài khoản và mật khẩu";
            } elseif (empty($user)) {
                $this->error = "Người dùng chưa tồn tại";
            } else {
                $same = password_verify($password, $user['password']);
                if ($same) {
                    $_SESSION['user'] = $user;
                    $_SESSION['success'] = "Đăng nhập thành công";
                    header('Location:index.php?controller=home');
                    exit();
                } else {
                    $this->error = "Sai tên đăng nhập hoặc mật khẩu";
                }
            }
        }

        $this->content = $this->render('view/account/login.php');
        require_once 'view/layout/main.php';
    }

    public function register()
    {
        if (isset($_POST['submit'])) {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            $filename = '';
            $file = $_FILES['file'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $address = $_POST['address'];
            $date = $_POST['date'];
            $phone = $_POST['phone'];

            if (empty($username) || empty($password) || empty($password_confirm)) {
                $this->error = "Không được để trống các thông tin";
            } elseif ($password != $password_confirm) {
                $this->error = "Mật khẩu xác nhận chưa đúng";
            } elseif (!is_numeric($phone)) {
                $this->error = "Số điện thoại phải số ";
            }
            if ($file['error'] == 0) {
                $path = $file['name'];
                $path = pathinfo($path, PATHINFO_EXTENSION);
                $path = strtolower($path);
                $size = $file['size'];
                $size = $size / 1024 / 1024;
                $size = ceil($size);
                $arr = [
                    'jpg', 'png', 'gif'
                ];
                if (!in_array($path, $arr)) {
                    $this->error = "Định dạng file không hợp lệ";
                } elseif ($size > 2) {
                    $this->error = "File không được lớn hơn 2MB";
                }
            }
            if (empty($this->error)) {
                if ($file['error'] == 0) {
                    $dir = 'asset/uploads/user';
                }
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $password_encry = password_hash($password, PASSWORD_BCRYPT);
                $filename = time() . '-' . $file['name'];
                $arr = [
                    'username' => $username,
                    'password' => $password_encry,
                    'password_confirm' => $password_confirm,
                    'address' => $address,
                    'date' => $date,
                    'image' => $filename,
                    'phone' => $phone
                ];

                $model_account = new Account();
                $insert = $model_account->register($arr);
                if ($insert) {
                    move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                    $_SESSION['success'] = "Thêm tài khoản thành công";
                    header('Location:index.php?controller=user&action=login');
                    exit();
                }
            }
        }
        $this->content = $this->render('view/account/register.php');
        require_once 'view/layout/main.php';
    }
    public function resetPassword()
    {

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        if (isset($_POST['submit'])) {
            $email = $_POST['username'];
            if (empty($this->error)) {
                // - Gửi link vào email của user, link này chính là url để reset mật khẩu
                // -> ko truyền trực tiếp giá trị email lên url, mà cần mã hóa chuỗi email này
                //vd: index.php?controller=login&action=checkLinkReset&hash=abc@gmail.com
                //vd: index.php?controller=login&action=checkLinkReset&hash=fdafdsfdsfds321321321
                // - Cần check xem email đã tồn tại với tài khoản nào chưa
                $user_model = new Account();
                $user = $user_model->getUser($email);
                if (empty($user)) {
                    $this->error = 'Không tồn tại user nào gắn với email này';
                } else {
                    // - Tạo thêm 1 trường reset_password_token trong bảng users
                    // - Update chuỗi mã hóa ema il vào trường reset_password_token, demo mã hóa email = md5
                    $reset_password_token = md5($email); //
                    $is_update = $user_model->updateResetPasswordToken($user['id'], $reset_password_token);
                    if ($is_update) {
                        // - Gửi mail chứa link để reset password
                        $url_reset_password = "http://localhost/web/frontend/index.php?controller=user&action=checkLinkReset&hash=$reset_password_token";
                        // - Viết hàm gửi mail:
                        // + Tạo thư mục mvc_cart_frontend/backend/libraries/
                        // + Copy thư mục PHPMailer từ buổi trước vào thư mục libraries trên
                        // + Chú ý có 1 thư mục tên là helpers nằm ngay dưới backend
                        $subject = 'Thông báo thiết lập lại mật khẩu';
                        $to = $email;
                        $body = "Nhấn vào <a href='$url_reset_password'>đây</a> để thiết lập lại mật khẩu";
                        Helper::sendMail($subject, $to, $body);
                        $_SESSION['success'] = 'Vui lòng kiểm tra email để thiết lập lại mật khẩu';
                        header('Location: index.php?controller=user&action=resetPassword');
                        exit();
                    }
                }
            }
        }

        $this->content = $this->render('view/account/forget.php');
        require_once 'view/layout/main.php';
    }
    public function checkLinkReset()
    {
        // Xử lý submit form
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        if (isset($_POST['submit'])) {
            // index.php?controller=login&action=checkLinkReset&hash=eabdfe8eb1bbcbcc00c721d5b119b05
            // - Lấy tham số hash từ Url trước:
            $hash = $_GET['hash']; //
            // Nếu mã hash rỗng là ko hợp lệ
            if (empty($hash)) {
                $_SESSION['error'] = 'Mã hash ko hợp lệ';
                header('Location: index.php?controller=user&action=login');
                exit();
            }
            // - Lấy ra user đang có mã hash tương ứng,chính là trường reset_password_token
            $user_model = new Account();
            $user = $user_model->getUserByResetPasswordToken($hash);
            if (empty($user)) {
                $this->error = 'Không tìm thấy user nào ứng với mã hash';
            } else {
                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];
                // Validate:
                if ($password != $password_confirm) {
                    $this->error = 'Mật khẩu chưa trùng nhau';
                }
                if (empty($this->error)) {
                    // - Cập nhật mật khẩu mới cho user tương ứng vừa lấy đc,
                    // đồng thời cập nhật giá trị rỗng cho trường reset_password_token -> khi cập nhật
                    //mật khẩu thành công thì link reset mật khẩu sẽ ko còn tác dụng
                    // - Mật khẩu cần mã hóa trước khi update vào db, cơ chế mã hóa phải giống
                    //với chức năng đăng ký user
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $is_update = $user_model->updatePasswordReset($user['id'], $password_hash, $password_confirm);
                    if ($is_update) {
                        $_SESSION['success'] = 'Đổi mật khẩu thành công';
                        header('Location: index.php?controller=user&action=login');
                        exit();
                    }
                    $this->error = 'Không thể đổi mật khẩu vì có lỗi gì đó';
                }
            }
        }

        // - Gọi view để hiển thị
        $this->content = $this->render('view/account/check_link_reset.php');
        require_once 'view/layout/main.php';
    }
}
