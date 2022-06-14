<?php
require_once 'controller/Controller.php';

class HomeController extends Controller
{



    public function index()
    {

        $this->content = $this->render('view/layout/home.php');
        require_once 'view/layout/main.php';
    }
}
