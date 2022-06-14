<?php

require_once 'controller/Controller.php';
require_once 'model/Category.php';
require_once 'model/Product.php';
require_once 'model/Pagination.php';
require_once 'helper/PaginationTest.php';
class ProductController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['getUser'])) {
            $_SESSION['error'] = 'Yêu cầu đăng nhập';
            header('Location:index.php?controller=account&action=login');
            exit();
        }
    }
    public function index()
    {



        $model_product = new Product();
        //$products = $model_product->getProductLimit();
        $str_pagination = "";
        //Xác định start và limit dựa vào url
        $limit = 5;
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        //Trang 1 thì start=0->1
        //Trang 2 thì start=2->3
        //Trang 3 thì start=4->5
        $start = ($page - 1) * $limit;
        $str_pagination = "Limit $start,$limit";
        //Phải lấy được trang hiện tại thì mới xác định dc start
        $products = $model_product->getProductLimit($str_pagination);
        $_SESSION['products'] = $products;

        //lấy danh sách category đang có trên hệ thống để phục vụ cho search
        // $category_model = new Category();
        // $categories = $category_model->getAll();

        // Test cấu trúc phân trang
        $params = [
            'total' => $model_product->countTotal(),
            'limit' => 5 //Số bản ghi hiển thị trên 1 trang
        ];
        $pagination_test = new PaginationTest($params);
        $pages = $pagination_test->getPagination();
        $this->content = $this->render('view/product/detail.php', [
            'products' => $products,
            'pages' => $pages
        ]);
        require_once 'view/admin/index.php';
    }
    public function detail()
    {
        $cate_id = $_GET['cate_id'];
        $id = $_GET['id'];
        $model_product = new Product();
        $product = $model_product->getOneProduct($id);
        $_SESSION['getOneById'] = $product;
        $model_cate = new Category();
        $cate = $model_cate->getOneCate($cate_id);
        $_SESSION['getCateFor'] = $cate;
        $this->content = $this->render('view/product/show.php');
        require_once 'view/admin/index.php';
    }
    public function create()
    {

        $model_cate = new Category();

        $category = $model_cate->getAllCate();
        $_SESSION['Cate'] = $category;

        if (isset($_POST['submit'])) {
            $filename = '';
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            $name = $_POST['name'];
            $price = $_POST['price'];
            $des = $_POST['description'];
            $cate = $_POST['cate'];

            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";
            $file = $_FILES['file'];
            if (empty($name) || empty($price)) {
                $this->error = "Phải nhập tên và giá sản phẩm";
            } else if ($file['error'] == 0) {

                $size = $file['size'] / 1024 / 1024;
                $size = round($size, 2);
                echo $size;
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_path = [
                    'jpg', 'png', 'gif'
                ];
                if (!in_array($extension, $arr_path)) {
                    $this->error = "Sai định dạng file hình ảnh";
                } elseif ($size >= 2) {
                    $this->error = "File không được vượt quá 2MB";
                }
                if (empty($this->error)) {

                    if ($file['error'] == 0) {
                        $dir = 'asset/uploads/product';
                        if (!file_exists($dir)) {
                            mkdir($dir);
                        }
                        $filename = time() . '-' . $file['name'];
                    }
                }

                $model_product = new Product();

                $arr = [
                    'cate' => $cate,
                    'name' => $name,
                    'price' => $price,
                    'image' => $filename,
                    'des' => $des
                ];
                $insert = $model_product->addProduct($arr);
                if ($insert) {
                    move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                    $_SESSION['success'] = "Thêm sản phẩm thành công";
                    header('Location:index.php?controller=product');
                    exit();
                }
            }
        }
        $this->content = $this->render('view/product/create.php');
        require_once 'view/admin/index.php';
    }
    public function update()
    {
        $id = $_GET['id'];
        $cate_id = $_GET['cate_id'];
        $model_product = new Product();
        $product = $model_product->getOneProduct($id);
        $_SESSION['getOneProduct'] = $product;
        $model_cate = new Category();
        $cate = $model_cate->getOneCate($cate_id);
        $_SESSION['getOneCate'] = $cate;

        if (isset($_POST['submit'])) {


            $file = $_FILES['file'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $des = $_POST['description'];
            if (empty($name) && empty($price)) {
                $this->error = "Phải nhập tên và giá sản phẩm";
            } elseif (!is_numeric($price)) {
                $this->error = "Giá tiền phải là số";
            } else if ($file['error'] == 0) {

                $size = $file['size'] / 1024 / 1024;
                $size = round($size, 2);
                echo $size;
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_path = [
                    'jpg', 'png', 'gif'
                ];
                if (!in_array($extension, $arr_path)) {
                    $this->error = "Sai định dạng file hình ảnh";
                } elseif ($size >= 2) {
                    $this->error = "File không được vượt quá 2MB";
                }
            }
            if (empty($this->error)) {

                if ($file['error'] == 0) {
                    $dir = 'asset/uploads/product';
                    if (!file_exists($dir)) {
                        mkdir($dir);
                    }
                    $filename = time() . '-' . $file['name'];
                }
            }

            $update = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $filename,
                'des' => $des
            ];
            $insert = $model_product->updateProduct($update);
            if ($insert) {
                move_uploaded_file($file['tmp_name'], $dir . '/' . $filename);
                $_SESSION['success'] = "Sửa sản phẩm thành công";
                header('Location:index.php?controller=product');
                exit();
            }
        }
        $this->content = $this->render('view/product/update.php');
        require_once 'view/admin/index.php';
    }

    public function delete()
    {


        $id = $_GET['id'];

        $model_product = new Product();
        $del = $model_product->delProduct($id);

        if ($del) {
            header('Location:index.php?controller=product');
            exit();
        }
    }
}
