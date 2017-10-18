<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goods(){

        $this->display();
    }
    public function shopcar(){
        $car =  \Home\Tool\OrdTool::getins();
        $goodsModel = D('Admin/Goods');
        $goodsinfo =  $goodsModel->find(I('get.goods_id'));
        $car->add(pjia,2,'4');
        print_r($car->items());
    }
}