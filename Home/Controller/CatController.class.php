<?php
        namespace Home\Controller;
        use Think\Controller;
        class CatController extends Controller {
            public function cat(){
                $goodsModel = D('Admin/Goods');
                $cat_id = I('cat_id');
                $goodslist = $goodsModel->where('cat_id='.$cat_id)->field()->select();
                $this->assign('goodslist',$goodslist);
                $this->display();

            }
        }