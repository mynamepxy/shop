<?php
namespace Admin\Controller;
use Think\Controller;
class CatController extends Controller {
    // public function cateadd(){
    //     if(IS_POST){
    //         $catModel = D('Cat');
    //         if($catModel->add($_POST)){
    //             $this->redirect('admin/cat/catelist');exit;
    //         }
    //     }
    //     $this->display();
    // }
    // public function catelist(){
    //     $catModel = D('Cat');
        
    //     $this->assign('catlist',$catModel->gettree());
    //     $this->display();
    // }
    // public function cateedit(){

    //     $catModel = D('Cat');
    //     if(IS_POST){
    //         $catModel = D('Cat');
    //         $cat_id = I('cat_id');
    //         if($catModel->where('cat_id='.$cat_id)->save($_POST)){
    //             $this->redirect('admin/cat/catelist');
    //             exit;
    //         }
    //     }

    //     $catModel->gettree();
    //     $this->assign('gettree',$catModel->gettree());
    //     $this->assign('catinfo',$catModel->find(I('cat_id')));
    //     $this->display();
    // }

    // public function catedel(){
    //     $catModel = D('Cat');
    //     if($catModel->delete(I('get.cat_id'))){
    //         $this->redirect('admin/cat/catelist');exit;
    //     }
    // }
    public function cateadd(){
        
       
       if(IS_POST){
       $catModel = D('Cat');
       $catModel->add($_POST);
       //$this->redirect('admin/cat/cateadd');
        }
      $this->display();
    }
    public function  catelist(){
        $catModel = D('Cat');
//       print_r($catModel->gettree());
//         exit();
        $this->assign('catlist',$catModel->gettree());
        $this->display();
    }
    public function cateedit(){
        if(IS_POST){
            $catModel = D('Cat');
            $cat_id   = I('cat_id');
            $catModel->where("cat_id=$cat_id")->save($_POST);
            $this->redirect('admin/cat/catelist');
        }
        $catModel = D('Cat');
        $catlist  = $catModel->gettree();
       $catone  = $catModel->find(I('cat_id'));
        $this->assign('catlist',$catlist);
        $this->assign('catone',$catone);
        $this->display();
        //echo I('cat_id');
        }
        public function catedel(){
            
                $cat_id   = I('cat_id');
                $catModel = D('Cat');
               if($catModel->where("cat_id = $cat_id")->delete()){
                $this->redirect('admin/cat/catelist');
               }
            }
        




}




