<?php

namespace app\modules\product\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property string $update_at
 * @property string $deleted
 */
class Category extends ActiveRecord
{

    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['deleted', 'boolean'],
            [['created_at', 'update_at'], 'safe'],
            [['title'], 'string'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('category', 'ID'),
            'title' => Yii::t('category', 'Title'),
            'created_at' => Yii::t('category', 'Added time'),
            'update_at' => Yii::t('category', 'Last update in'),
            'deleted' => Yii::t('category', 'Delete status'),
        ];
    }

    /**
     * Relation with table ProductsCategories .
     */
    public function getProductsCategories(){
        return $this->hasOne(ProductsCategories::className(), ['category_id' => 'id']);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
}