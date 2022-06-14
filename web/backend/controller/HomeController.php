<?php

require_once 'controller/Controller.php';

class HomeController extends Controller
{

    public function index()
    {
        if (!isset($_SESSION['getUser'])) {
            header('Location:index.php?controller=account&action=login');
            exit();
        }
        $this->content = $this->render('view/layout/home.php');
        require_once 'view/admin/index.php';
    }
}
