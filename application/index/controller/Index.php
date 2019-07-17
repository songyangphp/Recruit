<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Index extends Controller
{
    public function index()
    {
        if(Session::get('uid')){
            $this->redirect('Home/index');
        }else{
            $this->redirect('Login/index');
        }
    }

    public function quit()
    {
        Session::delete('uid');
        $this->redirect("Login/index");
        exit;
    }
}
