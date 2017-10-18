<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller{
    public  $modelgoods;
    public function __construct(){
       parent::__construct();
       $this->modelgoods = D('Goods');
    }
    public function Goodsadd(){
        if(IS_POST){
            if(!$this->modelgoods->create($_POST)){
                   echo $this->modelgoods->getError();
                   exit;
                }
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728 ;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
                    $path_img1 = './Public/Uploads/';
                    $path_img2  = $info['goods_img']['savepath'].$info['goods_img']['savename']; 
                    $image = new \Think\Image();
                    $image->open($path_img1.$path_img2);
                    $dir = iconv("UTF-8", "GBK", './Public/img_small/'.$info['goods_img']['savepath']);
                    if (!file_exists($dir)){
                        mkdir($dir,0777,true);
                       // echo '创建文件夹bookcover成功';
                    } 
                    $path_thumb = './Public/img_small/'.$path_img2;
                    // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                    $image->thumb(150, 150)->save($path_thumb);
                    $this->modelgoods->goods_img = $path_img1+$path_img2;
                    $this->modelgoods->thumb_img = $path_thumb;
                    $this->success('上传成功！');
                    //print_r($info);exit();
                }
           $this->modelgoods->add();
        }
        $this->display();
    }
    public function Goodslist(){
//        $goods =  $this->modelgoods->select();
      
//        $this->assign('goods',$goods);
//         $this->display();
        
       // 分页
        
        $p = I('p')?I('p'):1;
// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $this->modelgoods->order('goods_id')->page($p.',2')->select();
        $this->assign('goods',$list);// 赋值数据集
        $count = $this->modelgoods->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数$Page -> setConfig('header','共%TOTAL_ROW%条');
$Page -> setConfig('first','首页');
$Page -> setConfig('last','共%TOTAL_PAGE%页');
$Page -> setConfig('prev','上一页');
$Page -> setConfig('next','下一页');
$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
$Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
    public function goodsdel(){
        $goods_id =  I('goods_id');
        $this->modelgoods->where("goods_id=$goods_id")->delete();
    }
}



// namespace Admin\Controller;
// use Think\Controller;
// class GoodsController extends Controller {
//     public $gm;
//     public function __construct(){
//         parent::__construct();
//         $this->gm = D('goods');
//     }
//     //商品添加
//     public function goodsadd(){
//         if(IS_POST){
//             if(!$this->gm->create($_POST)){
//                 echo $this->gm->getError();
//                 exit;
//             }

//             $upload = new \Think\Upload();// 实例化上传类
//             $upload->maxSize   =     3145728 ;// 设置附件上传大小
//             $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
//             $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
//             $upload->savePath  =     ''; // 设置附件上传（子）目录
//             // 上传文件
//             $info   =   $upload->upload();
//             if(!$info) {// 上传错误提示错误信息
//                 $this->error($upload->getError());
//             }else{// 上传成功
//                 $img_path1 = './Upload/'.$info['goods_img']['savepath'];
//                 $img_path2 = $info['goods_img']['savename'];

//                 $image = new \Think\Image();
//                 $image->open($img_path1.$img_path2);
//                 // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg

//                 $img_xiao = './Upload/thumb/'.$img_path2;
//                 $image->thumb(230, 230)->save($img_xiao);
//                 $this->gm->thumb_img = $img_xiao;
//                 $this->gm->goods_img = $img_path1.$img_path2;
//             }

//             echo $this->gm->add()?'1':'0';
//         }
//         $this->display();
//     }

//     //商品列表
//     public function goodslist(){

//         $p = I('p')?I('p'):1;
//         // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
//         $list = $this->gm->order('goods_id')->page($p.',2')->select();
//         $this->assign('list',$list);// 赋值数据集
//         $count      = $this->gm->count();// 查询满足要求的总记录数
//         $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数
//         $show       = $Page->show();// 分页显示输出
//         // var_dump($show);
//         $this->assign('page',$show);// 赋值分页输出
//         $this->display(); // 输出模板



//         // $this->assign('list',$this->gm->select());
//         // $this->display();
//     }

//     public function del(){
//         $this->gm->delete(I('get.goods_id'));
//         $this->redirect('admin/goods/goodslist');
//     }



// }


