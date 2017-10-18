<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    public $insertFields = 'goods_name,goods_sn';
    protected $_auto = array (
//         array('status','1'), // 新增的时候把status字段设置为1
//         array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
//         array('name','getName',3,'callback'), // 对name字段在新增和编辑的时候回调getName方法
//        array('update_time','time',2,'function'), // 对update_time字段在更新的时候写入当前时间戳
          array('time','time',3,'function'),
        
    );
    public  $_validate = array(
//         array('verify','require','验证码必须！'), //默认情况下用正则进行验证
//         array('name','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
//         array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
//         array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
//         array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
           array('goods_name',"/^\d+$/u",'汉字','1','regex','3'),
           array('goods_sn','require','验证码必须！'),
    );
    
}
// namespace Admin\Model;
// use Think\Model;

// class GoodsModel extends Model{

//     public $insertFields = 'goods_name,goods_sn';

//     public $_auto = array(
//         // array(完成字段1,完成规则,[完成条件,附加规则]),
//         array('add_time','time',3,'function'),
//     );
//     public $_validate = array(
//         // array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
//         array('goods_name','3,12','你这个傻子，名字不对','1','length','3'),
//         array('goods_sn','','你这个傻子，货号不对','1','unique','3'),
//         array('shop_price','pr','shop_price错了','1','callback','3'),
//     );
//     public function pr(){
//         return true;
//     }
// }


