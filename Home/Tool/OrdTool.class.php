<?php
namespace Home\Tool;
abstract class ACartTool {
    /**
    * 向购物车中添加1个商品
    * @param $goods_id int 商品id
    * @param $goods_name String 商品名
    * @param $shop_price float 价格
    * @return boolean
    */
    abstract public function add($goods_id, $goods_name, $shop_price);

    /**
    * 减少购物中1个商品的数量, 如果减至0, 则从购物车删除此商品
    * @param $goods_id int 商品id
    */
    abstract public function decr($goods_id) ;

    /**
    * 从购物车删除某商品
    * @param $goods_id 商品id
    */
    abstract public function del($goods_id) ;

    /**
    * 列出购物车所有的商品
    * @return Array
    */
    abstract public function items() ;

    /**
    * 返回购物车中有几种商品
    * @return int
    */
    abstract public function calcType() ;

    /**
    * 返回购物中商品的个数
    * @return int
    */
    abstract public function calcCnt() ;

    /**
    * 返回购物车中商品的总价格
    * @return float
    */

    abstract public function calcMoney() ;
    /**
    * 清空购物车
    * @return void
    */
    abstract public function clear() ;
}

 class OrdTool extends ACartTool{
    /**
     * 向购物车中添加1个商品
     * @param $goods_id int 商品id
     * @param $goods_name String 商品名
     * @param $shop_price float 价格
     * @return boolean
     */
     public $item = array();
     public static $ins = null;

     public static function getins()
     {
         if (self::$ins == null) {

         self::$ins = new self();

         }

         return self::$ins;
     }

     protected function __construct()
            {
                 $this->item = session('?car')?session('car'):array();
     }
     public function add($goods_id, $goods_name, $shop_price){
         if($this->item[$goods_id]){
             $this->item[$goods_id]['mun']+=1;
         }else{
             $goods['mun']  = 1;
             $goods['goods_name']  = $goods_name;
             $goods['$shop_price'] = $shop_price;
             $this->item[$goods_id] = $goods;

         }
     }

    /**
     * 减少购物中1个商品的数量, 如果减至0, 则从购物车删除此商品
     * @param $goods_id int 商品id
     */
     public function decr($goods_id) {
         if($this->item[$goods_id]['mun']<=0){
             unset($this->item['goods_id']);
         }
         if($this->item[$goods_id]){
         $this->item[$goods_id]['mun']-=1;
       }
     }

    /**
     * 从购物车删除某商品
     * @param $goods_id 商品id
     */
     public function del($goods_id) {
         unset($this->item[$goods_id]);
     }

    /**
     * 列出购物车所有的商品
     * @return Array
     */
     public function items() {
         return $this->item;
     }

    /**
     * 返回购物车中有几种商品
     * @return int
     */
     public function calcType() {
         return count($this->item);
     }

    /**
     * 返回购物中商品的个数
     * @return int
     */
    public function calcCnt(){
        $count = 0;
        foreach ($this->item as $k=>$v){
            $count = $count + $v['mun'];
        }
    }

    /**
     * 返回购物车中商品的总价格
     * @return float
     */

     public function calcMoney() {
         $Allprice = 0;
         foreach ($this->item as $k=>$v){
             $Allprice = $Allprice + $v['mun']*$v['goods_price'];
         }
     }
    /**
     * 清空购物车
     * @return void
     */
     public function clear() {
        $this->item = array();
     }

     public function __destruct()
     {
         // TODO: Implement __destruct() method.
         session('car',$this->item);

     }
 }
