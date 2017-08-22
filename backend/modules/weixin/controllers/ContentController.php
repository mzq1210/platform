<?php
/*
 * 角色管理控制器
 * @author miaozhongqiang
 * @date 2016-11-07 15:23
 */
namespace app\modules\weixin\controllers;

use Yii;
use yii\helpers\Url;
use common\models\wechat\Content;
use common\models\wechat\Order;
use common\models\wechat\Menu;
use app\components\base\BaseController;
use common\components\library\ShowMessage;

class ContentController extends BaseController{

    /**
     * 首页列表
     * @return string
     * @author <miaozhongqiang>
     */
    public function actionIndex()
    {
        $params = $this->request->get();
        $params['per-page'] = !empty($params['per-page']) ? $params['per-page'] : PAGESIZE;

        $info = Content::search($params);
        return $this->render('index', [
            'info' => $info['data'],
            'pages' => $info['pages'],
            'params' =>$params
        ]);
    }

    /**
     * 删除
     * @param int   $id
     * @return bool|null|static
     * @author <miaozhongqiang>
     */
    public function actionDelete($id)
    {
        $model = Content::findOne($id);
        if($model->del_flag != 1) {
            $data = [
                'del_flag' => 1,
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('删除成功',Url::toRoute(['/weixin/content/index']),'','edit');
            }else{
                ShowMessage::info('删除失败');
            }
        }else{
            ShowMessage::info('该数据不存在');
        }
    }

    //信息列表
    public function actionDatalist(){


        return $this->render('datalist');





    }














    //数据列表
//    public function actionDatalist($length = 6){
//
//        $password = '';
//        //将你想要的字符添加到下面字符串中，默认是数字0-9和26个英文字母
//        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
//        $char_len = strlen($chars);
//        for ($f=0; $f<1000; $f++){
//
//
//            for($i=0;$i<$length;$i++){
//                $loop = mt_rand(0, ($char_len-1));
//                //将这个字符串当作一个数组，随机取出一个字符，并循环拼接成你需要的位数
//                $password = $chars[$loop];
//            }
//
//            echo $password.'<br>';
//        }


//
//        $menu=new Menu;
//
//        $data=Order::find()->select(['shop_name','order_id','create_time','num','price','moneny','menu_data'])->batch(100);
//
//
//        foreach ($data as $key => $value){
//
//            foreach ($value as $k => $item){
//
//                $cookBooks = explode(",", $item->menu_data);
//
//                $count = count($cookBooks);
//
//                $avgNum = ceil($item->num/$count) ;
//
//                foreach ($cookBooks as $index=> $goodsName){
//                    $_menu= clone $menu;
//
//                    $nums = !$index ?  $avgNum+ $item->num %$count : $avgNum;
//                    $_menu->num = $nums;
//                    $_menu->order_id  = $item->order_id;
//                    $_menu->shop_name = $item->shop_name;
//                    $_menu->menu_name = $goodsName;
//                    $_menu->create_at = $item->create_time;
//
//
//                    $_menu->setAttributes($index);
//
//                    $res= $_menu->save();
//
//                    //$menuData[$index] = [
////                        $nums,
////                        $item->shop_name,
////                        $goodsName,
////                        $item->create_time
////                    ];
//
//                }
//
//               // Yii::$app->db->createCommand()->batchInsert(menu::tableName(), ['num','shop_name','menu_name','create_at'], $menuData)->execute();
//
//            }
//
//        }

//    }



    public function pr(){

        $arr = func_get_args();

        echo "<pre>";

        print_r($arr);

        echo "</pre>";
    }

}
