<?php

namespace app\modules\product\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_to_categories".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $category_id
 *
 */
class ProductsCategories extends ActiveRecord
{

    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_to_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('products_to_storages', 'ID'),
            'product_id' => Yii::t('products_to_storages', 'ProductId'),
            'category_id' => Yii::t('products_to_storages', 'CategoryId'),

        ];
    }

    /**
     * Relation with table Products.
     */
    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Relation with table Categories .
     */
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'product_id']);
    }
}