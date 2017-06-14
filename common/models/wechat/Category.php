<?php
namespace common\models\wechat;

use Yii;
use common\query\CommonQuery;
use common\models\base\BaseWechat;
use yii\data\ActiveDataProvider;

class Category extends BaseWechat{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_category';
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

    public static function getCategoryData(){
        return self::find()->where(['type'=>1, 'del_flag'=>0])->asArray()->All();
    }

    public static function getCategory(){
        $category = self::find()->where(['type'=>2, 'parentid'=>0, 'del_flag'=>0])->asArray()->All();
        foreach ($category as $key => $value){
            $category[$key]['childs'] = self::find()->where(['type'=>2, 'parentID' => $value['id'], 'del_flag'=>0])->asArray()->all();
        }
        return $category;
    }

    public static function getThisCategory($id){
        return self::find()->where(['id'=>$id])->asArray()->one();
    }

    private static function _getChilds($id){
        return self::find()->where(['type'=>2, 'parentID' => $id, 'del_flag'=>0])->asArray()->all();
    }
}















?>