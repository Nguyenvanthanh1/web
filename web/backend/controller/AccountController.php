<?php
require_once 'controller/Controller.php';
require_once 'model/Account.php';
class AccountController extends Controller
{
    // public function __construct()
    // {
    //     if (!isset($_SESSION['getUser'])) {
    //         header('Location:index.php?controller=account&action=login');
    //         exit();
    //     }
    // }

    // public function register()
    // {
    //     if (isset($_POST['submit'])) {
    //         // echo "<pre>";
    //         // print_r($_POST);
    //         // echo "</pre>";
    //         $filename = '';
    //         $file = $_FILES['file'];
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];
    //         $password_confirm = $_POST['password_confirm'];
    //         $address = $_POST['address'];
    //         $date = $_POST['date'];
    //         $phone = $_POST['phone'];

    //         if (empty($username) || empty($password) || empty($password_confirm)) {
    //             $this->error = "Không được để trống các thông tin";
    //         } elseif ($password != $password_confirm) {
    //             $this->error = "Mật khẩu xác nhận chưa đúng";
    //         } elseif (!is_numeric($phone)) {
    //             $this->error = "Số điện thoại phải số ";
    //         }
    //         if ($file['error'] == 0) {
    //             $path = $file['name'];
    //             $path = pathinfo($path, PATHINFO_EXTENSION);
    //             $path = strtolower($path);
    //             $size = $file['size'];
    //             $size = $size / 1024 / 1024;
    //             $size = ceil($size);
    //             $arr = [
    //                 'jpg', 'png', 'gif'
    //             ];
    //             if (!in_array($path, $arr)) {
    //                 $this->error = "Định dạng file không hợp lệ";
    //             } elseif ($size > 2) {
    //                 $this->error = "File không được lớn hơn 2MB";
    //             }
    //         }
    //         if (empty($this->error)) {
    //             if ($file['error'] == 0) {
    //                 $dir = 'asset/uploads/user';
    //             }
    //             if (!file_exists($dir)) {
    //                 mkdir($dir);
    //             }
    //             $password_encry = password_hash($password, PASSWORD_BCRYPT);


    //             $filename = time() . '-' . $file['name'];
    //             $arr = [
    //                 'name' => $username,
    //                 'password' => $password_encry,
    //                 'password_confirm' => $password_confirm,
    //                 'address' => $address,
    //                 'date' => $date,
    //                 'image' => $filename,
    //                 'phone' => $phone
    //             ];

    //             $model_account = new Account();
    //             $insert = $model_account->register($arr);
    //             if ($insert) {
    //                 move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
    //                 $_SESSION['success'] = "Thêm tài khoản thành công";
    //                 header('Location:index.php?controller=account&action=login');
    //                 exit();
    //             }
    //         }
    //     }


    //     $this->content = $this->render('view/account/register.php');
    //     require_once 'view/layout/main.php';
    // }
    public function login()
    {
        if (isset($_SESSION['getUser'])) {
            header('Location:index.php?controller=home');
            exit();
        }
        if (isset($_POST['submit'])) {
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            $username = $_POST['username'];
            $model_account = new Account();
            $user = $model_account->getAdmin($username);
            // echo "<pre>";
            // print_r($user);
            // echo "</pre>";
            $password = $_POST['password'];
            if (empty($username) && empty($password)) {
                $this->error = "Phải nhập thông tin";
            }
            if (empty($user)) {
                $this->error = "Người dùng không tồn tại";
            } else {
                $same_pass = password_verify($password, $user['password']);
                // echo password_hash($password, PASSWORD_BCRYPT);
                if ($same_pass) {
                    $_SESSION['getUser'] = $user;
                    $_SESSION['success'] = "Đăng nhập thành công";
                    header('Location:index.php?controller=home');
                    exit();
                } else {
                    $this->error = "Sai tên tài khoản hoặc mật khẩu";
                }
            }
        }
        $this->content = $this->render('view/account/login.php');
        require_once 'view/layout/main.php';
    }
    public function registerAdmin()
    {

        if (isset($_POST['submit'])) {
            $filename = '';
            $file = $_FILES['file'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            if (empty($username) || empty($password) || empty($password_confirm)) {
                $this->error = "Không được để trống các thông tin";
            } elseif ($password != $password_confirm) {
                $this->error = "Mật khẩu xác nhận chưa đúng";
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
                    $dir = 'asset/uploads/admin';
                }
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
            }
            $filename = time() . '-' . $file['name'];

            $password = password_hash($password, PASSWORD_BCRYPT);
            $arr = [
                'name' => $username,
                'password' => $password,
                'password_confirm' => $password_confirm,
                'image' => $filename
            ];
            $model_account = new Account();
            $insert = $model_account->registerAdmin($arr);
            if ($insert) {
                move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                $_SESSION['success'] = "Thêm tài khoản thành công";
                header('Location:index.php?controller=account&action=login');
                exit();
            }
        }

        $this->content = $this->render('view/account/adminregister.php');
        require_once 'view/layout/main.php';
    }
    public function index()
    {
        if (!isset($_SESSION['getUser'])) {
            header('Location:index.php?controller=account&action=login');
            exit();
        }
        $model_account = new Account();
        $select = $model_account->getAllUser();
        $_SESSION['getAllUser'] = $select;
        $this->content = $this->render('view/account/index.php');
        require_once 'view/admin/index.php';
    }
    public function logout()
    {
        if (isset($_SESSION['getUser'])) {
            unset($_SESSION['getUser']);
            $_SESSION['success'] = "Đăng xuất thành công";
            header('Location:index.php?controller=account&action=login');
            exit();
        }
    }
    public function detail()
    {
        $id = $_GET['id'];
        $model_account = new Account();
        $select = $model_account->getUserId($id);
        $_SESSION['getUserId'] = $select;

        $this->content = $this->render('view/account/detail.php');
        require_once 'view/admin/index.php';
    }
    public function delete()
    {
        $id = $_GET['id'];

        $model_account = new Account();
        $del = $model_account->delUser($id);
        if ($del) {
            $_SESSION['success'] = 'Xoá người dùng thành công';
            header('Location:index.php?controller=account');
            exit();
        }
    }
}
