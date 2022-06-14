<?php
require_once 'controller/Controller.php';
require_once 'model/Category.php';
require_once 'helper/PaginationCategory.php';
require_once 'model/Pagination.php';

class CategoryController extends Controller
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
        $limit = 4;
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $model_cate = new Category();
        //Trang 1 thì start=0->1
        //Trang 2 thì start=2->3
        //Trang 3 thì start=4->5
        $start = ($page - 1) * $limit;
        $str_pagination = "Limit $start,$limit";
        //Phải lấy được trang hiện tại thì mới xác định dc start
        $category = $model_cate->getAllCate($str_pagination);
        //$new = $model_post->getAllNew();
        $params = [
            'total' => $model_cate->countTotal(),
            'limit' => 4 //Số bản ghi hiển thị trên 1 trang
        ];

        //$categorys = $model_cate->getAllCate();
        $_SESSION['cate'] = $category;
        $pagination_test = new PaginationCategory($params);
        $pages = $pagination_test->getPagination();
        $this->content = $this->render('view/category/index.php', ['pages' => $pages]);
        require_once 'view/admin/index.php';
    }

    public function create()
    {
        if (isset($_POST['submit'])) {

            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            $name = $_POST['name'];

            if (empty($name) && !is_numeric($name)) {
                $this->error = "Phải nhập danh mục và danh mục phải là chữ";
            }

            if (empty($this->error)) {

                $model_cate = new Category();
                $cate = $model_cate->create($name);

                if ($cate) {
                    $_SESSION['success'] = "Thêm mới thành công";
                    header('Location:index.php?controller=category');
                    exit();
                }
            }
        }


        $this->content = $this->render('view/category/create.php');
        require_once 'view/admin/index.php';
    }
    public function update()
    {
        $id = $_GET['id'];
        $model_cate = new Category();
        $cate = $model_cate->getOneCate($id);
        $_SESSION['getCateUpdate'] = $cate;
        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $model_cate = new Category();
            $arr = [
                'id' => $id,
                'name' => $name
            ];
            $update = $model_cate->updateCate($arr);
            if ($update) {
                $_SESSION['success'] = "Sửa danh mục thành công";
                header('Location:index.php?controller=category');
                exit();
            }
        }

        $this->content = $this->render('view/category/update.php');
        require_once 'view/admin/index.php';
    }
    public function delete()
    {
        $cate_id = $_GET['cate_id'];
        $model_cate = new Category();
        $model_cate->delCate($cate_id);

        if ($model_cate->delCate($cate_id)) {
            header('Location:index.php?controller=category');
            exit();
        }
    }
}
