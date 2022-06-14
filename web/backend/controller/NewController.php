<?php

require_once 'controller/Controller.php';
require_once 'model/Post.php';
require_once 'helper/PaginationNew.php';
require_once 'model/Pagination.php';
class NewController extends Controller
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
        $model_post = new Post();
        //Trang 1 thì start=0->1
        //Trang 2 thì start=2->3
        //Trang 3 thì start=4->5
        $start = ($page - 1) * $limit;
        $str_pagination = "Limit $start,$limit";
        //Phải lấy được trang hiện tại thì mới xác định dc start
        $new = $model_post->getAllNew($str_pagination);
        //$new = $model_post->getAllNew();
        $params = [
            'total' => $model_post->countTotal(),
            'limit' => 2 //Số bản ghi hiển thị trên 1 trang
        ];
        $_SESSION['new'] = $new;
        $pagination_test = new PaginationTest($params);
        $pages = $pagination_test->getPagination();
        $this->content = $this->render('view/news/index.php', [
            'new' => $new,
            'pages' => $pages
        ]);
        require_once 'view/admin/index.php';
    }

    public function create()
    {
        $filename = '';
        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $des = $_POST['des'];
            $date = $_POST['date'];
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";
            $file = $_FILES['file'];
            if (empty($name) || empty($date)) {
                $this->error = "Tên tin tức và ngày tháng phải nhập";
            }

            if ($file['error'] == 0) {
                $extension = $file['name'];
                $extension = pathinfo($extension, PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $size = $file['size'];
                $size = $size / 1024 / 1024;
                $size = ceil($size);
                $arr = [
                    'jpg', 'png', 'gif'
                ];
                if (!in_array($extension, $arr)) {
                    $this->error = "Không đúng định dạng hình ảnh";
                } elseif ($size > 2) {
                    $this->error = "File không được vượt quá 2MB";
                }
                if (empty($this->error)) {
                    if ($file['error'] == 0) {
                        $dir = 'asset/uploads/new';

                        if (!file_exists($dir)) {
                            mkdir($dir);
                        }
                        $filename = time() . '-' . $file['name'];
                    }
                }
                $arr = [
                    'name' => $name,
                    'date' => $date,
                    'image' => $filename,
                    'des' => $des
                ];
                $model_post = new Post();
                $news = $model_post->addNew($arr);

                if ($news) {
                    move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                    header('Location:index.php?controller=new');
                    exit();
                }
            }
        }
        $this->content = $this->render('view/news/create.php');
        require_once 'view/admin/index.php';
    }
    public function update()
    {
        $id = $_GET['id'];
        $model_post = new Post();
        $select = $model_post->getOneNew($id);
        $_SESSION['getOneNew'] = $select;
        // echo "<pre>";
        // print_r($select);
        // echo "</pre>";
        if (isset($_POST['submit'])) {
            $file = $_FILES['file'];
            $name = $_POST['name'];
            $date = $_POST['date'];
            $des = $_POST['des'];
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // echo "<pre>";
            // print_r($_FILES);
            // echo "</pre>";
            if (empty($name) || empty($date)) {
                $this->error = "Tên tin tức và ngày tháng phải nhập";
            }

            if ($file['error'] == 0) {
                $extension = $file['name'];
                $extension = pathinfo($extension, PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $size = $file['size'];
                $size = $size / 1024 / 1024;
                $size = ceil($size);
                $arr = [
                    'jpg', 'png', 'gif'
                ];
                if (!in_array($extension, $arr)) {
                    $this->error = "Không đúng định dạng hình ảnh";
                } elseif ($size > 2) {
                    $this->error = "File không được vượt quá 2MB";
                }
            }
            if (empty($this->error)) {
                if ($file['error'] == 0) {
                    $dir = 'asset/uploads/new';

                    if (!file_exists($dir)) {
                        mkdir($dir);
                    }

                    $filename = time() . '-' . $file['name'];
                }
            }
            $arr = [
                'name' => $name,
                'date' => $date,
                'image' => $filename,
                'id' => $id,
                'des' => $des
            ];
            $model_post = new Post();
            $update = $model_post->updateNew($arr);

            if ($update) {
                move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                header('Location:index.php?controller=new');
                exit();
            }
        }
        $this->content = $this->render('view/news/update.php');
        require_once 'view/admin/index.php';
    }
    public function delete()
    {
        $id = $_GET['id'];
        $model_post = new Post();

        $del = $model_post->delNew($id);

        if ($del) {
            $_SESSION['success'] = "Xoá thành công";
            header('Location:index.php?controller=new');
            exit();
        }
    }
    public function detail()
    {
        $id = $_GET['id'];
        $model_post = new Post();
        $select = $model_post->getOneNew($id);
        $_SESSION['detailPost'] = $select;
        $this->content = $this->render('view/news/detail.php');
        require_once 'view/admin/index.php';
    }
}
