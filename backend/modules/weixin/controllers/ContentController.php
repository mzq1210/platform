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


    //数据列表
    public function actionDatalist(){


        $menu=new Menu;

        $data=Order::find()->select(['shop_name','order_id','create_time','num','price','moneny','menu_data'])->batch(100);


        foreach ($data as $key => $value){



            foreach ($value as $k => $item){

                $cookBooks = explode(",", $item->menu_data);

                $count = count($cookBooks);

                $avgNum = ceil($item->num/$count) ;

                foreach ($cookBooks as $index=> $goodsName){
                    $_menu= clone $menu;

                    $nums = !$index ?  $avgNum+ $item->num %$count : $avgNum;
                    $_menu->num = $nums;
                    $_menu->order_id  = $item->order_id;
                    $_menu->shop_name = $item->shop_name;
                    $_menu->menu_name = $goodsName;
                    $_menu->create_at = $item->create_time;


                    $_menu->setAttributes($index);

                    $res= $_menu->save();

                    //$menuData[$index] = [
//                        $nums,
//                        $item->shop_name,
//                        $goodsName,
//                        $item->create_time
//                    ];

                }

               // Yii::$app->db->createCommand()->batchInsert(menu::tableName(), ['num','shop_name','menu_name','create_at'], $menuData)->execute();

            }

        }

    }



    public function pr(){

        $arr = func_get_args();

        echo "<pre>";

        print_r($arr);

        echo "</pre>";
    }

}
