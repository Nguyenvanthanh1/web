<?php
require_once 'controller/Controller.php';
require_once 'model/Banner.php';
require_once 'model/Pagination.php';
require_once 'helper/PaginationBanner.php';

class BannerController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['getUser'])) {
            header('Location:index.php?controller=account&action=login');
            exit();
        }
    }
    public function index()
    {
        $str_pagination = "";
        //Xác định start và limit dựa vào url
        $limit = 2;
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $model_banner = new Banner();
        //Trang 1 thì start=0->1
        //Trang 2 thì start=2->3
        //Trang 3 thì start=4->5
        $start = ($page - 1) * $limit;
        $str_pagination = "Limit $start,$limit";
        //Phải lấy được trang hiện tại thì mới xác định dc start
        $banner = $model_banner->showBanner($str_pagination);
        //$new = $model_post->getAllNew();
        $params = [
            'total' => $model_banner->countTotal(),
            'limit' => 2 //Số bản ghi hiển thị trên 1 trang
        ];

        //$categorys = $model_cate->getAllCate();
        $pagination_test = new PaginationBanner($params);
        $pages = $pagination_test->getPagination();
        //$banner = $model_banner->showBanner();
        $this->content = $this->render('view/banner/index.php', ['banner' => $banner, 'pages' => $pages]);
        require_once 'view/admin/index.php';
    }
    public function detail()
    {

        $id = $_GET['id'];
        if (!isset($id) && !is_numeric($id)) {
            $this->error = "Id phải là số";
            header('Location:index.php?controller=banner');
            exit();
        }
        $model_banner = new Banner();
        $getOne = $model_banner->getBanner($id);

        $this->content = $this->render('view/banner/detail.php', ['getOne' => $getOne]);
        require_once 'view/admin/index.php';
    }
    public function update()
    {
        $id = $_GET['id'];
        if (!isset($id) && !is_numeric($id)) {
            $this->error = "Id phải là số";
            header('Location:index.php?controller=banner');
            exit();
        }
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $file = $_FILES['file'];
            if (empty($name)) {
                $this->error = "Phải nhập thông tin của banner";
            } elseif ($file['error'] == 0) {
                $path = $file['name'];
                $path = pathinfo($path, PATHINFO_EXTENSION);
                $path = strtolower($path);
                $arr_path = ['jpg', 'png', 'gif'];
                $size = $file['size'];
                $size = $size / 1024 / 1024;
                $size = ceil($size);
                if (!in_array($path, $arr_path)) {
                    $this->error = "Định dạng file không đúng";
                } elseif ($size > 2) {
                    $this->error = "File không được lớn hơn 2MB";
                }
            }
            if (empty($this->error)) {
                if ($file['error'] == 0) {

                    $dir = 'asset/uploads/banner';
                    if (!isset($dir)) {
                        mkdir($dir);
                    }
                    $filename = time() . '-' . $file['name'];
                    $model_banner = new Banner();

                    $arr = [
                        'id' => $id,
                        'name' => $name,
                        'image' => $filename,
                        'date' => $date
                    ];
                    $update = $model_banner->updateBanner($arr);
                    if ($update) {
                        $_SESSION['success'] = "Sửa banner thành công";
                        move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                        header('Location:index.php?controller=banner');
                        exit();
                    }
                }
            }
        }

        $model_banner = new Banner();
        $getOne = $model_banner->getBanner($id);

        $this->content = $this->render('view/banner/update.php', ['getOne' => $getOne]);
        require_once 'view/admin/index.php';
    }
    public function create()
    {

        if (isset($_POST['submit'])) {
            $filename = '';
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";

            $name = $_POST['name'];
            $date = $_POST['date'];
            $file = $_FILES['file'];
            if (empty($name) && empty($date)) {
                $this->error = "Phải nhập thông tin của banner";
            } elseif ($file['error'] == 0) {
                $path = $file['name'];
                $path = pathinfo($path, PATHINFO_EXTENSION);
                $path = strtolower($path);
                $arr_path = ['jpg', 'png', 'gif'];
                $size = $file['size'];
                $size = $size / 1024 / 1024;
                $size = ceil($size);
                if (!in_array($path, $arr_path)) {
                    $this->error = "Định dạng file không đúng";
                } elseif ($size > 2) {
                    $this->error = "File không được lớn hơn 2MB";
                }
            }
            if (empty($this->error)) {
                if ($file['error'] == 0) {

                    $dir = 'asset/uploads/banner';
                    if (!isset($dir)) {
                        mkdir($dir);
                    }
                    $filename = time() . '-' . $file['name'];
                }
                $model_banner = new Banner();

                $arr = [
                    'name' => $name,
                    'image' => $filename,
                    'date' => $date
                ];
                $insert = $model_banner->addBanner($arr);
                if ($insert) {
                    $_SESSION['success'] = "Thêm mới thành công";
                    move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                    header('Location:index.php?controller=banner');
                    exit();
                }
            }
        }

        $this->content = $this->render('view/banner/create.php');
        require_once 'view/admin/index.php';
    }
    public function delete()
    {
        $id = $_GET['id'];
        if (!isset($id) && !is_numeric($id)) {
            $this->error = "Id phải là số";
            header('Location:index.php?controller=banner');
            exit();
        }
        $model_banner = new Banner();

        $del = $model_banner->delBanner($id);
        if ($del) {
            $_SESSION['success'] = "Xoá banner thành công";
            header('Location:index.php?controller=banner');
            exit();
        }
    }
}
