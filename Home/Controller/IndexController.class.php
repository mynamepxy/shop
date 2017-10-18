<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $catModel = D("Admin/Cat");
       $tree = $catModel->gettree();
       //print_r($tree);
       $this->assign('tree',$tree);
        $this->display();
    }
}