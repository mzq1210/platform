<?php
namespace common\models\sys;

use common\query\CommonQuery;
use Yii;
use common\components\Tools;
use common\models\base\BaseSys;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class Category extends BaseSys{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_category';
    }


    public static function search($params=[]){

        $query = self::find()->where(['del_flag' => 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100
            ],
        ]);
        $query->orderBy(['sort'=>SORT_ASC,'id'=>SORT_ASC]);

        if (empty($params)) {
            return $dataProvider;
        }
        return $dataProvider;
    }

    /**
     * @desc 加载CommonQuery类中的公共条件
     * @return CommonQuery
     * @author <mzq>
     */
    public static function find(){
        return new CommonQuery(get_called_class());
    }

    /**
     * @desc 根据id得到详情
     * @param array  $id  菜单ID
     * @return bool
     * @author <miaozhongqiang>
     */
    public static function getDetailGroupById($id){
        return self::findOne($id);
    }
}















?>